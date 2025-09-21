<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BorrowRecord;
use App\Mail\OverdueReminderMail;
use Illuminate\Support\Facades\Mail;

class SendOverdueReminders extends Command
{
    protected $signature = 'reminders:overdue';
    protected $description = 'Send email reminders for overdue books';

    public function handle()
    {
        $overdueRecords = BorrowRecord::whereNull('returned_at')
            ->where('due_date', '<', now())
            ->get();

        foreach ($overdueRecords as $record) {
            Mail::to($record->user->email)
                ->queue(new OverdueReminderMail($record));
        }

        $this->info('Overdue reminders sent.');
    }
}
