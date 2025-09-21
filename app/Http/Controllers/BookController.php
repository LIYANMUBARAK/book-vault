<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Category;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $this->authorize('viewAny', Book::class);

    // Load category and borrowed count
    $books = Book::with('category')
                     ->withCount([
        'borrow_records as borrow_records_count' => function ($query) {
            $query->whereNull('returned_at'); // ✅ only active borrows
        }
    ])

                 ->get();

    return view('books.index', compact('books'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $this->authorize('create', Book::class);
    $categories = Category::all();
    return view('books.create', compact('categories'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $this->authorize('create', Book::class);

    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'category_id' => 'required|exists:categories,id',
        'published_year' => 'required|digits:4|integer',
        'stock_count' => 'required|integer|min:0',
    ]);

    Book::create($request->all());
    return redirect()->route('books.index')->with('success','Book created.');
}

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
{
    $categories = Category::all();
    return view('books.edit', compact('book', 'categories'));
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
    ]);

    $book->update([
        'title' => $request->title,
        'author' => $request->author,
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('books.index')
        ->with('success', 'Book updated successfully.');
}


  public function destroy(Book $book)
{
    // Delete the book
    $book->delete();

    // Redirect back to the books list with a success message
    return redirect()->route('books.index')
        ->with('success', 'Book deleted successfully.');
}
}
