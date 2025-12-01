<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Holiday;
use App\Models\Designation;
use App\Models\Leave;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Leave Request';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        $today = date('Y-m-d');
        $data['daily_leave_count'] = Leave::whereDate('created_at', $today)->count();
        $data['onleave'] = Leave::count();
        $data['designation'] = Designation::all();

        return view('home.attendance.index', $data);
    }






    public function list(Request $request)
    {
        try {
            $designationId = $request->designation_id;

            // Base query (Today's leaves)
            $query = Leave::with(['leaveType', 'employee'])
                ->whereDate('created_at', Carbon::today());

            // Filter: Designation
            if (!empty($designationId)) {
                $query->whereHas('employee', function ($q) use ($designationId) {
                    $q->where('designation_id', $designationId);
                });
            }

            // Search filter
            $search = $request->input('search.value');
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('reason', 'like', "%{$search}%")
                        ->orWhereHas('employee', function ($emp) use ($search) {
                            $emp->where('employee_name', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('leaveType', function ($type) use ($search) {
                            $type->where('leave_name', 'LIKE', "%{$search}%");
                        });
                });
            }

            $recordsFiltered = $query->count();

            // Pagination
            $start = $request->start ?? 0;
            $length = $request->length ?? 10;
            $leaves = $query->skip($start)->take($length)->get();

            $data = [];

            foreach ($leaves as $leave) {

                $from = Carbon::parse($leave->from_date);
                $to = Carbon::parse($leave->to_date);
                $days = $from->diffInDays($to) + 1;

                // Status badge
                $statusLower = strtolower($leave->status);
                $statusBadge = match ($statusLower) {
                    'approved' => '<span class="badge bg-success">Approved</span>',
                    'rejected' => '<span class="badge bg-danger">Rejected</span>',
                    'sent' => '<span class="badge bg-primary">Pending</span>',
                    default => '<span class="badge bg-warning">Pending</span>',
                };

                // Action buttons: only if status is 'Sent'
                if ($statusLower === 'sent') {
                    $actionButtons = '
            <button class="btn btn-success btn-sm openModal" data-id="' . $leave->id . '" data-status="Approved">Accept</button>
            <button class="btn btn-danger btn-sm openModal" data-id="' . $leave->id . '" data-status="Rejected">Reject</button>
        ';
                } else {
                    // Otherwise show status badge as action
                    $actionButtons = $statusBadge;
                }

                $data[] = [
                    'employee' => $leave->employee->employee_name ?? '--',
                    'leave_type' => $leave->leaveType->leave_name ?? '--',
                    'days' => $days,
                    'from_date' => $leave->from_date,
                    'to_date' => $leave->to_date,
                    'reason' => $leave->reason,
                    'status' => $statusBadge,
                    'action' => $actionButtons,
                ];
            }



            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $recordsFiltered,
                'recordsFiltered' => $recordsFiltered,
                'data' => $data,
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function updateStatus(Request $request)
    {

        $leave = Leave::find($request->leave_id);

        if (!$leave) {
            return response()->json(['error' => 'Leave not found'], 404);
        }

        $leave->status = $request->new_status;
        $leave->save();

        return response()->json(['success' => true]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function holidayList()
    {
        $data['title'] = 'Holiday List';

        $holidays = Holiday::where('status', 'active')->get();

        $events = [];
        foreach ($holidays as $h) {
            $events[] = [
                'title' => $h->holiday_name,
                'start' => $h->holiday_date,
                'className' => 'holiday-event',
                'display' => 'block'
            ];
        }

        $data['events'] = $events;

        return view('employee.holiday.index', $data);
    }
}
