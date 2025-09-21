<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\BorrowRecord;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $totalBooks = Book::count();
            $borrowedBooks = BorrowRecord::whereNull('returned_at')->count();
            $overdueBooks = BorrowRecord::whereNull('returned_at')
                                ->where('due_date', '<', now())
                                ->count();

            return view('dashboard.admin', compact('totalBooks', 'borrowedBooks', 'overdueBooks'));
        }

        // Member Dashboard
        $borrowedBooks = BorrowRecord::where('user_id', $user->id)
                            ->whereNull('returned_at')
                            ->with('book')
                            ->get();

        return view('dashboard.member', compact('borrowedBooks'));
    }
}
