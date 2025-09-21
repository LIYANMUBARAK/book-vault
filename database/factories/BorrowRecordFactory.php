<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BorrowRecord;
use App\Models\User;
use App\Models\Book;
use Carbon\Carbon;

class BorrowRecordFactory extends Factory
{
    protected $model = BorrowRecord::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'book_id' => Book::factory(),
            'borrowed_at' => Carbon::now()->subDays(5),
            'due_date' => Carbon::now()->addDays(7),
            'returned_at' => null,
        ];
    }
}
