<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use App\Models\BorrowRecord;
use App\Models\User;
use App\Mail\OverdueReminderMail;
use Illuminate\Support\Facades\Mail;

class TestOverdueEmail extends Command
{
    protected $signature = 'test:overdue-email';
    protected $description = 'Create an overdue borrow record and queue the email';

    public function handle()
    {
        // Pick a member user
        $user = User::where('role', 'member')->first();
        if (!$user) {
            $this->error('No member user found.');
            return;
        }

        // Pick a book
        $book = Book::first();
        if (!$book) {
            $this->error('No book found.');
            return;
        }

        // Create overdue borrow record
        $borrow = BorrowRecord::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrowed_at' => now()->subWeeks(3), // borrowed 3 weeks ago
            'due_date' => now()->subWeek(),      // overdue by 1 week
        ]);

        // Queue the email
        Mail::to($user->email)->queue(new OverdueReminderMail($borrow));

        $this->info("Overdue borrow record created and email queued for {$user->email}");
    }
}
