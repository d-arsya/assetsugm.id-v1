<?php

namespace App\Mail;

use App\Models\Voter;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VoteToken extends Mailable
{
    use Queueable, SerializesModels;

    public string $token;
    public string $name;
    public string $votingLink;

    /**
     * Create a new message instance.
     */
    public function __construct(string $token, string $name)
    {
        $this->token = $token;
        $this->name = $name;
        $this->votingLink = config('app.url') . '/s/' . $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Voting Ketua ASSETS Telah Dibuka!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.voteToken',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
