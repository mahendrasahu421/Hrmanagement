<?php

namespace App\Mail;

use App\Models\AcflJobs;
use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidateStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectText;
    public $templateBody;
    public $companyDetails;
    public $candidate;
    public $status;

    public function __construct($candidate, $status, $template = null)
    {
        $this->candidate = $candidate;
        $this->status = strtolower(str_replace(' ', '_', $status));
        $this->companyDetails = Company::where('status', 'Active')->get();

        $candidateName = trim($candidate->first_name . ' ' . ($candidate->last_name ?? ''));
        $job = AcflJobs::find($candidate->job_id);
        $jobTitle = $job->job_title ?? '';
        $companyName = optional($job->company)->company_name
            ?? ($this->companyDetails->first()->company_name ?? 'Our Company');

        $this->subjectText = $template && !empty($template->subject)
            ? strtr($template->subject, [
                '{candidate_name}' => $candidateName,
                '{employee_name}'  => $candidateName,
            ])
            : ($this->status === 'shortlisted'
                ? "Shortlisted – $candidateName"
                : "Not Shortlisted – $candidateName");

        $this->templateBody = $template && !empty($template->body)
            ? strtr($template->body, [
                '{candidate_name}' => $candidateName,
                '{employee_name}'  => $candidateName,
                '{company_name}'   => $companyName,
                '{job_title}'      => $jobTitle,
            ])
            : ($this->status === 'shortlisted'
                ? "<p>Congratulations $candidateName, you have been shortlisted for the position of $jobTitle at $companyName.</p>"
                : "<p>Dear $candidateName, we regret to inform you that you were not selected for the position of $jobTitle at $companyName.</p>");
    }

    public function build()
    {
        $viewName = match ($this->status) {
            'shortlisted' => 'emails.candidate_status',
            'not_shortlisted', 'rejected' => 'emails.candidate_not_shortlisted',
            default => 'emails.candidate_status',
        };

        $mail = $this
            ->subject($this->subjectText)
            ->view($viewName)
            ->with([
                'subject'        => $this->subjectText,
                'template_body'  => $this->templateBody,
                'companyDetails' => $this->companyDetails,
                'candidate'      => $this->candidate,
                'status'         => $this->status,
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
