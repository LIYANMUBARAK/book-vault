@extends('layouts.app')

@section('content')

<form method="GET" action="{{ route('books.index') }}" class="mb-4 flex gap-2">
    <input type="text" name="search" placeholder="Search by title/author" value="{{ request('search') }}" class="border rounded px-2 py-1">
    
    <select name="category" class="border rounded px-2 py-1">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <select name="availability" class="border rounded px-2 py-1">
        <option value="">All</option>
        <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>In Stock</option>
        <option value="unavailable" {{ request('availability') == 'unavailable' ? 'selected' : '' }}>Out Of Stock</option>
    </select>

    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Filter</button>
</form>



<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Books</h1>

    @can('create', App\Models\Book::class)
        <a href="{{ route('books.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Book</a>
    @endcan
@if(session('error'))
    <div class="bg-red-200 text-red-800 p-2 mb-4 rounded">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

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
        @if(Auth::user()->role === 'member')
            @php
                $isOverdue = $book->borrow_records()
                    ->where('user_id', Auth::id())
                    ->where('due_date', '<', now())
                    ->exists();
            @endphp
        @else
            @php
                $isOverdue = $book->borrow_records()
                    ->where('due_date', '<', now())
                    ->exists();
            @endphp
        @endif

        <tr @if($isOverdue) class="bg-red-100" @endif>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->category->name }}</td>
            <td>{{ $book->stock_count }}</td>
            <td>{{ $book->borrow_records_count }}</td>

            {{-- Actions column --}}
            <td>
                @can('update', $book)
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-primary">Edit</a>
                @endcan

                @can('delete', $book)
                    <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                @endcan
            </td>

            {{-- Borrow / Return column --}}
<td>
    @if(Auth::user()->role === 'member')
        @php
            $borrowRecord = $book->borrow_records()
                ->where('user_id', Auth::id())
                ->whereNull('returned_at')
                ->first();
        @endphp

        @if($borrowRecord)
            {{-- Show Due Date --}}
@if($borrowRecord->due_date)
    <div class="text-sm text-gray-600 mb-1">
        Due: {{ $borrowRecord->due_date->format('d M Y') }}
    </div>
@else
    <div class="text-sm text-gray-500 mb-1">
        No due date set
    </div>
@endif


            {{-- Return Button --}}
            <form action="{{ route('borrow.return', $borrowRecord) }}" method="POST" style="display:inline">
                @csrf
                @method('PUT')    
                <button type="submit" class="btn btn-sm btn-warning">Return</button>
            </form>
        @else
            {{-- Borrow Button --}}
            @if($book->stock_count > 0)
                <form action="{{ route('borrow.store', $book) }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success">Borrow</button>
                </form>
            @else
                <span class="text-gray-500">N/A</span>
            @endif
        @endif
    @else
        <span class="text-gray-500">N/A</span>
    @endif
</td>

        </tr>
    @endforeach
</tbody>



</table>

<div class="mt-4">
    {{ $books->links() }}
</div>
</div>
@endsection
