<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Country; // corrected namespace
use Illuminate\Support\Facades\DB;
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['countries'] = Country::all();
        $data['title'] = 'Masters/Organisation/Branch';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.branch.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */


    public function create()
    {
        $data['title'] = 'Masters/Organisation/Branch/Create';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        $data['country'] = Country::where('id', 101)->get();
        $data['companies'] = Company::all();
        return view('home.branch.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'branch_name' => 'required|string|max:255',
            'branch_code' => 'required',
            'branch_owner_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|unique:branches,email',
            'address_1' => 'required|string',
            'country' => 'required|integer',
            'state' => 'required|integer',
            'city' => 'required|integer',
            'pincode' => 'required|string|max:10',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();

            Branch::create([
                'company_id' => $request->company_id,
                'branch_name' => $request->branch_name,
                'branch_code' => $request->branch_code,
                'branch_owner_name' => $request->branch_owner_name,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'address_1' => $request->address_1,

                // 🔹 Ye dono fields form me nahi hai → default NA
                'gst_number' => 'NA',
                'address_2' => 'NA',

                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()
                ->route('masters.organisation.branch')
                ->with('success', 'Branch created successfully!');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function list(Request $request)
    {
        try {
            $search = $request->input('search')['value'] ?? null;
            $limit = $request->input('length', 10);
            $start = $request->input('start', 0);

            // 🔹 Load Relations
            $query = Branch::with(['company', 'countryData', 'stateData', 'cityData']);

            // 🔹 Search
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('branch_name', 'like', "%{$search}%")
                        ->orWhere('branch_code', 'like', "%{$search}%")
                        ->orWhere('branch_owner_name', 'like', "%{$search}%")
                        ->orWhere('contact_number', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            }

            // 🔹 Total count
            $totalRecord = $query->count();

            // 🔹 Pagination
            $branches = $query->skip($start)->take($limit)->get();

            // 🔹 Rows for DataTable
            $rows = [];
            foreach ($branches as $index => $branch) {
                $rows[] = [
                    'DT_RowIndex' => $start + $index + 1,
                    'company_name' => $branch->company->company_name ?? '--',
                    'branch_name' => $branch->branch_name ?? '--',
                    'branch_code' => $branch->branch_code ?? '--',
                    'branch_owner_name' => $branch->branch_owner_name ?? '--',
                    'contact_number' => $branch->contact_number ?? '--',
                    'email' => $branch->email ?? '--',

                    // 🔹 Country / State / City in name format
                    'country_name' => $branch->countryData->name ?? '--',
                    'state_name' => $branch->stateData->name ?? '--',
                    'city_name' => $branch->cityData->name ?? '--',

                    'status' => $branch->status == 'Active'
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>',

                    'action' => '<a href="' . route('masters.organisation.branch.edit', $branch->id) . '" class="btn btn-sm btn-primary">Edit</a>',
                ];
            }

            // 🔹 Datatable Output
            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => $totalRecord,
                'recordsFiltered' => $totalRecord,
                'data' => $rows,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error fetching branch list.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $branch = \App\Models\Branch::findOrFail($id);
        $countries = Country::all();
        return view('admin.branch.edit', compact('branch', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $branch = \App\Models\Branch::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'address' => 'nullable|string',
        ]);

        $branch->update([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.branches.index')->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $branch = \App\Models\Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('admin.branches.index')->with('success', 'Branch deleted successfully.');
    }
}
