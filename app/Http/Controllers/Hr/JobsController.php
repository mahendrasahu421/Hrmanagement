<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobHrms;
use App\Models\JobCategory;
class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Add New Job';

        // Functional Area (Job Categories)
        $data['categories'] = JobCategory::where('type', 'Industry')
            ->where('status', 'Active')
            ->get();

        // Job Types
        $data['jobCategories'] = JobCategory::where('type', 'Job Type')
            ->where('status', 'Active')
            ->get();


        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        // Status options
        $data['statuses'] = ['Active', 'Inactive'];

        return view('hr.jobs.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Add New Job';

        // Functional Area (Job Categories)
        $data['categories'] = JobCategory::where('type', 'Industry')
            ->where('status', 'Active')
            ->get();

        // Job Types
        $data['jobCategories'] = JobCategory::where('type', 'Job Type')
            ->where('status', 'Active')
            ->get();


        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        // Status options
        $data['statuses'] = ['Active', 'Inactive'];

        return view('hr.jobs.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'nullable|exists:job_categories,id',
                'job_category_id' => 'nullable|exists:job_categories,id',
                'skills' => 'nullable|array',
                'positions' => 'required|integer|min:1',
                'ctc_from' => 'nullable|numeric',
                'ctc_to' => 'nullable|numeric',
                'min_experience' => 'nullable|integer|min:0',
                'max_experience' => 'nullable|integer|min:0',
                'locations' => 'nullable|array',
                'description' => 'required|string',
                'keywords' => 'nullable|string|max:255',
                'status' => 'required|in:Active,Inactive',
            ]);

            JobHrms::create([
                'title' => $validated['title'],
                'category_id' => $validated['category_id'] ?? null,
                'job_category_id' => $validated['job_category_id'] ?? null,
                'skills' => $validated['skills'] ?? [],
                'positions' => $validated['positions'],
                'ctc_from' => $validated['ctc_from'] ?? null,
                'ctc_to' => $validated['ctc_to'] ?? null,
                'min_experience' => $validated['min_experience'] ?? null,
                'max_experience' => $validated['max_experience'] ?? null,
                'locations' => $validated['locations'] ?? [],
                'description' => $validated['description'],
                'keywords' => $validated['keywords'] ?? null,
                'status' => $validated['status'],
            ]);

            return redirect()->back()->with('success', 'Job created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Job creation failed: ' . $e->getMessage());

            // Show only generic message to user
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong! r');
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
