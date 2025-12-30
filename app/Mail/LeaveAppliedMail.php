<?php

namespace App\Mail;

use App\Models\Leave;
use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class LeaveAppliedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $template_key;
    public $subject;
    public $body;
    public $companyDetails;
    public $duration;

    public function __construct($leave, $template)
    {
        $employee = $leave->employee;

        $this->companyDetails = Company::all();

        $this->subject = $template->subject ?? "New Leave Request";

        $this->duration = Carbon::parse($leave->from_date)
            ->diffInDays(Carbon::parse($leave->to_date)) + 1;

        $this->body = strtr($template->body, [
            '{manager_name}' => $manager->name ?? 'Manager',
            '{employee_name}' => $employee->employee_name,

            '{from_date}' => Carbon::parse($leave->from_date)->format('d-m-Y'),
            '{to_date}' => Carbon::parse($leave->to_date)->format('d-m-Y'),
            '{reason}' => $leave->reason,
            '{duration}' => $this->duration
        ]);
    }


    public function build()
    {
        $mail = $this->subject($this->template_key)
            ->view('emails.leave_applied')
            ->with([
                'subject' => $this->subject,
                'template_key' => $this->template_key,
                'template_body' => $this->body,
                'companyDetails' => $this->companyDetails
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
