<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\LeaveType;
use App\Models\LeaveMapping;
class LeaveMappingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Settings/Leave Allow';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.leave-allowed.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Settings/Allow Leave';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        $data['leaves'] = LeaveType::select('id', 'leave_name', 'total_leaves')
            ->where('status', 'Active')
            ->get();
        $data['designation'] = Designation::all();

        return view('home.leave-allowed.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            // Validation
            $request->validate([
                'designation_id' => 'required',
                'leave_type_id' => 'required',
                'allow_days' => 'required',
                'status' => 'required',
            ]);

            // Duplicate Check
            $exists = LeaveMapping::where('designation_id', $request->designation_id)
                ->where('leave_type_id', $request->leave_type_id)
                ->first();

            if ($exists) {
                return redirect()->back()->with('error', 'This leave type is already assigned to this designation.');
            }

            // Save
            LeaveMapping::create([
                'designation_id' => $request->designation_id,
                'leave_type_id' => $request->leave_type_id,
                'allow_days' => $request->allow_days,
                'status' => $request->status,
            ]);

            return redirect()->back()->with('success', 'Record saved successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function getDays($id)
    {
        $leave = LeaveType::find($id);

        return response()->json([
            'days' => $leave ? $leave->total_leaves : 0
        ]);
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
}
