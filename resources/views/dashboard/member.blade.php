@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">My Borrowed Books</h1>
<table class="min-w-full border">
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Due Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($borrowedBooks as $borrow)
        <tr @if($borrow->due_date && $borrow->due_date < now()) class="bg-red-100" @endif>
            <td>{{ $borrow->book->title }}</td>
            <td>{{ $borrow->book->author }}</td>
            <td>{{ $borrow->due_date ? $borrow->due_date->format('d M Y') : 'No due date' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
