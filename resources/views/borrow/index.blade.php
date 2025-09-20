@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Borrow Records</h1>

@if(session('success'))
    <div class="bg-green-200 text-green-800 p-2 rounded mb-2">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="bg-red-200 text-red-800 p-2 rounded mb-2">{{ session('error') }}</div>
@endif

<table class="table-auto w-full border">
    <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 border">Book</th>
            <th class="px-4 py-2 border">User</th>
            <th class="px-4 py-2 border">Borrowed At</th>
            <th class="px-4 py-2 border">Returned At</th>
            <th class="px-4 py-2 border">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
            <tr>
                <td class="border px-4 py-2">{{ $record->book->title }}</td>
                <td class="border px-4 py-2">{{ $record->user->name }}</td>
                <td class="border px-4 py-2">{{ $record->borrowed_at }}</td>
                <td class="border px-4 py-2">
                    {{ $record->returned_at ?? 'Not returned' }}
                </td>
                <td class="border px-4 py-2">
                    @if(!$record->returned_at && Auth::id() === $record->user_id)
                        <form action="{{ route('borrow.update', $record->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">
                                Return
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
