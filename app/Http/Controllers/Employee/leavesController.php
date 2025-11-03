<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use App\Models\Leave;
class leavesController extends Controller
{
    public function index()
    {
        $data['title'] = 'Leaves';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('employee.leaves.index', $data);
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
        // dd($request->all());
        try {
            // ✅ Validate input
            $request->validate([
                'leave_type_id' => 'required|exists:leave_types,id',
                'from_date' => 'required|date',
                'to_date' => 'required|date|after_or_equal:from_date',
                'reason' => 'required|string|max:255',
                'status' => 'required|string'
            ]);

            // ✅ Create leave entry
            Leave::create([
                'employee_id' => auth()->id(),
                'leave_type_id' => $request->leave_type_id,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'reason' => $request->reason,
                'status' => $request->status,
            ]);

            // ✅ Redirect on success
            return redirect()
                ->route('employee.leaves')
                ->with('success', 'Leave applied successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // ⚠️ Handle validation errors separately
            return back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
           
            // ❌ Catch all other exceptions
            \Log::error('Leave Apply Error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while applying for leave. Please try again.')->withInput();
        }
    }

}
