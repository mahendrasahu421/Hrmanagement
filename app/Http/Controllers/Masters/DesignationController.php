<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Master / Organisation / Designation';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.designation.index', $data);
    }


    public function list(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'designation_name',
            2 => 'designation_code',
            3 => 'status'
        ];

        $totalData = Designation::whereNull('deleted_at')->count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = $columns[$orderColumnIndex] ?? 'id';
        $orderDir = $request->input('order.0.dir') ?? 'desc';
        $searchValue = $request->input('search.value');
        $query = Designation::query()
            ->whereNull('deleted_at')
            ->with('department');

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('designation_name', 'like', "%{$searchValue}%")
                    ->orWhere('designation_code', 'like', "%{$searchValue}%");
            });

            $totalFiltered = $query->count();
        }

        $designations = $query->orderBy($orderColumn, $orderDir)
            ->skip($start)
            ->take($limit)
            ->get();

        $data = [];
        foreach ($designations as $designation) {
            $statusBadge = $designation->status == 1
                ? '<span class="badge bg-success"><i class="ti ti-point-filled me-1"></i>Active</span>'
                : '<span class="badge bg-danger"><i class="ti ti-point-filled me-1"></i>Inactive</span>';

            $editBtn = '<a href="' . route('masters.organisation.designation.edit', $designation->id) . '" 
            class="btn btn-sm btn-primary me-2" title="Edit"><i class="ti ti-edit"></i></a>';

            $deleteBtn = '<a href="' . route('masters.organisation.designation.destroy', $designation->id) . '" 
            class="btn btn-sm btn-danger deleteDesignation">
                <i class="ti ti-trash"></i>
            </a>';

            $data[] = [
                'designation_name' => e($designation->designation_name),
                'designation_code' => e($designation->designation_code),
                'status' => $statusBadge,
                'action' => $editBtn . $deleteBtn,
            ];
        }

        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Master / Organisation / Designation Create';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        $data['departments'] = Department::where('status', 'active')->get();
        return view('home.designation.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'designation_name' => 'required|string|max:255',
            'designation_code' => 'required|string|max:50|unique:designations,designation_code',
            'status' => 'required|in:1,0',
        ]);

        Designation::create([
            'company_id' => $request->company_id,
            'department_id' => $request->department_id,
            'designation_name' => $request->designation_name,
            'designation_code' => $request->designation_code,
            'designation_head' => $request->designation_head,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('masters.organisation.designation')
            ->with('success', 'Designation created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = 'Master / Organisation / Designation Edit';
        $data['designation'] = Designation::findOrFail($id);
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.designation.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $designation = Designation::findOrFail($id);

        $request->validate([
            'company_id' => 'required',
            'designation_name' => 'required|string|max:255',
            'designation_code' => 'required|string|max:50|unique:designations,designation_code,' . $designation->id,
            'status' => 'required|in:1,0',
        ]);

        $designation->update([
            'company_id' => $request->company_id,
            'designation_name' => $request->designation_name,
            'designation_code' => $request->designation_code,
            'designation_head' => $request->designation_head,
            'status' => $request->status,
        ]);

        return redirect()->route('masters.organisation.designation')
            ->with('success', 'Designation updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $designation = Designation::find($id);

        if (!$designation) {
            return response()->json(['success' => false, 'message' => 'Designation not found.']);
        }

        try {
            $designation->delete();
            return response()->json(['success' => true, 'message' => 'Designation deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong while deleting.']);
        }
    }
}
