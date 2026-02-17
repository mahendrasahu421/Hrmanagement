<?php

namespace App\Mail;

use App\Models\JobApplication;
use App\Models\InterviewSchedule;
use App\Models\Company;
use App\Models\AcflJobs;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewStatusMail extends Mailable
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
            : 'Interview Status Update';

        $this->templateBody = $template && !empty($template->body)
            ? strtr($template->body, [
                '{candidate_name}' => $candidateName,
                '{status}'         => ucfirst($schedule->status ?? 'N/A'),
                '{description}'    => $schedule->description ?? '',
                '{company_name}'   => $companyName,
            ])
            : '';
    }

    public function build()
    {
        $mail = $this
            ->subject($this->subjectText)
            ->view('emails.interview_status')
            ->with([
                'subject'        => $this->subjectText,
                'template_body'  => $this->templateBody,
                'companyDetails' => $this->companyDetails,
                'candidate'      => $this->candidate,
                'schedule'       => $this->schedule,
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
