<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CandidateStatusMail;
use App\Mail\InterviewPostponedMail;
use App\Mail\InterviewRescheduledMail;
use App\Mail\InterviewScheduleMail;
use App\Mail\InterviewStatusMail;
use App\Models\EmailTemplate;
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
        $template = EmailTemplate::where('template_key', 'employee_confirmation')->first();
        $data['confirmationTemplate'] = $template;

        return view('home.jobs.onboarding', $data);
    }

    public function sendConfirmation(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:job_applications,id',
        ]);
        $candidate = JobApplication::findOrFail($request->candidate_id);
        $template = EmailTemplate::where('template_key', 'employee_confirmation')->first();
        $subject = $template->subject;
        $templateBody = $template->body;
        $templateBody = str_replace(
            ['{{first_name}}', '{{last_name}}', '{{job_title}}'],
            [$candidate->first_name, $candidate->last_name, $candidate->job->title ?? ''],
            $templateBody
        );
        $adminEmails = User::where('role_id', 2)->pluck('email')->toArray();
        $hrEmails = User::where('role_id', 3)->pluck('email')->toArray();
        $allRecipients = array_merge([$candidate->email], $adminEmails, $hrEmails);
        Mail::raw($templateBody, function ($message) use ($subject, $allRecipients) {
            $message->to($allRecipients)->subject($subject);
        });
        return response()->json(['success' => true]);
    }

    public function shortlist(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:shortlisted,rejected'
        ]);
        $candidate = JobApplication::findOrFail($id);
        $candidate->status = $request->status;
        $candidate->save();
        $templateKey = $request->status === 'shortlisted'
            ? 'candidate_shortlisted'
            : 'candidate_not_shortlisted';
        $template = EmailTemplate::where('template_key', $templateKey)->first();
        $candidateEmail = $candidate->email;
        $adminEmails = User::where('role_id', 2)->pluck('email')->toArray();
        $hrEmails    = User::where('role_id', 3)->pluck('email')->toArray();
        $allRecipients = array_merge([$candidateEmail], $adminEmails, $hrEmails);
        Mail::to($allRecipients)->send(
            new CandidateStatusMail($candidate, $request->status, $template)
        );
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
        $templateKey = 'interview_schedule';
        $template = EmailTemplate::where('template_key', $templateKey)->first();
        $candidateEmail = $candidate->email;
        $adminEmails = User::where('role_id', 2)->pluck('email')->toArray();
        $hrEmails    = User::where('role_id', 3)->pluck('email')->toArray();
        $allRecipients = array_merge([$candidateEmail], $adminEmails, $hrEmails);
        Mail::to($allRecipients)->send(
            new InterviewScheduleMail($candidate, $schedule, $template)
        );
        return response()->json([
            'success' => true,
            'id' => $schedule->id,
        ]);
    }

    public function updateInterviewStatus(Request $request, $id)
    {
        $request->validate([
            'round' => 'required|string',
            'mode' => 'required|in:offline,online,on_call',
            'date' => 'required|date',
            'time' => 'required',
            'venue' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'nullable|in:cleared,rejected,postponed',
            'comments' => 'nullable|string'
        ]);
        $schedule = InterviewSchedule::findOrFail($id);
        $oldDate  = $schedule->date;
        $oldTime  = $schedule->time;
        $oldMode  = $schedule->mode;
        $oldVenue = $schedule->venue;

        $schedule->update($request->all());

        $candidate = JobApplication::findOrFail($schedule->job_application_id);

        $newSchedule = null;

        if ($request->status === 'cleared') {
            $candidate->status = 'selected';
        } elseif ($request->status === 'rejected') {
            $candidate->status = 'rejected';
        } elseif ($request->status === 'postponed') {
            $candidate->status = 'interview_postponed';

            $currentRoundNumber = (int) filter_var($schedule->round, FILTER_SANITIZE_NUMBER_INT);
            $nextRound = 'R' . ($currentRoundNumber + 1);

            $newSchedule = InterviewSchedule::create([
                'job_application_id' => $schedule->job_application_id,
                'round' => $nextRound,
            ]);
            $template = EmailTemplate::where('template_key', 'interview_postponed')->first();
            if ($template) {
                Mail::to($this->getRecipients($candidate))
                    ->send(new InterviewPostponedMail($candidate, $schedule, $template));
            }
        } else {
            $isRescheduled =
                $oldDate  != $schedule->date ||
                $oldTime  != $schedule->time ||
                $oldMode  != $schedule->mode ||
                $oldVenue != $schedule->venue;

            if ($isRescheduled) {
                $template = EmailTemplate::where('template_key', 'interview_rescheduled')->first();
                if ($template) {
                    Mail::to($this->getRecipients($candidate))
                        ->send(new InterviewRescheduledMail($candidate, $schedule, $template));
                }
            }
        }
        $candidate->save();

        return response()->json([
            'success' => true,
            'new_schedule' => $newSchedule
        ]);
    }

    private function getRecipients($candidate)
    {
        $adminEmails = User::where('role_id', 2)->pluck('email')->toArray();
        $hrEmails = User::where('role_id', 3)->pluck('email')->toArray();

        return array_merge(
            [$candidate->email],
            $adminEmails,
            $hrEmails
        );
    }


    public function updateConfirmationTemplate(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'body' => 'required|string',
            'candidate_id' => 'required|exists:job_applications,id',
        ]);

        $candidate = JobApplication::findOrFail($request->candidate_id);

        $candidate->email_template = json_encode([
            'subject' => $request->subject,
            'body' => $request->body
        ]);
        $candidate->save();

        return response()->json([
            'success' => true,
            'message' => 'Updated successfully'
        ]);
    }
}
