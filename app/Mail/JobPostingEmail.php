<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Collection;

class JobPostingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $careers;

    public function __construct(User $user, Collection $careers)
    {
        $this->user = $user;
        $this->careers = $careers;
    }

    public function build()
    {
        return $this->subject('New Job Postings Available')
                    ->view('emails.job_posting_email')
                    ->with([
                        'user' => $this->user,
                        'careers' => $this->careers,
                    ]);
    }
}