<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CandidateStatusMail;
use App\Mail\InterviewScheduleMail;
use App\Mail\InterviewStatusMail;
use App\Models\InterviewSchedule;

class OnboardingController extends Controller
{
    public function index($slug, $id)
    {
        $data['title'] = 'Employee / Onboarding';
        $candidate = JobApplication::with([
            'gender',
            'maritalStatus',
            'job',
            'state',
            'city',
        ])->findOrFail($id);
        $generatedSlug = Str::slug($candidate->first_name . ' ' . $candidate->last_name);
        if ($generatedSlug !== $slug) {
            abort(404);
        }
        $data['candidate'] = $candidate;
        return view('home.jobs.onboarding', $data);
    }

    public function updateShortlist(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:shortlisted,rejected'
        ]);
        $candidate = JobApplication::findOrFail($id);
        $candidate->status = $request->status;
        $candidate->save();
        $candidateEmail = $candidate->email;
        $adminEmails = User::where('role_id', 2)->pluck('email')->toArray();
        $hrEmails    = User::where('role_id', 3)->pluck('email')->toArray();
        $allRecipients = array_merge([$candidateEmail], $adminEmails, $hrEmails);
        Mail::to($allRecipients)->send(new CandidateStatusMail($candidate, $request->status));
        return response()->json([
            'success' => true,
            'status' => $candidate->status
        ]);
    }

    public function storeInterviewSchedule(Request $request, $id)
    {
        $request->validate([
            'round' => 'required|string',
            'mode' => 'required|in:offline,online,on_call',
            'date' => 'required|date',
            'time' => 'required',
            'venue' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $schedule = InterviewSchedule::create([
            'job_application_id' => $id,
            'round' => $request->round,
            'mode' => $request->mode,
            'date' => $request->date,
            'time' => $request->time,
            'venue' => $request->venue,
            'description' => $request->description,
        ]);

        $candidate = JobApplication::findOrFail($id);
        $candidate->status = 'interview_scheduled';
        $candidate->save();
        $adminEmails = User::where('role_id', 2)->pluck('email')->toArray(); 
        $hrEmails    = User::where('role_id', 3)->pluck('email')->toArray(); 
        $allRecipients = array_merge([$candidate->email], $adminEmails, $hrEmails);

        Mail::to($allRecipients)->send(new InterviewScheduleMail($candidate, $schedule));

        return response()->json([
            'success' => true,
            'id' => $schedule->id,
        ]);
    }

    public function updateInterviewStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:cleared,rejected,postponed',
            'comments' => 'nullable|string'
        ]);

        $schedule = InterviewSchedule::findOrFail($id);
        $schedule->status = $request->status;
        $schedule->comments = $request->comments;
        $schedule->save();

        $candidate = JobApplication::findOrFail($schedule->job_application_id);
        if ($request->status === 'cleared') {
            $candidate->status = 'selected';
        } elseif ($request->status === 'rejected') {
            $candidate->status = 'rejected';
        } elseif ($request->status === 'postponed') {
            $candidate->status = 'interview_postponed';
        }
        $candidate->save();
        $adminEmails = User::where('role_id', 2)->pluck('email')->toArray();
        $hrEmails    = User::where('role_id', 3)->pluck('email')->toArray();
        $allRecipients = array_merge([$candidate->email], $adminEmails, $hrEmails);
        Mail::to($allRecipients)->send(new InterviewStatusMail($candidate, $schedule));

        return response()->json([
            'success' => true,
            'candidate_status' => $candidate->status,
        ]);
    }
}
