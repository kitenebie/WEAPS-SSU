<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\CurriculumVitae;

class CurriculumVitaeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;
    public $cv;

    public function __construct($subject, $content, CurriculumVitae $cv)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->cv = $cv;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.curriculum_vitae_email')
                    ->with([
                        'content' => $this->content,
                        'cv' => $this->cv,
                    ]);
    }
}