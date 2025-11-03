<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Master / Organisation / Department';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.department.index', $data);
    }

    /**
     * Return Department list (AJAX DataTable)
     */
    public function list(Request $request)
    {
        $limit = $request->input('length');
        $start = $request->input('start');
        $totalRecord = Department::count();

        $query = Department::select('id', 'department_name', 'department_code', 'department_head', 'status')
            ->orderBy('id', 'desc');

        $departments = $query->skip($start)->take($limit)->get();

        $rows = [];
        foreach ($departments as $dept) {
            $statusBadge = $dept->status === 'active'
                ? '<span class="badge badge-success"><i class="ti ti-point-filled me-1"></i>Active</span>'
                : '<span class="badge badge-danger"><i class="ti ti-point-filled me-1"></i>Inactive</span>';

            $editBtn = '<a href="' . route('masters.organisation.department.edit', $dept->id) . '" 
                class="btn btn-sm btn-primary me-2" title="Edit"><i class="ti ti-edit"></i></a>';

            $deleteBtn = '<a href="' . route('masters.organisation.department.destroy', $dept->id) . '" 
                class="btn btn-sm btn-danger deleteDepartment" title="Delete">
                <i class="ti ti-trash"></i></a>';

            $row = [];
            $row['sn'] = $dept->id;
            $row['department_name'] = $dept->department_name;
            $row['department_code'] = $dept->department_code;
            $row['department_head'] = $dept->department_head ?? 'N/A';
            $row['status'] = $statusBadge;
            $row['action'] = $editBtn . $deleteBtn;

            $rows[] = $row;
        }

        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalRecord),
            "recordsFiltered" => intval($totalRecord),
            "data" => $rows
        ];

        return response()->json($json_data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Master / Organisation / Department Create';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.department.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'department_name' => 'required|string|max:255',
            'department_code' => 'required|string|max:50|unique:departments,department_code',
            'status' => 'required|in:active,inactive',
        ]);

        Department::create([
            'company_id' => $request->company_id,
            'department_name' => $request->department_name,
            'department_code' => $request->department_code,
            'department_head' => $request->department_head,
            'status' => $request->status,
        ]);

        return redirect()->route('masters.organisation.department')
            ->with('success', 'Department created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = 'Master / Organisation / Department Edit';
        $data['department'] = Department::findOrFail($id);
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.department.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $department = Department::findOrFail($id);

        $request->validate([
            'company_id' => 'required',
            'department_name' => 'required|string|max:255',
            'department_code' => 'required|string|max:50|unique:departments,department_code,' . $department->id,
            'status' => 'required|in:active,inactive',
        ]);

        $department->update([
            'company_id' => $request->company_id,
            'department_name' => $request->department_name,
            'department_code' => $request->department_code,
            'department_head' => $request->department_head,
            'status' => $request->status,
        ]);

        return redirect()->route('masters.organisation.department')
            ->with('success', 'Department updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['success' => false, 'message' => 'Department not found.']);
        }

        try {
            $department->delete();
            return response()->json(['success' => true, 'message' => 'Department deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong.']);
        }
    }
}
