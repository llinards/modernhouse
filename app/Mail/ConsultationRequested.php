<?php

namespace App\Mail;

use App\Mail\Concerns\LogsMailFailures;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConsultationRequested extends Mailable implements ShouldQueue
{
  use LogsMailFailures, Queueable, SerializesModels;

  public array $data;

  public function __construct(array $data)
  {
    $this->data = $data;
  }

  public function envelope(): Envelope
  {
    return new Envelope(
      subject: 'Konsultācijas pieprasījums',
    );
  }

  public function content(): Content
  {
    return new Content(
      view: 'emails.consultation-requested',
    );
  }

  /**
   * @return array<int, \Illuminate\Mail\Mailables\Attachment>
   */
  public function attachments(): array
  {
    return [];
  }
}
