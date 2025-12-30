<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class LeaveStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectLine;
    public $templateBody;
    public $companyDetails;

    protected $leave;
    protected $employee;
    protected $status;


    public function __construct($leave, $status, $template, $employee, $rejectionReason = null)
    {
        $this->leave = $leave;
        $this->employee = $employee;
        $this->status = $status;


        $this->companyDetails = Company::first();

        // 🔁 Common replacements
        $replace = [
            '{employee_name}'    => $employee->employee_name,

            '{from_date}'        => Carbon::parse($leave->from_date)->format('d-m-Y'),
            '{to_date}'          => Carbon::parse($leave->to_date)->format('d-m-Y'),
            '{status}'           => ucfirst($status),

        ];

        // ✅ Subject replace
        $this->subjectLine = strtr($template->subject, $replace);

        // ✅ Body replace
        $this->templateBody = strtr($template->body, $replace);
    }

    public function build()
    {
        $mail = $this->subject($this->subjectLine)
            ->view('emails.leave_status')
            ->with([
                'subject' => $this->subjectLine,
                'template_body' => $this->templateBody,
                'companyDetails' => $this->companyDetails,
            ]);

        if ($this->companyDetails && $this->companyDetails->company_logo) {

            $path = public_path('uploads/company/' . $this->companyDetails->company_logo);

            if (file_exists($path)) {
                $mail->attach($path, [
                    'as' => $this->companyDetails->company_logo,
                    'mime' => 'image/png',
                ]);
            }
        }

        return $mail;
    }
}
