<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcflJobs;
use App\Models\StateCity;
class RecommendedJobController extends Controller
{
    public function index()
    {
        // http://127.0.0.1:8000/api/jobs
        $jobs = AcflJobs::all();

        $jobsData = [];

        foreach ($jobs as $job) {

            // city names
            $cityIds = $job->city_ids; // assume this is array
            $cityNames = StateCity::whereIn('id', $cityIds)
                ->pluck('name')
                ->toArray();

            // state name
            $stateName = optional($job->state)->name ?? 'State not available';

            // branch name (assume $job->branch relation exists)
            $branchName = optional($job->branch)->branch_name ?? 'Branch not available';

            // prepare API response
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
                'branch' => $branchName, // added branch
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

}
