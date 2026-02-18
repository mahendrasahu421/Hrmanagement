<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Mail\CandidateConfirmationMail;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CandidateStatusMail;
use App\Mail\InterviewClearedMail;
use App\Mail\InterviewPostponedMail;
use App\Mail\InterviewRejectedMail;
use App\Mail\InterviewRescheduledMail;
use App\Mail\InterviewScheduleMail;
use App\Mail\InterviewStatusMail;
use App\Models\AcflJobs;
use App\Models\Company;
use App\Models\EmailTemplate;
use App\Models\InterviewSchedule;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class OnboardingController extends Controller
{
    public function index($slug, $id)
    {
        $data['title'] = 'Employee / Onboarding';

        $candidate = JobApplication::with(['gender', 'maritalStatus', 'job', 'state', 'city'])->findOrFail($id);

        $generatedSlug = Str::slug($candidate->first_name . ' ' . $candidate->last_name);
        if ($generatedSlug !== $slug) {
            abort(404);
        }

        $data['candidate'] = $candidate;

        $template = EmailTemplate::where('template_key', 'candidate_confirmation')->first();

        if ($template) {
            $data['candidate_name'] = trim($candidate->first_name . ' ' . ($candidate->last_name ?? ''));

            $job = AcflJobs::find($candidate->job_id);
            $data['job_title'] = $job->job_title ?? 'the position';

            $data['company_name'] = $job && $job->branch && $job->branch->company
                ? $job->branch->company->company_name
                : (Company::where('status', 'Active')->value('company_name') ?? 'Our Company');
            $template->subject = str_replace(
                ['{candidate_name}', '{company_name}', '{job_title}'],
                [$data['candidate_name'], $data['company_name'], $data['job_title']],
                $template->subject
            );
            $template->body = str_replace(
                ['{candidate_name}', '{company_name}', '{job_title}'],
                ['<strong>' . e($data['candidate_name']) . '</strong>', '<strong>' . e($data['company_name']) . '</strong>', '<strong>' . e($data['job_title']) . '</strong>'],
                $template->body
            );
        }

        $data['confirmationTemplate'] = $template;

        return view('home.jobs.onboarding', $data);
    }

    public function sendConfirmation(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:job_applications,id',
        ]);
        $candidate = JobApplication::findOrFail($request->candidate_id);
        $offerTemplate = EmailTemplate::where('template_key', 'offer_letter')->first();
        $confirmationTemplate = EmailTemplate::where('template_key', 'candidate_confirmation')->first();
        if (!$offerTemplate || !$confirmationTemplate) {
            return response()->json([
                'success' => false,
                'message' => 'Required templates not found.'
            ]);
        }
        $candidateEmail = $candidate->email;
        $adminEmails = User::where('role_id', 2)->pluck('email')->toArray();
        $hrEmails    = User::where('role_id', 3)->pluck('email')->toArray();
        $allRecipients = array_merge([$candidateEmail], $adminEmails, $hrEmails);
        Mail::to($allRecipients)->send(
            new CandidateConfirmationMail(
                $candidate,
                $offerTemplate,
                $confirmationTemplate
            )
        );
        $candidate->confirmation_letter = 'send';
        if ($candidate->status === 'selected') {
            $candidate->status = 'confirmation';
        }
        $candidate->save();
        return response()->json([
            'success' => true,
            'message' => 'Confirmation mail sent successfully.'
        ]);
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
            'date' => 'required|date_format:d-m-Y',
            'time' => 'required',
            'venue' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
        $date = Carbon::createFromFormat('d-m-Y', $request->date)
            ->format('Y-m-d');

        $schedule = InterviewSchedule::create([
            'job_application_id' => $id,
            'round' => $request->round,
            'mode' => $request->mode,
            'date' => $date,
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
        $hrEmails = User::where('role_id', 3)->pluck('email')->toArray();
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
            'date' => 'required|date_format:d-m-Y',
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
        $convertedDate = Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
        $request->merge([
            'date' => $convertedDate
        ]);
        $schedule->update($request->all());
        $candidate = JobApplication::findOrFail($schedule->job_application_id);
        $newSchedule = null;
        if ($request->status === 'cleared') {
            $candidate->status = 'selected';
            $candidate->confirmation_letter = 'not_send';
            $template = EmailTemplate::where('template_key', 'interview_cleared')->first();
            if ($template) {
                Mail::to($this->getRecipients($candidate))
                    ->send(new InterviewClearedMail($candidate, $schedule, $template));
            }
        } elseif ($request->status === 'rejected') {
            $candidate->status = 'interview_rejected';
            $candidate->confirmation_letter = 'not_send';
            $template = EmailTemplate::where('template_key', 'interview_rejected')->first();
            if ($template) {
                Mail::to($this->getRecipients($candidate))
                    ->send(new InterviewRejectedMail($candidate, $schedule, $template));
            }
        } elseif ($request->status === 'postponed') {
            $candidate->status = 'interview_postponed';
            $candidate->confirmation_letter = 'not_send';
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
            if ($candidate->status === 'interview_postponed') {
                $candidate->status = 'interview_scheduled';
            }
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
            'body' => $request->body,
        ]);
        $candidate->save();
        return back()->with('success', 'Template updated successfully.');
    }
}
