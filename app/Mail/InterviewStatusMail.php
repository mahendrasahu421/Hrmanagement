<?php

namespace App\Mail;

use App\Models\JobApplication;
use App\Models\InterviewSchedule;
use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;
    public $schedule;
    public $companyDetails;

    public function __construct(JobApplication $candidate, InterviewSchedule $schedule)
    {
        $this->candidate = $candidate;
        $this->schedule = $schedule;
        $this->companyDetails = Company::where('status', 'Active')->get();
    }

    public function build()
    {
        $mail = $this->subject('Interview Status Update')
            ->view('emails.interview_status')
            ->with([
                'candidate' => $this->candidate,
                'schedule' => $this->schedule,
                'companyDetails' => $this->companyDetails,
            ]);
        foreach ($this->companyDetails as $company) {
            $path = public_path('uploads/company/' . $company->company_logo);
            if (file_exists($path)) {
                $mail->attach($path, [
                    'as' => $company->company_logo,
                    'mime' => 'image/png',
                ]);
            }
        }

        return $mail;
    }
}
