<?php

namespace App\Mail;

use App\Models\JobApplication;
use App\Models\InterviewSchedule;
use App\Models\Company;
use App\Models\AcflJobs;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewRescheduledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;
    public $schedule;
    public $companyDetails;
    public $subjectText;
    public $templateBody;

    public function __construct(JobApplication $candidate, InterviewSchedule $schedule, $template = null)
    {
        $this->candidate = $candidate;
        $this->schedule = $schedule;
        $this->companyDetails = Company::where('status', 'Active')->get();

        $candidateName = trim($candidate->first_name . ' ' . ($candidate->last_name ?? ''));
        $job = AcflJobs::find($candidate->job_id);
        $jobTitle = $job->job_title ?? '';
        $companyName = optional($job->company)->company_name
            ?? ($this->companyDetails->first()->company_name ?? 'Our Company');

        $this->subjectText = $template && !empty($template->subject)
            ? strtr($template->subject, [
                '{candidate_name}' => $candidateName,
                '{company_name}'   => $companyName,
                '{job_title}'      => $jobTitle,
            ])
            : 'Interview Rescheduled';

        $this->templateBody = $template && !empty($template->body)
            ? strtr($template->body, [
                '{candidate_name}' => $candidateName,
                '{company_name}'   => $companyName,
                '{job_title}'      => $jobTitle,
                '{round}'          => $schedule->round,
                '{mode}'           => ucfirst($schedule->mode),
                '{date}'           => Carbon::parse($schedule->date)->format('d-m-Y'),
                '{time}'           => Carbon::parse($schedule->time)->format('h:i A'),
                '{venue}'          => $schedule->venue ?? 'N/A',
                '{description}'    => $schedule->description ?? '',
                '{comments}'       => $schedule->comments ?? 'N/A',
            ])
            : '';
    }

    public function build()
    {
        $mail = $this
            ->subject($this->subjectText)
            ->view('emails.candidate_status')
            ->with([
                'subject'        => $this->subjectText,
                'template_body'  => $this->templateBody,
                'companyDetails' => $this->companyDetails,
                'candidate'      => $this->candidate,
            ]);

        foreach ($this->companyDetails as $company) {
            if (!empty($company->company_logo)) {
                $path = public_path('uploads/company/' . $company->company_logo);
                if (file_exists($path)) {
                    $mail->attach($path, [
                        'as'   => $company->company_logo,
                        'mime' => 'image/png',
                    ]);
                }
            }
        }

        return $mail;
    }
}
