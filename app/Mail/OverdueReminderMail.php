<?php

namespace App\Mail;

use App\Models\BorrowRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OverdueReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $borrowRecord;

    public function __construct(BorrowRecord $borrowRecord)
    {
        $this->borrowRecord = $borrowRecord;
    }

    public function build()
    {
        return $this->subject('Overdue Book Reminder')
                    ->view('emails.overdue_reminder');
    }
}
