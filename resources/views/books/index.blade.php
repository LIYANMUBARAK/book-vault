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


</div>
@endsection
