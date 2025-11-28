<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Holiday;
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
    $data['depatment'] = Department::all();

    return view('home.attendance.index', $data);
}


    public function list(Request $request)
    {
        try {
            $departmentId = $request->department_id;

            $query = Leave::with(['leaveType', 'employee']);

            if (!empty($departmentId)) {
                $query->whereHas('employee', function ($q) use ($departmentId) {
                    $q->where('department_id', $departmentId);
                });
            }

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

            $total = $query->count();

            $leaves = $query->skip($request->start)
                ->take($request->length)
                ->get();

            $data = [];
            foreach ($leaves as $index => $leave) {
                $data[] = [
                    'employee' => $leave->employee->employee_name ?? '--',
                    'leave_type' => $leave->leaveType->leave_name ?? '--',
                    'days' => $leave->duration,
                    'from_date' => $leave->from_date,
                    'to_date' => $leave->to_date,
                    'reason' => $leave->reason,
                    'status' => ucfirst($leave->status),
                ];
            }

            // ⭐ NEW → Department-wise leave count
            $departmentSummary = Leave::with('employee')
                ->selectRaw('employees.department_id, COUNT(leaves.id) as total_leave')
                ->join('employees', 'employees.employee_id', '=', 'leaves.employee_id')
                ->groupBy('employees.department_id')
                ->get();

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $data,

                // ⭐ This will give department-wise leave count
                'departmentSummary' => $departmentSummary,
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
