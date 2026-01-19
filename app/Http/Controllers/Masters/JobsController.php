<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\CountryState;
use App\Models\Gender;
use App\Models\JobApplication;
use App\Models\JobHrms;
use App\Models\JafQuestion;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\AcflJobs;
use App\Models\City;
use App\Models\Employee;
use App\Models\JobSkill;
use App\Models\Skills;
use App\Models\StateCity;
use App\Models\MaritalStatus;
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

    public function list(Request $request)
    {
        $search = $request->input('search.value');
        $limit  = $request->input('length', 10);
        $start  = $request->input('start', 0);

        $query = AcflJobs::with(['designation', 'state']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('job_title', 'like', "%{$search}%")
                    ->orWhereHas('designation', fn($q) => $q->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('state', fn($q) => $q->where('name', 'like', "%{$search}%"));
            });
        }

        $recordsTotal = AcflJobs::count();
        $recordsFiltered = $query->count();

        $jobs = $query->orderBy('id', 'desc')
            ->skip($start)
            ->take($limit)
            ->get();

        $rows = [];

        foreach ($jobs as $index => $job) {

            $cityIds = is_array($job->city_ids) ? $job->city_ids : [];

            $cityNames = StateCity::whereIn('id', $cityIds)
                ->pluck('name')
                ->toArray();

            $rows[] = [
                'DT_RowIndex' => $start + $index + 1,
                'publish_date' => optional($job->created_at)->format('d M Y'),
                'job_title' => $job->job_title ?? '--',
                'designation' => optional($job->designation)->name ?? '--',
                'state' => optional($job->state)->name ?? '--',
                'city' => implode(', ', $cityNames) ?: '--',
                'experience' => "{$job->min_exp} - {$job->max_exp} Years",
                'status' => $job->status === 'PUBLISHED'
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>',
                'action' => '<button class="btn btn-sm btn-warning copy-btn">
                            <i class="ti ti-copy"></i>
                        </button>',
            ];
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $rows,
        ]);
    }


    public function recommendedJob()
    {
        $data['title'] = 'Recruitment / Jobs / Recommended-Job';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        $jobs = AcflJobs::with(['branch.company', 'state'])->get();

        foreach ($jobs as $job) {
            $cityIds = $job->city_ids;
            $job->city_names = StateCity::whereIn('id', $cityIds)
                ->pluck('name')
                ->toArray();
            $skillIds = json_decode($job->test_skills, true) ?? [];
            $job->skill_names = Skills::whereIn('id', $skillIds)
                ->pluck('name')
                ->toArray();
            $job->state_name = optional($job->state)->name ?? 'State not available';
            $job->branchName = optional($job->branch)->branch_name ?? 'Branch not available';
            $job->company_logo = optional($job->branch->company)->company_logo;
        }
        $data['jobs'] = $jobs;
        return view('home.jobs.recommended-job', $data);
    }

    public function recommendedJobApi()
    {
        $jobs = AcflJobs::all();

        $jobsData = [];

        foreach ($jobs as $job) {
            $cityIds = $job->city_ids;
            $cityNames = StateCity::whereIn('id', $cityIds)
                ->pluck('name')
                ->toArray();
            $stateName = optional($job->state)->name ?? 'State not available';
            $jobsData[] = [
                'id' => $job->id,
                'job_title' => $job->job_title,
                'designation_id' => $job->designation_id,
                'test_skills' => $job->test_skills,
                'positions' => $job->positions,
                'job_type_id' => $job->job_type_id,
                'ctc_from' => $job->ctc_from,
                'ctc_to' => $job->ctc_to,
                'min_exp' => $job->min_exp,
                'max_exp' => $job->max_exp,
                'state' => $stateName,
                'cities' => $cityNames,
                'job_description' => $job->job_description,
                'qualifications' => $job->qualifications,
                'keywords' => $job->keywords,
                'interview_date' => $job->interview_date,
                'status' => $job->status,
                'created_at' => $job->created_at->toDateTimeString(),
                'updated_at' => $job->updated_at->toDateTimeString(),
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $jobsData,
        ]);
    }

    public function jobDetails($slug)
    {
        preg_match('/(\d+)\d{6}$/', $slug, $matches);
        $jobId = $matches[1] ?? null;

        if (!$jobId) {
            abort(404, 'Invalid Job URL');
        }

        $job = AcflJobs::with(['branch.company', 'state'])->findOrFail($jobId);

        $cityNames = StateCity::whereIn('id', $job->city_ids ?? [])
            ->pluck('name')
            ->toArray();

        $skillIds = json_decode($job->test_skills, true) ?? [];
        $skillNames = Skills::whereIn('id', $skillIds)
            ->pluck('name')
            ->toArray();

        $jobDetails = [
            'id' => $job->id,
            'title' => $job->job_title,
            'description' => $job->job_description,
            'skills' => $skillNames,
            'min_exp' => $job->min_exp,
            'max_exp' => $job->max_exp,
            'ctc_from' => $job->ctc_from,
            'ctc_to' => $job->ctc_to,
            'posted' => $job->created_at->diffForHumans(),
            'branch_name' => $job->branch->branch_name ?? 'N/A',
            'state_name' => $job->state->name ?? 'N/A',
            'city_names' => $cityNames,
            'company_logo' => optional($job->branch->company)->company_logo ?? null, // ✅ from company table
        ];

        return view('home.jobs.job-deatils', [
            'title' => $job->job_title . " - Job Details",
            'job' => $jobDetails
        ]);
    }


    public function create()
    {
        $data['title'] = 'Recruitment / Jobs Create ';
        $data['designation'] = Designation::all();
        $data['jobsType'] = JobCategory::where('type', 'job type')->get();
        $data['states'] = CountryState::where('country_id', 101)->get();
        $data['branch'] = Branch::all();
        $data['jobSkills'] = Skills::orderBy('name')->get();


        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);

        return view('home.jobs.create', $data);
    }

    public function appliedCandidate()
    {
        $data['title'] = 'Recruitment / Jobs / Applied Candidate';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.jobs.applied-candidate', $data);
    }

    public function appliedCandidateAjax(Request $request)
    {
        try {
            $search = $request->input('search.value');
            $limit = $request->input('length', 10);
            $start = $request->input('start', 0);
            $query = Employee::where('applied_status', 'Applied');
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('employee_name', 'like', "%{$search}%")
                        ->orWhere('employee_email', 'like', "%{$search}%")
                        ->orWhere('employee_mobile', 'like', "%{$search}%");
                });
            }
            $totalRecords = $query->count();
            $candidates = $query
                ->orderBy('created_at', 'desc')
                ->skip($start)
                ->take($limit)
                ->get();
            $rows = [];
            foreach ($candidates as $index => $candidate) {
                $gender = match ($candidate->employee_gender) {
                    1 => 'Male',
                    2 => 'Female',
                    3 => 'Other',
                    default => 'N/A'
                };
                $stateName = optional(CountryState::find($candidate->posting_state))->name ?? 'N/A';
                $cityName = optional(StateCity::find($candidate->posting_city))->name ?? 'N/A';
                $rows[] = [
                    'DT_RowIndex' => $start + $index + 1,
                    'name' => $candidate->employee_name . ' <button class="btn btn-sm btn-primary ms-2 view-details"        data-id="' . $candidate->employee_id . '"><i class="fa fa-eye"></i></button>',
                    'email' => $candidate->employee_email,
                    'phone' => $candidate->employee_mobile,
                    'gender' => $gender,
                    'state' => $stateName,
                    'city' => $cityName,
                    'action' => '<a href="' . route('employee.onboarding', $candidate->employee_id) . '" class="btn btn-sm btn-primary">Onboarding</a>',
                ];
            }
            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $rows,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }





    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'job_title' => 'required|string|max:255',
            'designation_id' => 'required|exists:designations,id',
            'test_skills' => 'required|array',
            'positions' => 'required|integer|min:1',
            'job_type_id' => 'required|exists:job_categories,id',
            'ctc_from' => 'nullable|numeric',
            'ctc_to' => 'nullable|numeric|gte:ctc_from',
            'min_exp' => 'required|integer|min:0',
            'max_exp' => 'required|integer|gte:min_exp',
            'state_id' => 'required|exists:country_states,id',
            'city_ids' => 'required|array',
            'job_description' => 'required|string|min:10',
            'qualifications' => 'required|array',
            'keywords' => 'nullable|string',
            'interview_date' => 'nullable|date',
            'status' => 'required|in:DRAFT,PUBLISHED',
        ]);

        DB::beginTransaction();

        try {
            AcflJobs::create([
                'branch_id' => $request->branch_id,
                'job_title' => $request->job_title,
                'designation_id' => $request->designation_id,
                'test_skills' => $request->test_skills,
                'positions' => $request->positions,
                'job_type_id' => $request->job_type_id,
                'ctc_from' => $request->ctc_from,
                'ctc_to' => $request->ctc_to,
                'min_exp' => $request->min_exp,
                'max_exp' => $request->max_exp,
                'state_id' => $request->state_id,
                'city_ids' => $request->city_ids,
                'job_description' => strip_tags($request->job_description), 
                'qualifications' => $request->qualifications,
                'keywords' => $request->keywords,
                'interview_date' => $request->interview_date,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('recruitment.jobs')
                ->with('success', 'Job posted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }




    public function jobForm($slug)
    {
        $jobId = last(explode('-', $slug));

        $job = AcflJobs::findOrFail($jobId);

        // ✅ Job-wise questions
        $questions = JafQuestion::where('job_id', $jobId)
            ->orderBy('order', 'asc')
            ->get();
        $genders = Gender::all();
        $MaritalStatus = MaritalStatus::all();
        $state = CountryState::where('country_id', 101)->get();
        $years = range(date('Y'), 1980);
        $skills = Skills::all();
        return view('home.jobs.job-apply-form', [
            'title' => 'Recruitment / Jobs / Apply Form',
            'job' => $job,
            'questions' => $questions,
            'genders' => $genders,
            'MaritalStatus' => $MaritalStatus,
            'state' => $state,
            'years' => $years,
            'skills' => $skills,
        ]);
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
