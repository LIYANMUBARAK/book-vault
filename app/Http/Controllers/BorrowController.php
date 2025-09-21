<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{

 public function index()
{
    if (Auth::user()->role === 'admin') {
        // Admin sees all borrow records
        $records = BorrowRecord::with(['book', 'user'])
                    ->orderBy('borrowed_at', 'desc')
                    ->paginate(10); // change 10 to how many per page
    } else {
        // Member sees only their own borrow records
        $records = BorrowRecord::with('book')
                    ->where('user_id', Auth::id())
                    ->orderBy('borrowed_at', 'desc')
                    ->paginate(10);
    }

    return view('borrow.index', compact('records'));
}





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

        // ✅ Check borrowing limit
    $activeBorrowCount = BorrowRecord::where('user_id', Auth::id())
        ->whereNull('returned_at')
        ->count();

    if ($activeBorrowCount >= 3) { // limit = 3
        return back()->with('error', 'You have reached your borrowing limit.');
    }

        BorrowRecord::create([
            'user_id'     => Auth::id(),
            'book_id'     => $book->id,
            'borrowed_at' => now(),
            'due_date'    => now()->addWeeks(2), // 2-week due date
        ]);

        // ✅ Reduce stock
        $book->decrement('stock_count');

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

        // ✅ Increase stock
        $borrow->book->increment('stock_count');



        return back()->with('success', 'Book returned successfully.');
    }
}
