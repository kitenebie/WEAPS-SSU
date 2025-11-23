<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Applicant;

class ApplicantStatusEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant;
    public $status;
    public $message;

    public function __construct(Applicant $applicant, string $status, string $message)
    {
        $this->applicant = $applicant;
        $this->status = $status;
        $this->message = $message;
    }

    public function build()
    {
        $subject = $this->status === 'approved' ? 'Application Approved' : 'Application Rejected';

        return $this->subject($subject)
                    ->view('emails.applicant_status_email')
                    ->with([
                        'applicant' => $this->applicant,
                        'status' => $this->status,
                        'message' => $this->message,
                    ]);
    }
}