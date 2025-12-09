<?php

namespace App\Mail;

use App\Models\Leave;
use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveAppliedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $template_key;
    public $subject;
    public $body;
    public $companyDetails;


    public function __construct($leave, $template)
    {
        $employee = $leave->employee;

        $this->companyDetails = Company::all();

        $this->subject = $template->subject ?? "New Leave Request";

        $this->template_body = strtr($template->body, [
            '{{employee_name}}' => $employee->employee_name,
            '{{from_date}}' => \Carbon\Carbon::parse($leave->from_date)->format('d M Y'),
            '{{to_date}}' => \Carbon\Carbon::parse($leave->to_date)->format('d M Y'),
            '{{reason}}' => $leave->reason,
            
        ]);
    }


    public function build()
    {
        return $this->subject($this->template_key)
            ->view('emails.leave_applied')
            ->with([
                'subject' => $this->subject,
                'template_key' => $this->template_key,
                'template_body' => $this->template_body,
                'companyDetails' => $this->companyDetails
            ]);
    }

}