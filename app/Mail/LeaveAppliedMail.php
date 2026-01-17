<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class LeaveAppliedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectText;
    public $templateBody;
    public $companyDetails;

    public function __construct($leave, $template)
    {
        $employee = $leave->employee;

        $this->companyDetails = Company::where('status', 'Active')->get();

        $duration = Carbon::parse($leave->from_date)
            ->diffInDays(Carbon::parse($leave->to_date)) + 1;
        $this->subjectText = str_replace(
            '{employee_name}',
            $employee->employee_name,
            $template->subject ?? 'New Leave Request'
        );

        $this->templateBody = strtr($template->body, [
            '{employee_name}' => $employee->employee_name,
            '{from_date}'     => Carbon::parse($leave->from_date)->format('d-m-Y'),
            '{to_date}'       => Carbon::parse($leave->to_date)->format('d-m-Y'),
            '{duration}'      => $duration,
            '{reason}'        => $leave->reason,
        ]);
    }

    public function build()
    {
        $mail = $this
            ->subject($this->subjectText)
            ->view('emails.leave_applied')
            ->with([
                'subject'        => $this->subjectText,
                'template_body'  => $this->templateBody,
                'companyDetails'=> $this->companyDetails,
            ]);

        foreach ($this->companyDetails as $company) {
            $path = public_path('uploads/company/' . $company->company_logo);

            if (file_exists($path)) {
                $mail->attach($path, [
                    'as'   => $company->company_logo,
                    'mime' => 'image/png',
                ]);
            }
        }

        return $mail;
    }
}
