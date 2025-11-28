<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Company List';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.companey.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['country'] = Country::where('id', 101)->get();

        $data['title'] = 'Master/ Orgnaigation / Company';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.companey.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        try {
            // ✅ Validation with custom messages
            $validatedData = $request->validate([
                'company_name' => 'required|string|max:255',
                'company_code' => 'required|string|max:255|unique:companies,company_code',
                'contact_no' => 'required|string|max:20',
                'landline_no' => 'nullable|string|max:20',
                'email' => 'required|email|unique:companies,email',
                'gst_no' => 'nullable|string|max:50',
                'pan_no' => 'nullable|string|max:50',
                'cin_no' => 'nullable|string|max:50',
                'iec' => 'nullable|string|max:50',
                'website' => 'nullable|url|max:255',
                'company_logo' => 'nullable|image|mimes:png|max:2048',
                'address' => 'required|string',
                'country' => 'required|exists:countries,id',
                'state' => 'required|exists:states,id',
                'city' => 'required|exists:cities,id',
                'pincode' => 'required|string|max:10',
                'status' => 'required|in:Active,Inactive',
            ], [
                // ✅ Custom messages
                'company_name.required' => 'Please enter Company Name.',
                'company_code.required' => 'Please enter Company Code.',
                'company_code.unique' => 'This Company Code is already taken.',
                'contact_no.required' => 'Please enter Contact Number.',
                'email.required' => 'Please enter Email Address.',
                'email.email' => 'Please enter a valid Email Address.',
                'email.unique' => 'This Email is already taken.',
                'address.required' => 'Please enter Address.',
                'country.required' => 'Please select Country.',
                'state.required' => 'Please select State.',
                'city.required' => 'Please select City.',
                'pincode.required' => 'Please enter Pin Code.',
                'status.required' => 'Please select Status.',
                'company_logo.image' => 'Company Logo must be an image.',
                'company_logo.mimes' => 'Company Logo must be a PNG file.',
            ]);

            $company = new Company();
            $company->company_name = Str::title($validatedData['company_name']);
            $company->company_code = $validatedData['company_code'];
            $company->contact_no = $validatedData['contact_no'];
            $company->landline_no = $validatedData['landline_no'] ?? null;
            $company->email = $validatedData['email'];
            $company->gst_no = $validatedData['gst_no'] ?? null;
            $company->pan_no = $validatedData['pan_no'] ?? null;
            $company->cin_no = $validatedData['cin_no'] ?? null;
            $company->iec = $validatedData['iec'] ?? null;
            $company->website = $validatedData['website'] ?? null;
            $company->address = $validatedData['address'];
            $company->country = $validatedData['country'];
            $company->state = $validatedData['state'];
            $company->city = $validatedData['city'];
            $company->pincode = $validatedData['pincode'];
            $company->status = $validatedData['status'];

            if ($request->hasFile('company_logo')) {
                $file = $request->file('company_logo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/company'), $filename);
                $company->company_logo = $filename;
            }

            $company->save();

            return redirect()->route('masters.organisation.company')
                ->with('success', 'Company created successfully!');

        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }



    public function list(Request $request)
    {
        try {
            $search = $request->input('search')['value'] ?? null;
            $limit = $request->input('length', 10);
            $start = $request->input('start', 0);

            $query = Company::query();

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('company_name', 'like', "%{$search}%")
                        ->orWhere('company_code', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            }

            $totalRecord = $query->count();

            $companies = $query->skip($start)->take($limit)->get();

            $rows = [];
            foreach ($companies as $index => $company) {
                $logoUrl = $company->company_logo
                    ? asset('uploads/company/' . $company->company_logo)
                    : asset('default-logo.png'); // fallback image if no logo

                $rows[] = [
                    'DT_RowIndex' => $start + $index + 1,
                    'logo' => '<img src="' . $logoUrl . '" alt="Logo" style="width:50px; height:auto;">',
                    'company_name' => $company->company_name ?? '--',
                    'company_code' => $company->company_code ?? '--',
                    'contact_no' => $company->contact_no ?? '--',
                    'email' => $company->email ?? '--',
                    'status' => $company->status == 'Active'
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>',
                    'action' => '<a href="' . route('masters.organisation.company.edit', $company->id) . '" class="btn btn-sm btn-primary">Edit</a>',
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
                'message' => 'Something went wrong while fetching company records.',
                'exception' => $e->getMessage(),
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
