<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\User;
use App\Models\EmailTemplate;
use App\Models\LeaveMapping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeaveAppliedMail;
use App\Models\LeaveReason;

class leavesController extends Controller
{
    public function index()
    {
        $data['title'] = 'Leaves';
        $data['titleRoute'] = 'Leave Management / Leaves List';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);

        $employeeId = auth('employee')->id();
        $employee = Employee::find($employeeId);

        if (!$employee) {
            abort(404, 'Employee not found');
        }

        $designationId = $employee->designation_id;
        $leaveMappings = LeaveMapping::with('leaveType')
            ->where('designation_id', $designationId)
            ->get();

        $totalAllotted = 0;
        $totalUsed = 0;
        $leaveSummary = [];

        foreach ($leaveMappings as $mapping) {

            $leaveType = $mapping->leaveType;
            if (!$this->isLeaveApplicable($employee, $leaveType)) {
                continue;
            }
            $used = Leave::where('employee_id', $employeeId)
                ->where('leave_type_id', $leaveType->id)
                ->where('status', 'APPROVED')
                ->whereYear('from_date', Carbon::now()->year)
                ->get()
                ->sum(function ($leave) {
                    return Carbon::parse($leave->from_date)
                        ->diffInDays(Carbon::parse($leave->to_date)) + 1;
                });

            $remaining = max($mapping->allow_days - $used, 0);

            $totalAllotted += $mapping->allow_days;
            $totalUsed += $used;

            $leaveSummary[] = [
                'id' => $leaveType->id,
                'name' => $leaveType->leave_name,
                'total_leaves' => $mapping->allow_days,
                'used' => $used,
                'remaining' => $remaining,
                'icon' => $this->getLeaveIcon($leaveType->leave_name),
                'color' => $this->getLeaveColor($leaveType->leave_name),
            ];
        }
        $data['leaveSummary'] = $leaveSummary;
        $data['totalAllotted'] = $totalAllotted;
        $data['totalUsed'] = $totalUsed;
        $data['totalRemaining'] = max($totalAllotted - $totalUsed, 0);
        return view('employee.leaves.index', $data);
    }


    private function isLeaveApplicable($employee, $leaveType)
    {
        if ($leaveType->applicable_for !== 'All') {
            if (strtoupper($leaveType->applicable_for) !== strtoupper($employee->employee_gender)) {
                return false;
            }
        }
        $joinDate = Carbon::parse($employee->joining_date);
        $monthsWorked = $joinDate->diffInMonths(Carbon::now());

        if ($monthsWorked < 2) {
            return false;
        }
        return true;
    }

    public function getLeaveReasons($leaveTypeId)
    {
        $reasons = LeaveReason::where('leave_type_id', $leaveTypeId)
            ->where('status', 'Active')
            ->select('id', 'reason')
            ->get();

        return response()->json($reasons);
    }

    private function getLeaveIcon($name)
    {
        return match (strtolower($name)) {
            'annual leave' => 'ti ti-calendar-event',
            'medical leave' => 'ti ti-vaccine',
            'casual leave' => 'ti ti-hexagon-letter-c',
            default => 'ti ti-hexagonal-prism-plus',
        };
    }

    private function getLeaveColor($name)
    {
        return match (strtolower($name)) {
            'annual leave' => 'bg-black-le',
            'medical leave' => 'bg-blue-le',
            'casual leave' => 'bg-purple-le',
            default => 'bg-pink-le',
        };
    }

    public function create()
{
    $data['title'] = 'Leaves';
    $data['titleRoute'] = 'Leave Management / Leaves Apply';

    $employeeId = auth('employee')->id();
    $employee = Employee::findOrFail($employeeId);

    $employeeGender = strtoupper($employee->gender);
    $monthsWorked = Carbon::parse($employee->joining_date)->diffInMonths(now());

    $leaveTypes = LeaveType::where(function ($q) use ($employeeGender) {
            $q->where('applicable_for', 'ALL')
              ->orWhere('applicable_for', $employeeGender);
        })
        ->when($monthsWorked < 2, function ($q) {
            $q->where('leave_name', 'Leave Without Pay');
        })
        ->get();

    // 🔹 Remaining leaves calculation
    $leaveTypes = $leaveTypes->map(function ($leaveType) use ($employee) {

        if ($leaveType->leave_name === 'Leave Without Pay') {
            $leaveType->remaining = 'Unlimited';
            return $leaveType;
        }

        $mapping = LeaveMapping::where('designation_id', $employee->designation_id)
            ->where('leave_type_id', $leaveType->id)
            ->first();

        if (!$mapping) {
            $leaveType->remaining = 0;
            return $leaveType;
        }

        $used = Leave::where('employee_id', $employee->id)
            ->where('leave_type_id', $leaveType->id)
            ->where('status', 'APPROVED')
            ->whereYear('from_date', now()->year)
            ->get()
            ->sum(function ($leave) {
                return Carbon::parse($leave->from_date)
                    ->diffInDays(Carbon::parse($leave->to_date)) + 1;
            });

        $leaveType->remaining = max($mapping->allow_days - $used, 0);
        return $leaveType;
    });

    $data['leaveTypes'] = $leaveTypes;

    return view('employee.leaves.create', $data);
}



    public function store(Request $request)
    {
        try {
            // Validation
            $request->validate([
                'leave_type_id' => 'required|exists:leave_types,id',
                'from_date' => 'required|date',
                'to_date' => 'required|date|after_or_equal:from_date',
                'reason_id' => 'required',
                'reason' => $request->reason_id === 'Others' ? 'required|string|max:250' : 'nullable|string|max:250',
                'status' => 'required|in:DRAFT,SENT',
            ]);

            $employeeId = auth('employee')->id();
            $employee = Employee::find($employeeId);

            if (!$employee) {
                return back()->with('error', 'Employee not found')->withInput();
            }

            $from = Carbon::parse($request->from_date);
            $to = Carbon::parse($request->to_date);

            $alreadyDraftOrApplied = Leave::where('employee_id', $employeeId)
                ->where('leave_type_id', $request->leave_type_id)
                ->where(function ($q) use ($from, $to) {
                    $q->where(function ($q2) use ($from, $to) {
                        $q2->whereBetween('from_date', [$from, $to])
                            ->orWhereBetween('to_date', [$from, $to])
                            ->orWhere(function ($q3) use ($from, $to) {
                                $q3->where('from_date', '<=', $from)
                                    ->where('to_date', '>=', $to);
                            });
                    });
                })
                ->exists();

            if ($alreadyDraftOrApplied) {
                return back()->with('error', 'You have already applied or saved a draft for this leave type for the selected dates.')->withInput();
            }

            $leaveType = LeaveType::find($request->leave_type_id);
            $today = Carbon::today();

            if ($leaveType && $leaveType->leave_name !== "Emergency Leave") {
                if (Carbon::parse($request->from_date)->lte($today)) {
                    return back()
                        ->with('error', 'You cannot apply non-emergency leave for today. Please select a future date.')
                        ->withInput();
                }
            }

            $leaveMapping = LeaveMapping::where('designation_id', $employee->designation_id)
                ->where('leave_type_id', $request->leave_type_id)
                ->first();

            if (!$leaveMapping) {
                return back()->with('error', 'You are not allowed to apply for this leave type')->withInput();
            }

            $daysRequested = $from->diffInDays($to) + 1;

            if ($leaveMapping->allow_days !== null && $daysRequested > $leaveMapping->allow_days) {
                return back()->with('error', 'You are requesting more days than allowed')->withInput();
            }

            if ($request->reason_id === 'Others') {
                $reasonText = $request->reason;
                $reasonId = 0;
            } else {
                $reasonRecord = LeaveReason::find($request->reason_id);
                $reasonText = $reasonRecord ? $reasonRecord->reason : null;
                $reasonId = $reasonRecord ? $reasonRecord->id : null;
            }

            // Save leave in DB
            $leave = Leave::create([
                'employee_id' => $employeeId,
                'leave_type_id' => $request->leave_type_id,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'duration' => $daysRequested,
                'reason' => $reasonText,
                'reasons_id' => $reasonId,
                'status' => $request->status,
            ]);

            // Send email only if status is SENT
            if ($request->status === 'SENT') {
                $adminEmail = User::where('role_id', 1)->value('email');
                $hrEmail = User::where('role_id', 2)->value('email');

                if ($adminEmail || $hrEmail) {
                    $template = EmailTemplate::where('template_key', 'employee_leave_apply')->first();

                    Mail::to($adminEmail)
                        ->cc($hrEmail)
                        ->bcc('sneha.s@neuralinfo.org')
                        ->send(new LeaveAppliedMail($leave, $template));
                }
            }

            return redirect()->route('employee.leaves')
                ->with('success', 'Leave applied successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            \Log::error('Leave Apply Error: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }


    public function list(Request $request)
    {
        try {
            $search = $request->input('search')['value'] ?? null;
            $limit = $request->input('length', 10);
            $start = $request->input('start', 0);
            $employeeId = auth('employee')->id();
            $query = Leave::with('leaveType')
                ->where('employee_id', $employeeId);
            $leaveTypeId = $request->input('leave_type');
            if ($leaveTypeId) {
                $query->where('leave_type_id', $leaveTypeId);
            }
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('reason', 'like', "%$search%")
                        ->orWhereHas('leaveType', function ($q2) use ($search) {
                            $q2->where('leave_name', 'like', "%$search%");
                        });
                });
            }
            $totalRecord = $query->count();
            $leaves = $query->skip($start)->take($limit)->get();

            $rows = [];
            foreach ($leaves as $index => $leave) {
                $rows[] = [
                    'DT_RowIndex' => $start + $index + 1,
                    'leave_type' => $leave->leaveType->leave_name ?? '--',
                    'from_date' => $leave->from_date ?? '--',
                    'to_date' => $leave->to_date ?? '--',
                    'duration' => $leave->duration ?? '--',
                    'reason' => $leave->reason ?? '--',
                    'status' => match (strtolower($leave->status)) {
                        'approved' => '<span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                        <i class="ti ti-point-filled me-1"></i>Approved
                                   </span>',
                        'draft' => '<a href="' . route('employee.leaves.edit', $leave->id) . '">
                                        <span class="badge badge-danger d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>DRAFT
                                        </span>
                                    </a>',
                        'sent' => '<span class="badge badge-warning d-inline-flex align-items-center badge-xs">
                                        <i class="ti ti-point-filled me-1"></i>Approval Pending
                                   </span>',
                        'rejected' => '<span class="badge badge-danger d-inline-flex align-items-center badge-xs">
                                        <i class="ti ti-point-filled me-1"></i>Rejected
                                   </span>',
                        default => '<span class="badge badge-secondary d-inline-flex align-items-center badge-xs">
                                        <i class="ti ti-point-filled me-1"></i>--</span>',
                    },
                    'created_at' => $leave->created_at->format('d M Y'),
                    'action' => '<a href="#" class="btn btn-sm btn-primary">View</a>',
                ];
            }
            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => $totalRecord,
                'recordsFiltered' => $totalRecord,
                'data' => $rows,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong while fetching leave records.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }


    public function getLeaveBalance($leaveTypeId)
    {
        $employeeId = auth('employee')->id();
        $leaveType = LeaveType::find($leaveTypeId);

        if (!$leaveType) {
            return response()->json([
                'allotted' => 0,
                'used' => 0,
                'remaining' => 0,
                'leave_name' => ''
            ]);
        }

        if ($leaveType->leave_name === "Leave Without Pay") {

            return response()->json([
                'allotted' => "Unlimited",
                'used' => "-",
                'remaining' => "Unlimited",
                'leave_name' => "Leave Without Pay"
            ]);
        }

        $mapping = LeaveMapping::where('designation_id', auth('employee')->user()->designation_id)
            ->where('leave_type_id', $leaveTypeId)
            ->first();

        if (!$mapping) {
            return response()->json([
                'allotted' => 0,
                'used' => 0,
                'remaining' => 0,
                'leave_name' => $leaveType->leave_name
            ]);
        }

        // Used leaves
        $used = Leave::where('employee_id', $employeeId)
            ->where('leave_type_id', $leaveTypeId)
            ->where('status', 'APPROVED')
            ->whereYear('from_date', Carbon::now()->year)
            ->get()
            ->sum(function ($leave) {
                return Carbon::parse($leave->from_date)
                    ->diffInDays(Carbon::parse($leave->to_date)) + 1;
            });

        $remaining = max($mapping->allow_days - $used, 0);

        return response()->json([
            'allotted' => $mapping->allow_days,
            'used' => $used,
            'remaining' => $remaining,
            'leave_name' => $leaveType->leave_name
        ]);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Leave';
        $data['titleRoute'] = 'Leave Management / Edit Leave';

        $employeeId = auth('employee')->id();
        $employee = Employee::find($employeeId);
        if (!$employee) {
            abort(404, 'Employee not found');
        }
        $employeeGender = strtoupper($employee->gender);
        $today = Carbon::now();
        $monthsWorked = Carbon::parse($employee->joining_date)->diffInMonths($today);
        $data['leaveTypes'] = LeaveType::where(function ($q) use ($employeeGender) {
            $q->where('applicable_for', 'ALL')
                ->orWhere('applicable_for', $employeeGender);
        })
            ->when($monthsWorked < 2, function ($q) {
                $q->where('leave_name', 'Leave Without Pay');
            })
            ->get();
        $data['leave'] = Leave::findOrFail($id);
        $data['reasons'] = LeaveReason::where('leave_type_id', $data['leave']->leave_type_id)
            ->where('status', 'Active')
            ->get();

        return view('employee.leaves.edit', $data);
    }


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'leave_type_id' => 'required|exists:leave_types,id',
                'from_date'     => 'required|date',
                'to_date'       => 'required|date|after_or_equal:from_date',
                'status'        => 'required|in:DRAFT,SENT',
                'reason_id'     => 'required',
                'reason'        => $request->reason_id === 'Others'
                    ? 'required|string|max:255'
                    : 'nullable|string|max:255',
            ]);

            $leave = Leave::findOrFail($id);

            $leave->leave_type_id = $request->leave_type_id;
            $leave->from_date     = $request->from_date;
            $leave->to_date       = $request->to_date;
            $leave->status        = $request->status;
            if ($request->reason_id === 'Others') {
                $leave->reason     = $request->reason;
                $leave->reasons_id = null;
            } else {
                $reasonRecord = LeaveReason::find($request->reason_id);

                $leave->reason     = $reasonRecord ? $reasonRecord->reason : null;
                $leave->reasons_id = $reasonRecord ? $reasonRecord->id : null;
            }

            $leave->save();
            if ($leave->status === 'SENT') {

                $adminEmail = User::where('role_id', 1)->value('email');
                $hrEmail    = User::where('role_id', 2)->value('email');

                $emails = collect([$adminEmail, $hrEmail])
                    ->filter()
                    ->toArray();

                if (!empty($emails)) {
                    $template = EmailTemplate::where('template_key', 'employee_leave_apply')->first();

                    Mail::to($emails)
                        ->bcc('sneha.s@neuralinfo.org')
                        ->send(new LeaveAppliedMail($leave, $template));
                }
            }

            return redirect()
                ->route('employee.leaves')
                ->with('success', 'Leave updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Leave Update Error: ' . $e->getMessage());
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
