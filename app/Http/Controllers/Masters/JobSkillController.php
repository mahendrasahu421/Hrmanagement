<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\JobSkill;
use Illuminate\Http\Request;

class JobSkillController extends Controller
{
    public function index()
    {
        $data['title'] = 'Master / Organisation / JobSkill';
        return view('home.job-skill.index', $data);
    }

    public function list(Request $request)
    {
        $search = $request->input('search.value');
        $limit  = $request->input('length', 10);
        $start  = $request->input('start', 0);

        $query = JobSkill::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $total = $query->count();
        $skills = $query->skip($start)->take($limit)->get();

        $rows = [];
        foreach ($skills as $index => $skill) {
            $rows[] = [
                'id' => $skill->id,
                'DT_RowIndex' => $start + $index + 1,
                'name' => $skill->name,
                'status' => $skill->status === 'Active'
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>',
            ];
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $rows,
        ]);
    }

    public function create()
    {
        $data['title'] = 'Master / Organisation / JobSkill Create';
        return view('home.job-skill.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        JobSkill::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('settings.jobskill')
            ->with('success', 'JobSkill created successfully');
    }

    public function edit($id)
    {
        $jobSkill = JobSkill::findOrFail($id);

        return view('home.job-skill.edit', [
            'title' => 'Master / Organisation / Job Skill Edit',
            'jobSkill' => $jobSkill
        ]);
    }

    public function update(Request $request, $id)
    {
        $jobSkill = JobSkill::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        $jobSkill->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('settings.jobskill')
            ->with('success', 'Job Skill updated successfully!');
    }

    public function destroy($id)
    {
        try {
            $jobSkill = JobSkill::find($id);

            if (!$jobSkill) {
                return response()->json([
                    'success' => false,
                    'message' => 'Job Skill not found'
                ], 404);
            }
            $jobSkill->delete();

            return response()->json([
                'success' => true,
                'message' => 'Job Skill deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
