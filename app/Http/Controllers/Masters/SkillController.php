<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $status = $request->input('status'); // dropdown se aayega

        // Base query
        $query = Skills::query();

        // Total records (without filter)
        $recordsTotal = Skills::count();

        // Search filter
        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%");
        }

        // Status filter
        if (!empty($status)) {
            $query->where('status', $status);
        }

        // Filtered count
        $recordsFiltered = $query->count();

        // Pagination
        $skills = $query
            ->offset($start)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->get();

        // Prepare rows
        $rows = [];
        foreach ($skills as $index => $skill) {
            $rows[] = [
                'id' => $skill->id,
                'DT_RowIndex' => $start + $index + 1,
                'name' => $skill->name,
                'status' => '<span class="badge ' .
                    ($skill->status === 'Active' ? 'bg-success' : 'bg-danger') .
                    '">' . $skill->status . '</span>',
            ];
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $rows,
        ]);
    }


    public function create()
    {
        $data['title'] = 'Master / Organisation / Skill Create';
        return view('home.skills.create', $data);
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:skills,name',
            'status' => 'required|in:Active,Inactive',
        ]);

        try {

            // Unique slug generate
            $slug = Str::slug($request->name);
            $count = Skills::where('slug', 'like', "{$slug}%")->count();
            $finalSlug = $count ? "{$slug}-" . ($count + 1) : $slug;

            Skills::create([
                'name' => $request->name,
                'slug' => $finalSlug,
                'status' => $request->status,
            ]);

            return redirect()
                ->route('settings.skills')
                ->with('success', 'Job Skill created successfully');
        } catch (\Exception $e) {

            Log::error('Skill Create Error: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong while creating Job Skill');
        }
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
            'name'   => 'required|string|max:255|unique:skills,name,' . $jobSkill->id,
            'status' => 'required|in:Active,Inactive',
        ]);

        // Slug regenerate (unique)
        $slug = Str::slug($request->name);
        $count = Skills::where('slug', 'like', "{$slug}%")
            ->where('id', '!=', $jobSkill->id)
            ->count();

        $finalSlug = $count ? "{$slug}-" . ($count + 1) : $slug;

        $jobSkill->update([
            'name'   => $request->name,
            'slug'   => $finalSlug,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('settings.skills')
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
