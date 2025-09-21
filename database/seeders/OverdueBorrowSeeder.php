<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BorrowRecord;
use App\Models\User;
use App\Models\Book;

class OverdueBorrowSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('role', 'member')->first();
        $book = Book::first();

        if (!$user || !$book) {
            $this->command->warn("No users or books available to create overdue record.");
            return;
        }

        BorrowRecord::create([
            'user_id'     => $user->id,
            'book_id'     => $book->id,
            'borrowed_at' => now()->subDays(10),
            'due_date'    => now()->subDays(5), // overdue by 5 days
            'returned_at' => null,
        ]);

        $this->command->info("Overdue borrow record created for {$user->email} and book '{$book->title}'.");
    }
}
