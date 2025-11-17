<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Mail\Mailable;

class ApplicationRejectedMail extends Mailable
{
    public $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function build()
    {
        return $this->subject('Your Application Has Been Rejected')
                    ->view('emails.application_rejected');
    }
}
