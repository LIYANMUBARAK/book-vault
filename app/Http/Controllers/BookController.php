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
public function index(Request $request)
{
    $this->authorize('viewAny', Book::class);

    $query = Book::with('category')
                 ->withCount('borrow_records');

    // Search by title or author
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%");
        });
    }

    // Filter by category
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // Filter by availability
    if ($request->filled('availability')) {
        if ($request->availability === 'available') {
            $query->where('stock_count', '>', 0);
        } elseif ($request->availability === 'unavailable') {
            $query->where('stock_count', '<=', 0);
        }
    }

   // Borrowed count for active records
    $query->withCount(['borrow_records' => function($q) {
        $q->whereNull('returned_at');
    }]);

    // Paginate results (10 per page)
    $books = $query->paginate(10)->withQueryString();

    $categories = Category::all(); // for filter dropdown

    return view('books.index', compact('books', 'categories'));
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
