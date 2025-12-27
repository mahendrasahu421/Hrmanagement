<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    /**
     * Display leave type listing page.
     */
    public function index()
    {
        $data['title'] = 'Master / Organisation / Leave Type';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);

        return view('home.leave-type.index', $data);
    }

    /**
     * Return LeaveType list for DataTable (AJAX).
     */
    public function list(Request $request)
    {
        try {
            $search = $request->input('search')['value'] ?? null;
            $limit = $request->input('length', 10);
            $start = $request->input('start', 0);
            $query = LeaveType::query();

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('leave_name', 'like', "%{$search}%")
                        ->orWhere('leave_code', 'like', "%{$search}%");
                });
            }

            $totalRecord = $query->count();
            $leaveTypes = $query->skip($start)->take($limit)->get();
            $rows = [];

            foreach ($leaveTypes as $index => $leave) {
                $rows[] = [
                    'id' => $leave->id,
                    'DT_RowIndex' => $start + $index + 1,
                    'leave_name' => $leave->leave_name,
                    'leave_code' => $leave->leave_code,
                    'total_leaves' => $leave->total_leaves,
                    'carry_forward' => $leave->carry_forward ? 'Yes' : 'No',
                    'encashable' => $leave->encashable ? 'Yes' : 'No',
                    'applicable_for' => $leave->applicable_for,
                    'leave_category' => $leave->leave_category,
                    'status' => $leave->status === 'Active'
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
                'message' => 'Something went wrong while fetching leave types.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show create leave type form.
     */
    public function create()
    {
        $data['title'] = 'Master / Organisation / Leave Type Create';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        $data['compneys'] = Company::all();
        return view('home.leave-type.create', $data);
    }

    /**
     * Store a new leave type.
     */
    public function store(Request $request)
    {
        try {
            // Validation
            $request->validate([
                'company_id' => 'required|exists:companies,id',
                'leave_name' => 'required|string|max:255',
                'leave_code' => 'required|string|max:50|unique:leave_types,leave_code',
                'total_leaves' => 'required|integer|min:0',
                'carry_forward' => 'required|boolean',
                'encashable' => 'required|boolean',
                'applicable_for' => 'required|in:Male,Female,All',
                'leave_category' => 'required|in:Paid,Unpaid,Special',
                'status' => 'required|in:Active,Inactive',
                'description' => 'nullable|string',
            ]);

            // Create Leave Type
            LeaveType::create([
                'company_id' => $request->company_id,
                'leave_name' => $request->leave_name,
                'leave_code' => $request->leave_code,
                'total_leaves' => $request->total_leaves,
                'carry_forward' => $request->carry_forward,
                'encashable' => $request->encashable,
                'applicable_for' => $request->applicable_for,
                'leave_category' => $request->leave_category,
                'status' => $request->status,
                'description' => $request->description,
            ]);

            return redirect()
                ->route('settings.leave-type')
                ->with('success', 'Leave Type created successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Agar validation fail ho jaye
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            // General exceptions ke liye
            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage())
                ->withInput();
        }
    }


    /**
     * Show edit leave type form.
     */
    public function edit(string $id)
    {
        $data['title'] = 'Master / Organisation / Leave Type Edit';
        $data['leaveType'] = LeaveType::findOrFail($id);
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        $data['companies'] = Company::all();
        return view('home.leave-type.edit', $data);
    }

    /**
     * Update leave type.
     */
    public function update(Request $request, string $id)
    {
        $leaveType = LeaveType::findOrFail($id);

        $request->validate([
            'leave_name' => 'required|string|max:255',
            'leave_code' => 'required|string|max:50|unique:leave_types,leave_code,' . $leaveType->id,
            'total_leaves' => 'required|integer|min:0',
            'carry_forward' => 'required|boolean',
            'encashable' => 'required|boolean',
            'applicable_for' => 'required|in:Male,Female,All',
            'leave_category' => 'required|in:Paid,Unpaid,Special',
            'status' => 'required|in:Active,Inactive',
            'description' => 'nullable|string',
        ]);

        $leaveType->update($request->all());

        return redirect()
            ->route('settings.leave-type')
            ->with('success', 'Leave Type updated successfully!');
    }

    /**
     * Delete leave type.
     */
    public function destroy(string $id)
    {
        $leaveType = LeaveType::find($id);

        if (!$leaveType) {
            return response()->json(['success' => false, 'message' => 'Leave Type not found.']);
        }

        try {
            $leaveType->delete();
            return response()->json(['success' => true, 'message' => 'Leave Type deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong.']);
        }
    }
}
