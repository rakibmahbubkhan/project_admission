<?php

namespace App\Mail;

use App\Models\FormSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusNotification extends Mailable implements ShouldQueue
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
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: 'Application Status Update - ' . ($this->submission->university->name ?? 'University Application'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Safe access to data to prevent crashes if a relationship is missing
        $studentName = $this->submission->student->user->name ?? 'Applicant';
        $universityName = $this->submission->university->name ?? 'the university';
        
        return new Content(
            view: 'emails.application_status',
            with: [
                'studentName' => $studentName,
                'universityName' => $universityName,
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