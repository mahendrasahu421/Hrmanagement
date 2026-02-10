<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationLetterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectLine;
    public $templateBody;
    public $companyDetails;

    protected $candidate;
    protected $template;

    public function __construct($candidate, $template)
    {
        $this->candidate = $candidate;
        $this->template = $template;

        $this->companyDetails = Company::first();

        $companyName = optional($this->companyDetails)->company_name ?? '';

        $replace = [
            '{employee_name}' => $candidate->first_name . ' ' . $candidate->last_name,
            '{company_name}'  => $companyName,
            '{job_title}'     => optional($candidate->job)->title ?? '',
        ];

        $subject = $template->subject ?? '';
        $body    = $template->body ?? '';

        $this->subjectLine  = strtr($subject, $replace);
        $this->templateBody = strtr($body, $replace);
    }


    public function build()
    {
        return $this->subject($this->subjectLine)
            ->view('emails.master')
            ->with([
                'subject' => $this->subjectLine,
                'template_body' => $this->templateBody,
                'companyDetails' => $this->companyDetails,
            ]);
    }
}
