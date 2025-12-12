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
use App\Models\StateCity;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    
    public function index()
    {
        $data['title'] = 'Recruitment / Jobs ';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        $data['jobs'] = AcflJobs::with(['designation', 'state'])->orderBy('id', 'DESC')->get();
        return view('home.jobs.index', $data);
    }

    public function recommendedJob()
    {
        $data['title'] = 'Recruitment / Jobs / Recommended-Job';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.jobs.recommended-job', $data);
    }

    public function jobDetails()
    {
        $data['title'] = 'Recruitment / Jobs / Recommended-Job';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.jobs.job-deatils', $data);
    }

    public function list(Request $request)
    {
        try {
            $search = $request->input('search')['value'] ?? null;
            $limit = $request->input('length', 10);
            $start = $request->input('start', 0);

            $query = AcflJobs::with(['designation', 'state']);

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('job_title', 'like', "%{$search}%")
                        ->orWhereHas('designation', fn($q) => $q->where('name', 'like', "%{$search}%"))
                        ->orWhereHas('state', fn($q) => $q->where('name', 'like', "%{$search}%"));
                });
            }

            $totalRecord = $query->count();

            $jobs = $query->skip($start)->take($limit)->orderBy('id', 'DESC')->get();

            $rows = [];
            foreach ($jobs as $index => $job) {
                $cityIds = json_decode($job->city_ids, true) ?? [];
                $cityNames = StateCity::whereIn('id', $cityIds)->pluck('name')->toArray();

                $rows[] = [
                    'DT_RowIndex' => $start + $index + 1,
                    'publish_date' => $job->created_at->format('d M Y'),
                    'job_title' => $job->job_title,
                    'designation' => $job->designation->name ?? '--',
                    'state' => $job->state->name ?? '--',
                    'city' => !empty($cityNames) ? implode(', ', $cityNames) : '--',
                    'experience' => $job->min_exp . ' - ' . $job->max_exp . ' Years',
                    'status' => $job->status == 'PUBLISHED'
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>',
                    'action' => '<a href="#" class="btn btn-sm btn-primary"><i class="ti ti-share-2"></i></a>
                             <button class="btn btn-sm btn-warning copy-btn"><i class="ti ti-copy"></i></button>',
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
                'message' => 'Something went wrong while fetching job records.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }


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


    public function jobForm()
    {
        $data['title'] = 'Recruitment / Jobs / Apply Form';
        return view('home.jobs.job-apply-form', $data);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
