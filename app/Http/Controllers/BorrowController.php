<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    // Borrow a book
    public function store($bookId)
    {
        $book = Book::findOrFail($bookId);

        if ($book->stock_count <= 0) {
            return back()->with('error', 'Book is out of stock.');
        }

        // Check if user already borrowed this book and not returned
        $existing = BorrowRecord::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereNull('returned_at')
            ->first();

        if ($existing) {
            return back()->with('error', 'You already borrowed this book.');
        }

        BorrowRecord::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrowed_at' => now(),
        ]);

        return back()->with('success', 'Book borrowed successfully.');
    }

    // Return a borrowed book
    public function return($borrowId)
    {
        $borrow = BorrowRecord::findOrFail($borrowId);

        if ($borrow->user_id != Auth::id()) {
            abort(403);
        }

        $borrow->update([
            'returned_at' => now(),
        ]);

        return back()->with('success', 'Book returned successfully.');
    }
}
