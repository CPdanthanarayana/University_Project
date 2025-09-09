<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Application;
use App\Models\Applicant;
use App\Models\User;


class ApplicationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $applicant;
    public $dean;

    public function __construct(Application $application, Applicant $applicant, User $dean)
    {
        $this->application = $application;
        $this->applicant = $applicant;
        $this->dean = $dean;
    }

    public function build()
    {
        return $this->subject('Application Status Update')
                    ->markdown('emails.application_status');
    }
}
