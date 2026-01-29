<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class JobApplicationController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        // http://127.0.0.1:8000/api/job-application

        try {

            DB::beginTransaction();

            $request->validate([
                'job_id' => 'required|exists:acfl_jobs,id',
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                'dob' => 'required|date',
                'gender' => 'required',
                'marital_status' => 'required',
                'state_id' => 'required',
                'city_id' => 'required',
                'skills' => 'required|array',
                'resume' => 'required|file|mimes:pdf,doc,docx',
            ]);

            // Resume upload
            $resumePath = null;
            if ($request->hasFile('resume')) {
                $resumePath = $request->file('resume')->store('resumes', 'public');
            }

            $application = JobApplication::create([
                'job_id' => $request->job_id,
                'resume' => $resumePath,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'aadhaar_number' => $request->aadhaar_number,
                'dob' => $request->dob,
                'gender_id' => $request->gender,
                'marital_status_id' => $request->marital_status,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'skills' => $request->skills,

                // Academic
                'tenth_percent' => $request->tenth_percent,
                'tenth_year' => $request->tenth_year,
                'twelfth_percent' => $request->twelfth_percent,
                'twelfth_year' => $request->twelfth_year,
                'ug_percent' => $request->ug_percent,
                'ug_year' => $request->ug_year,
                'qualification' => $request->qualification,
                'degree' => $request->degree,
                'institute' => $request->institute,
                'final_year' => $request->final_year,

                // Experience
                'experience_years' => $request->experience_years,
                'experience_details' => $request->experience_details,

                // Job Questions
                'answers' => $request->answers,

                'status' => 'applied'
            ]);

            DB::commit();

            // return response()->json([
            //     'status' => true,
            //     'message' => 'Job Application submitted successfully',
            //     'data' => $application
            // ], 201);
            return redirect()
                ->route('recruitment.jobs.recommended-job')
                ->with('success', '✅ You have successfully applied for the job.');
        } catch (\Illuminate\Validation\ValidationException $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Job Application Store Error', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
}
