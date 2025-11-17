<p>Hello {{ $application->student->user->name }},</p>

<p>Your application for <strong>{{ $application->admissionForm->title }}</strong> has been submitted successfully.</p>

<p>Status: <strong>{{ ucfirst($application->status) }}</strong></p>

<p>Thank you.</p>
<p>Best regards,<br>
The Admissions Team</p>