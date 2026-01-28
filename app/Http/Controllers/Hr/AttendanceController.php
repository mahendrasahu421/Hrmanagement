<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use App\Models\Designation;
use App\Models\Leave;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\LeaveStatusMail;
use Illuminate\Support\Facades\Mail;

class AttendanceController extends Controller
{
    public function index()
    {
        $data['title'] = 'Leave Request';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        $data['onleave'] = Leave::whereDate('created_at', Carbon::today())->count();
        $data['designation'] = Designation::all();

        return view('home.attendance.index', $data);
    }

    public function list(Request $request)
    {
        $designationId = $request->designation_id;

        $query = Leave::with(['leaveType', 'employee'])
            ->whereDate('created_at', Carbon::today());

        if (!empty($designationId)) {
            $query->whereHas('employee', function ($q) use ($designationId) {
                $q->where('designation_id', $designationId);
            });
        }

        if (!empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('reason', 'like', "%{$search}%")
                    ->orWhereHas('employee', function ($emp) use ($search) {
                        $emp->where('employee_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('leaveType', function ($type) use ($search) {
                        $type->where('leave_name', 'like', "%{$search}%");
                    });
            });
        }

        $recordsFiltered = $query->count();
        $start  = $request->start ?? 0;
        $length = $request->length ?? 10;

        $leaves = $query->skip($start)->take($length)->get();

        $data = [];

        foreach ($leaves as $leave) {

            $from = Carbon::parse($leave->from_date);
            $to   = Carbon::parse($leave->to_date);
            $days = $from->diffInDays($to) + 1;

            $statusLower = strtolower($leave->status);

            $statusBadge = match ($statusLower) {
                'approved' => '<span class="badge bg-success">Approved</span>',
                'rejected' => '<span class="badge bg-danger">Rejected</span>',
                default => '<span class="badge bg-primary">Pending</span>',
            };

            if ($statusLower === 'sent') {
                $action = '
                    <button class="btn btn-success btn-sm openModal" data-id="' . $leave->id . '" data-status="Approved">Accept</button>
                    <button class="btn btn-danger btn-sm openModal" data-id="' . $leave->id . '" data-status="Rejected">Reject</button>
                ';
            } else {
                $action = $statusBadge;
            }

            $data[] = [
                'employee'   => $leave->employee->employee_name ?? '--',
                'leave_type' => $leave->leaveType->leave_name ?? '--',
                'days'       => $days,
                'from_date'  => $from->format('d/m/Y'),
                'to_date'    => $to->format('d/m/Y'),
                'reason'     => $leave->reason,
                'status'     => $statusBadge,
                'action'     => $action,
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $recordsFiltered,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'leave_id' => 'required',
            'new_status' => 'required|in:Approved,Rejected',
        ]);

        $leave = Leave::with('employee')->find($request->leave_id);

        $templateKey = $request->new_status === 'Approved'
            ? 'leave_approved'
            : 'leave_rejected';

        $template = EmailTemplate::where('template_key', $templateKey)->first();

        Mail::to($leave->employee->employee_email)
            ->cc('sneha.s@neuralinfo.org')
            ->send(new LeaveStatusMail(
                $leave,
                $request->new_status,
                $template,
                $leave->employee
            ));

        $leave->status = $request->new_status;
        $leave->save();

        return response()->json(['success' => true]);
    }
}
