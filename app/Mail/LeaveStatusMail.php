<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $leave;
    public $status;
    public $subjectLine;
    public $templateBody;
    public $employee;

    public function __construct($leave, $status, $template, $employee)
    {
        $this->leave = $leave;
        $this->employee = $employee;
        $this->status = $status;

        // Replace placeholders in subject
        $this->subjectLine = str_replace(
            ['{employee_name}', '{from_date}', '{to_date}', '{status}'],
            [$employee->employee_name, $leave->from_date, $leave->to_date, ucfirst($status)],
            $template->subject
        );

        // Replace placeholders in body
        $this->templateBody = str_replace(
            ['{employee_name}', '{from_date}', '{to_date}', '{status}'],
            [$employee->employee_name, $leave->from_date, $leave->to_date, ucfirst($status)],
            $template->body
        );
    }

    public function build()
    {
        return $this->subject($this->subjectLine)
                    ->view('emails.leave_status') // HTML blade file
                    ->with([
                        'subject' => $this->subjectLine,
                        'template_body' => $this->templateBody,
                        'template_key' => 'leave_request_status',
                        'companyDetails' => \App\Models\Company::all()
                    ]);
    }
}
