@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Books</h1>

    @can('create', App\Models\Book::class)
        <a href="{{ route('books.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Book</a>
    @endcan

    <table class="table-auto w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Author</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Stock</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $book->title }}</td>
                <td class="px-4 py-2">{{ $book->author }}</td>
                <td class="px-4 py-2">{{ $book->category->name }}</td>
                <td class="px-4 py-2">{{ $book->stock_count }}</td>
                <td class="px-4 py-2">
                    @can('update', $book)
                        <a href="{{ route('books.edit', $book) }}" class="text-blue-500 mr-2">Edit</a>
                    @endcan
                    @can('delete', $book)
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500" onclick="return confirm('Delete this book?')">Delete</button>
                        </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
