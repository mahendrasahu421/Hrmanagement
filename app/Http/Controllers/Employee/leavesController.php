<?php

namespace App\Http\Controllers\Employee;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\LeaveMapping;
use Carbon\Carbon;

class leavesController extends Controller
{
    public function index()
    {
        $data['title'] = 'Leaves';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);

        $employeeId = auth('employee')->id();
        $employee = Employee::find($employeeId);

        if (!$employee) {
            abort(404, 'Employee not found');
        }

        $designationId = $employee->designation_id; // Employee ki designation
        $companyId = $employee->company_id; // Employee ki company

        // Fetch leave mappings for this designation
        $leaveMappings = LeaveMapping::with('leaveType')
            ->where('designation_id', $designationId)
            ->get();

        $totalAllotted = 0;
        $totalUsed = 0;
        $leaveSummary = [];

        foreach ($leaveMappings as $mapping) {
            $leaveType = $mapping->leaveType;

            // Employee ne kitni leaves use ki hai
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




    // ✅ Helper functions same rahenge
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
        $data['title'] = 'Leaves Apply';
        $data['leaveTypes'] = LeaveType::all();

        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('employee.leaves.create', $data);
    }
    public function store(Request $request)
    {
        try {
            // ✅ Validate input
            $request->validate([
                'leave_type_id' => 'required|exists:leave_types,id',
                'from_date' => 'required|date',
                'to_date' => 'required|date|after_or_equal:from_date',
                'reason' => 'required|string|max:255',
                'status' => 'required',
            ]);

            $employeeId = auth('employee')->id();
            $employee = Employee::find($employeeId);

            if (!$employee) {
                return back()->with('error', 'Employee not found')->withInput();
            }

            // ✅ Check leave mapping for this employee's designation
            $leaveMapping = LeaveMapping::where('designation_id', $employee->designation_id)
                ->where('leave_type_id', $request->leave_type_id)
                ->first();

            if (!$leaveMapping) {
                return back()->with('error', 'You are not allowed to apply for this leave type')->withInput();
            }

            // ✅ Calculate requested days
            $from = Carbon::parse($request->from_date);
            $to = Carbon::parse($request->to_date);
            $daysRequested = $from->diffInDays($to) + 1;

            if ($daysRequested > $leaveMapping->allow_days) {
                return back()->with('error', 'You are requesting more days than allowed')->withInput();
            }

            // ✅ Create leave entry with PENDING status
            Leave::create([
                'employee_id' => $employeeId,
                'leave_type_id' => $request->leave_type_id,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'reason' => $request->reason,
                'status' => $request->status,
            ]);

            return redirect()
                ->route('employee.leaves')
                ->with('success', 'Leave applied successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            // ❌ Show real error message
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

            // ✅ Authenticated employee ID
            $employeeId = auth('employee')->id();

            // ✅ Query for employee's leave records
            $query = Leave::with('leaveType')
                ->where('employee_id', $employeeId);

            // ✅ Apply search filter
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
                        'pending' => '<span class="badge badge-warning d-inline-flex align-items-center badge-xs">
                        <i class="ti ti-point-filled me-1"></i>Pending
                  </span>',
                        'rejected' => '<span class="badge badge-danger d-inline-flex align-items-center badge-xs">
                        <i class="ti ti-point-filled me-1"></i>Rejected
                   </span>',
                        default => '<span class="badge badge-secondary d-inline-flex align-items-center badge-xs">
                        <i class="ti ti-point-filled me-1"></i>--
                 </span>',
                    },

                    'created_at' => $leave->created_at->format('d M Y'),
                    'action' => '<a href="#" class="btn btn-sm btn-primary">View</a>',
                ];
            }

            // ✅ Return JSON for DataTable
            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => $totalRecord,
                'recordsFiltered' => $totalRecord,
                'data' => $rows,
            ]);

        } catch (\Exception $e) {
            // ⚠️ Handle error gracefully
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong while fetching leave records.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }

}
