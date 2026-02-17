<?php

namespace App\Mail;

use App\Models\JobApplication;
use App\Models\Company;
use App\Models\AcflJobs;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class CandidateConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;
    public $companyDetails;
    public $subjectText;
    public $emailBody;
    public $pdfBody;

    public function __construct(JobApplication $candidate,$offerTemplate,$confirmationTemplate) {
        $this->candidate = $candidate;
        $this->companyDetails = Company::where('status', 'Active')->get();

        $candidateName = trim($candidate->first_name . ' ' . ($candidate->last_name ?? ''));

        $job = AcflJobs::find($candidate->job_id);
        $jobTitle = $job->job_title ?? '';

        $companyName = optional($job->company)->company_name
            ?? ($this->companyDetails->first()->company_name ?? 'Our Company');
        $this->subjectText = strtr($offerTemplate->subject ?? 'Offer Letter', [
            '{candidate_name}' => $candidateName,
            '{company_name}'   => $companyName,
            '{job_title}'      => $jobTitle,
        ]);

        $this->emailBody = strtr($offerTemplate->body ?? '', [
            '{candidate_name}' => $candidateName,
            '{company_name}'   => $companyName,
            '{job_title}'      => $jobTitle,
        ]);

        $this->pdfBody = strtr($confirmationTemplate->body ?? '', [
            '{candidate_name}' => $candidateName,
            '{company_name}'   => $companyName,
            '{job_title}'      => $jobTitle,
        ]);
    }

    public function build()
    {
        $bgPath = public_path('frontent/assets/img/acfl.jpg.jpeg');
        $bgImage = null;
        if (file_exists($bgPath)) {
            $type = pathinfo($bgPath, PATHINFO_EXTENSION);
            $data = file_get_contents($bgPath);
            $bgImage = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
        $pdf = Pdf::loadView('pdf.candidate_confirmation', [
            'body' => $this->pdfBody,
            'companyDetails' => $this->companyDetails,
            'bgImage' => $bgImage,
        ]);
        $mail = $this
            ->subject($this->subjectText)
            ->view('emails.candidate_confirmation')
            ->with([
                'subject'        => $this->subjectText,
                'template_body'  => $this->emailBody,
                'companyDetails' => $this->companyDetails,
                'candidate'      => $this->candidate,
            ])
            ->attachData($pdf->output(), 'Candidate_Confirmation.pdf');
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
