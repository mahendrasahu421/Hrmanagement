<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidateStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;
    public $status;
    public $companyDetails;

    public function __construct($candidate, $status)
    {
        $this->candidate = $candidate;
        $this->status = $status;
        $this->companyDetails = Company::where('status', 'Active')->get();
    }

    public function build()
    {
        $subject = $this->status === 'shortlisted'
            ? 'You have been Shortlisted'
            : 'Application Update';

        $mail = $this->subject($subject)
            ->view('emails.candidate_status')
            ->with([
                'candidate' => $this->candidate,
                'status' => $this->status,
                'companyDetails' => $this->companyDetails,
            ]);
        foreach ($this->companyDetails as $company) {
            if (!empty($company->company_logo)) {
                $path = public_path('uploads/company/' . $company->company_logo);
                if (file_exists($path)) {
                    $mail->attach($path, [
                        'as' => $company->company_logo,
                        'mime' => 'image/png',
                    ]);
                }
            }
        }

        return $mail;
    }
}
