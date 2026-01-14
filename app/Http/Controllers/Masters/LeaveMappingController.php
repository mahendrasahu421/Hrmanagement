<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\LeaveType;
use App\Models\LeaveMapping;

class LeaveMappingController extends Controller
{
    public function index()
    {
        $data['title'] = 'Settings/Leave Allow';
        $data['designation'] = Designation::all();
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);

        return view('home.leave-allowed.index', $data);
    }

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

    public function store(Request $request)
    {
        $request->validate([
            'designation_id' => 'required',
            'leave_type_id' => 'required',
            'allow_days' => 'required|numeric',
            'status' => 'required',
        ]);

        $exists = LeaveMapping::where('designation_id', $request->designation_id)
            ->where('leave_type_id', $request->leave_type_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This leave type is already assigned to this designation.');
        }

        LeaveMapping::create([
            'designation_id' => $request->designation_id,
            'leave_type_id' => $request->leave_type_id,
            'allow_days' => $request->allow_days,
            'status' => $request->status,
        ]);

        return redirect()->route('settings.leave-allow')->with('success', 'Record saved successfully!');
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
        $search = $request->input('search.value');
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        $query = LeaveMapping::with(['leaveType', 'designation']);

        if ($request->designation_id) {
            $query->where('designation_id', $request->designation_id);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('leaveType', function ($q1) use ($search) {
                    $q1->where('leave_name', 'like', "%{$search}%")
                        ->orWhere('leave_code', 'like', "%{$search}%");
                })->orWhereHas('designation', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%");
                });
            });
        }

        $totalRecord = $query->count();
        $leaveMappings = $query->skip($start)->take($limit)->get();

        $rows = [];

        foreach ($leaveMappings as $index => $leave) {
            $rows[] = [
                'id' => $leave->id,
                'DT_RowIndex' => $start + $index + 1,
                'designation' => $leave->designation->name ?? '-',
                'leave_name' => $leave->leaveType->leave_name ?? '-',
                'leave_code' => $leave->leaveType->leave_code ?? '-',
                'allow_days' => $leave->allow_days,
                'status' => $leave->status === 'Active'
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>',
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $totalRecord,
            'recordsFiltered' => $totalRecord,
            'data' => $rows,
        ]);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Leave Allow';
        $data['leave'] = LeaveMapping::with('leaveType')->findOrFail($id);
        $data['designation'] = Designation::all();
        $data['companies'] = Company::all();
        $data['leaves'] = LeaveType::where('status', 'Active')->get();

        return view('home.leave-allowed.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'designation_id' => 'required',
            'leave_type_id' => 'required',
            'allow_days' => 'required|numeric',
            'status' => 'required',
        ]);

        $exists = LeaveMapping::where('designation_id', $request->designation_id)
            ->where('leave_type_id', $request->leave_type_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This leave type is already assigned to this designation.');
        }

        $leave = LeaveMapping::findOrFail($id);

        $leave->update([
            'designation_id' => $request->designation_id,
            'leave_type_id' => $request->leave_type_id,
            'allow_days' => $request->allow_days,
            'status' => $request->status,
        ]);

        return redirect()->route('settings.leave-allow')->with('success', 'Record updated successfully!');
    }

    public function destroy($id)
    {
        LeaveMapping::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Leave mapping deleted successfully!'
        ]);
    }
}
