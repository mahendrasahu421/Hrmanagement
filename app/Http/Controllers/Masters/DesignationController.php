<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
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
        $data['title'] = 'Designation';
        $data['titleRoute'] = 'Settings / Masters / Designation';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.designation.index', $data);
    }


    public function list(Request $request)
    {
        try {
            $search = $request->input('search')['value'] ?? null;
            $limit = $request->input('length', 10);
            $start = $request->input('start', 0);

            // ✅ Eager load relationships
            $query = Designation::with(['company', 'category', 'department']);

            // ✅ Apply search filter
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%")
                        ->orWhereHas('company', function ($comp) use ($search) {
                            $comp->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('category', function ($cat) use ($search) {
                            $cat->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('department', function ($dept) use ($search) {
                            $dept->where('department_name', 'like', "%{$search}%");
                        });
                });
            }

            // ✅ Total before pagination
            $totalRecord = $query->count();

            // ✅ Apply pagination and fetch
            $designations = $query->skip($start)->take($limit)->get();

            // ✅ Prepare DataTable rows
            $rows = [];
            foreach ($designations as $index => $desig) {
                $rows[] = [
                    'DT_RowIndex' => $start + $index + 1,
                    'company_name' => $desig->company->company_name ?? '--',
                    'category_name' => $desig->category->name ?? '--',
                    'department_name' => $desig->department->department_name ?? '--',
                    'designation_name' => $desig->name ?? '--',
                    'designation_code' => $desig->code ?? '--',
                    'kpi_weightage' => $desig->kpi_weightage ?? '0',
                    'competency_weight' => $desig->competency_weight ?? '0',
                    'status' => $desig->status == 'Active'
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>',
                    'id' => $desig->id,
                    // 'action' => '<a href="' . route('designation.show', $desig->id) . '" class="btn btn-sm btn-primary">View</a>',
                ];
            }

            // ✅ Return JSON for DataTable
            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => $totalRecord,
                'recordsFiltered' => $totalRecord,
                'data' => $rows,
            ]);
        } catch (\Exception $e) {
            \Log::error('Designation List Error: ' . $e->getMessage());

            return response()->json([
                'error' => true,
                'message' => 'Something went wrong while fetching designation records.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Master / Organisation / Designation Create';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        $data['departments'] = Department::all();
        $data['categorys'] = Category::all();
        $data['companies'] = Company::all();
        return view('home.designation.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());exit;
        try {
            $request->validate([
                'company_id' => 'required|integer',
                'category_id' => 'required|integer',
                'department_id' => 'required|integer',
                'name' => 'required|string|max:255',
                'designation_code' => 'required|string|max:50|unique:designations,code',
                'kpi_weightage' => 'required|numeric',
                'competency_weight' => 'required|numeric',
                'status' => 'required|in:Active,Inactive',
            ]);

            Designation::create([
                'company_id' => $request->company_id,
                'category_id' => $request->category_id,
                'department_id' => $request->department_id,
                'name' => $request->name,
                'code' => $request->designation_code, // ✅ fixed mapping
                'kpi_weightage' => $request->kpi_weightage,
                'competency_weight' => $request->competency_weight,
                'status' => $request->status === 'Active' ? 1 : 0, // ✅ convert to boolean
            ]);

            return redirect()->route('settings.designation')
                ->with('success', 'Designation created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Designation Store Error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage())
                ->withInput();
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['title'] = 'Master / Organisation / Designation Edit';
        $data['designation'] = Designation::findOrFail($id);
        $data['companies'] = Company::all();
        $data['categories'] = Category::all();
        $data['departments'] = Department::all();

        return view('home.designation.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $designation = Designation::findOrFail($id);

        $request->validate([
            'company_id' => 'required|integer',
            'category_id' => 'required|integer',
            'department_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'designation_code' => 'required|string|max:50|unique:designations,code,' . $designation->id,
            'kpi_weightage' => 'required|numeric',
            'competency_weight' => 'required|numeric',
            'status' => 'required|in:Active,Inactive',
        ]);

        $designation->update([
            'company_id' => $request->company_id,
            'category_id' => $request->category_id,
            'department_id' => $request->department_id,
            'name' => $request->name,
            'code' => $request->designation_code,
            'kpi_weightage' => $request->kpi_weightage,
            'competency_weight' => $request->competency_weight,
            'status' => $request->status,
        ]);

        return redirect()->route('settings.designation')
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
