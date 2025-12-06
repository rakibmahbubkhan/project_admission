<?php

namespace App\Mail;

use App\Models\FormSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $submission;
    public $notificationText;

    /**
     * Create a new message instance.
     */
    public function __construct(FormSubmission $submission, $notificationText)
    {
        $this->submission = $submission;
        $this->notificationText = $notificationText;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Application Status Update - ' . $this->submission->university->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.application_status', // You need to create this view
            with: [
                'studentName' => $this->submission->student->user->name,
                'universityName' => $this->submission->university->name,
                'status' => ucfirst(str_replace('_', ' ', $this->submission->status)),
                'messageBody' => $this->notificationText,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}