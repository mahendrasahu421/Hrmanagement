<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        $data['title'] = 'Master / Organisation / Policy';
        return view('home.policy.index', $data);
    }

    public function list(Request $request)
    {
        $search = $request->input('search')['value'] ?? null;
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        $query = Policy::with('department');

        if ($search) {
            $query->where('policy_title', 'like', "%{$search}%")
                ->orWhere('policy_code', 'like', "%{$search}%")
                ->orWhereHas('department', function ($q) use ($search) {
                    $q->where('department_name', 'like', "%{$search}%");
                });
        }

        $totalRecord = $query->count();
        $policies = $query->skip($start)->take($limit)->get();

        $rows = [];
        foreach ($policies as $index => $policy) {
            $rows[] = [
                'id' => $policy->id,
                'DT_RowIndex' => $start + $index + 1,
                'title' => $policy->policy_title,
                'code' => $policy->policy_code,
                'department' => $policy->department ? $policy->department->department_name : '',
                'effective_from' => $policy->effective_from,
                'status' => $policy->status === 'Active'
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
    }

    public function create()
    {
        $data['title'] = 'Master / Organisation / Policy Create';
        $data['departments'] = Department::all();
        return view('home.policy.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'policy_title' => 'required|string|max:255',
            'policy_code' => 'required|string|max:50|unique:policies,policy_code',
            'department_id' => 'required|integer',
            'effective_from' => 'required|date',
            'status' => 'required|in:Active,Inactive',
            'policy_file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->only(
            'policy_title',
            'policy_code',
            'department_id',
            'effective_from',
            'expiry_date',
            'status',
            'description'
        );
        $data['description'] = strip_tags($data['description']);
        if ($request->hasFile('policy_file')) {
            $file = $request->file('policy_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('policy_documents'), $filename);
            $data['policy_document'] = 'policy_documents/' . $filename;
        }
        Policy::create($data);

        return redirect()->route('masters.organisation.policy')
            ->with('success', 'Policy created successfully!');
    }

    public function edit($id)
    {
        $data['title'] = 'Master / Organisation / Policy Edit';
        $data['policy'] = Policy::findOrFail($id);
        $data['departments'] = Department::all();
        return view('home.policy.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $policy = Policy::findOrFail($id);

        $request->validate([
            'policy_title' => 'required|string|max:255',
            'policy_code' => 'required|string|max:50|unique:policies,policy_code,' . $policy->id,
            'department_id' => 'required|integer',
            'effective_from' => 'required|date',
            'status' => 'required|in:Active,Inactive',
            'policy_file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->only(
            'policy_title',
            'policy_code',
            'department_id',
            'effective_from',
            'expiry_date',
            'status',
            'description'
        );
        $data['description'] = strip_tags($data['description']);
        if ($request->hasFile('policy_file')) {
            if ($policy->policy_document && file_exists(public_path($policy->policy_document))) {
                unlink(public_path($policy->policy_document));
            }
            $file = $request->file('policy_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('policy_documents'), $filename);
            $data['policy_document'] = 'policy_documents/' . $filename;
        }

        $policy->update($data);

        return redirect()->route('masters.organisation.policy')
            ->with('success', 'Policy updated successfully!');
    }

    public function destroy($id)
    {
        $policy = Policy::find($id);
        if (!$policy) {
            return response()->json(['success' => false, 'message' => 'Policy not found.']);
        }
        $policy->delete();
        return response()->json(['success' => true, 'message' => 'Policy deleted successfully!']);
    }
}
