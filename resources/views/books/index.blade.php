@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Books</h1>

    @can('create', App\Models\Book::class)
        <a href="{{ route('books.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Book</a>
    @endcan

<table class="min-w-full border">
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Stock</th>
            <th>Borrowed</th>
            <th>Actions</th>
            <th>Borrow</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->category->name }}</td>
            <td>{{ $book->stock_count }}</td> {{-- show stock directly --}}
            <td>{{ $book->borrow_records_count }}</td> {{-- show borrowed count --}}
            <td>
                @can('update', $book)
                    <a href="{{ route('books.edit', $book) }}">Edit</a>
                @endcan
                @can('delete', $book)
                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this book?')">Delete</button>
                    </form>
                @endcan
            </td>
            <td>
                @if(Auth::user()->role === 'member')
                    <form action="{{ route('borrow.store', $book->id) }}" method="POST">
                        @csrf
                        <button type="submit">Borrow</button>
                    </form>
                @else
                    N/A
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


</div>
@endsection
