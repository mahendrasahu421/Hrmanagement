<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Skills;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkillController extends Controller
{
    public function index()
    {
        $data['title'] = 'Master / Organisation / Skill';
        return view('home.skills.index', $data);
    }

    public function list(Request $request)
    {
        $search = $request->input('search.value');
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        // Columns mapping: DT_RowIndex -> id
        $columns = ['id', 'name'];

        $orderColumnIndex = $request->input('order.0.column', 0); // which column index is being sorted
        $orderDirection = $request->input('order.0.dir', 'asc'); // asc / desc

        $query = Skills::query();

        // Search filter
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $total = $query->count();

        // Apply sorting
        if (isset($columns[$orderColumnIndex])) {
            $query->orderBy($columns[$orderColumnIndex], $orderDirection);
        }

        $skills = $query->skip($start)->take($limit)->get();

        // Prepare rows
        $rows = [];
        foreach ($skills as $index => $skill) {
            $rows[] = [
                'id' => $skill->id,
                'DT_RowIndex' => $start + $index + 1,
                'name' => $skill->name,
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
        return view('home.skills.create', $data);
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Skills::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // slug auto generate
        ]);

        return redirect()->route('settings.skills')
            ->with('success', 'JobSkill created successfully');
    }

    public function edit($id)
    {
        $jobSkill = Skills::findOrFail($id);

        return view('home.skills.edit', [
            'title' => 'Master / Organisation / Job Skill Edit',
            'jobSkill' => $jobSkill
        ]);
    }

    public function update(Request $request, $id)
    {
        $jobSkill = Skills::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',

        ]);

        $jobSkill->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // slug auto-update

        ]);

        return redirect()->route('settings.skills')
            ->with('success', 'Job Skill updated successfully!');
    }


    public function destroy($id)
    {
        try {
            $jobSkill = Skills::find($id);

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
