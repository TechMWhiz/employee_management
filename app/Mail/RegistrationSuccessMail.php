<?php

namespace App\Mail;

use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly Employee $employee,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registration Successful',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.registration-success',
            with: [
                'employee' => $this->employee,
                'registeredAt' => $this->employee->created_at ?? now(),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
