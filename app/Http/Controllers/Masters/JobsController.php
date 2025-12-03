<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\CountryState;
use App\Models\JobHrms;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\AcflJobs;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Recruitment / Jobs ';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        $data['jobs'] = AcflJobs::with(['designation', 'state'])
            ->orderBy('id', 'DESC')
            ->get();
        return view('home.jobs.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Recruitment / Jobs Create ';
        $data['designation'] = Designation::all();
        $data['jobsType'] = JobCategory::where('type', 'job type')->get();
        $data['states'] = CountryState::where('country_id', 101)->get();
        $data['branch'] = Branch::all();

        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);

        return view('home.jobs.create', $data);
    }

    public function appliedCandidate(Request $request)
    {
        $data['title'] = 'Recruitment / Jobs / Applied Candidate';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);

        return view('home.jobs.applied-candidate', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation (names now match your form)
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'job_title' => 'required|string|max:255',
            'designation_id' => 'required|exists:designations,id',
            'test_skills' => 'required|string',
            'positions' => 'required|integer|min:1',
            'job_type_id' => 'required|exists:job_categories,id',
            'ctc_from' => 'nullable|numeric',
            'ctc_to' => 'nullable|numeric',
            'min_exp' => 'required|integer|min:0',
            'max_exp' => 'required|integer|min:0',
            'state_id' => 'required|exists:country_states,id',
            'city_ids' => 'required|array',
            'job_description' => 'required|string',
            'qualifications' => 'required|array',
            'keywords' => 'nullable|string',
            'interview_date' => 'nullable|date',
            'status' => 'required|in:DRAFT,PUBLISHED',
        ]);

        try {
            DB::beginTransaction();

            $job = new AcflJobs();
            $job->branch_id = $request->branch_id;
            $job->job_title = $request->job_title;
            $job->designation_id = $request->designation_id;
            $job->test_skills = $request->test_skills;
            $job->positions = $request->positions;
            $job->job_type_id = $request->job_type_id;
            $job->ctc_from = $request->ctc_from;
            $job->ctc_to = $request->ctc_to;
            $job->min_exp = $request->min_exp;
            $job->max_exp = $request->max_exp;
            $job->state_id = $request->state_id;
            $job->city_ids = json_encode($request->city_ids);
            $job->job_description = $request->job_description;
            $job->qualifications = json_encode($request->qualifications);
            $job->keywords = $request->keywords;
            $job->interview_date = $request->interview_date;
            $job->status = $request->status;
            $job->save();

            DB::commit();

            return redirect()->route('recruitment.jobs')
                ->with('success', 'Job posted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Something went wrong while posting the job.')
                ->withInput();
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
