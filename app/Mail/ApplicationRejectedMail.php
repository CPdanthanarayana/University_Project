<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Application;

class ApplicationRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function build()
    {
        return $this->to($this->application->applicant->email)  // applicant email
                    ->subject('Vehicle Allocation Request Rejected')
                    ->view('emails.application_rejected')
                    ->with([
                        'application' => $this->application,
                    ]);
    }
}
