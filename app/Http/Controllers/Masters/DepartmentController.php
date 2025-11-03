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
        $data['title'] = 'Master/ Orgnaigation / Department';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        $data['departments'] = Department::select('id', 'department_name', 'department_code', 'department_head', 'status')
            ->orderBy('id', 'desc')
            ->get();
        return view('home.department.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Master/ Orgnaigation / Department';
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
        $data['title'] = 'Masters / Organisation / Department Edit';
        $data['department'] = Department::findOrFail($id);
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        // echo "working";exit;
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
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('masters.organisation.department')
            ->with('success', 'Department deleted successfully!');
    }
}
