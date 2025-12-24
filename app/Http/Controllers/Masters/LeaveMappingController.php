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
        $data['designation'] = Designation::all();
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

            return redirect('settings.leave-allow')->with('success', 'Record saved successfully!');
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

    public function list(Request $request)
    {
        try {

            $search = $request->input('search.value');
            $limit = $request->input('length', 10);
            $start = $request->input('start', 0);

            $query = LeaveMapping::with(['leaveType', 'designation']);

            // -------- DESIGNATION FILTER ----------
            if ($request->designation_id) {
                $query->where('designation_id', $request->designation_id);
            }

            // ---------- SEARCH ----------
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('leaveType', function ($q1) use ($search) {
                        $q1->where('leave_name', 'like', "%{$search}%")
                            ->orWhere('leave_code', 'like', "%{$search}%");
                    })
                        ->orWhereHas('designation', function ($q2) use ($search) {
                            $q2->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $totalRecord = $query->count();
            $leaveMappings = $query->skip($start)->take($limit)->get();

            $rows = [];
            foreach ($leaveMappings as $index => $leave) {
                $rows[] = [
                    'DT_RowIndex' => $start + $index + 1,
                    'designation' => $leave->designation->name ?? '-',
                    'leave_name'  => $leave->leaveType->leave_name ?? '-',
                    'leave_code'  => $leave->leaveType->leave_code ?? '-',
                    'allow_days'  => $leave->allow_days,
                    'status'      => $leave->status === 'Active'
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>',
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
                'message' => $e->getMessage(),
            ], 500);
        }
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
