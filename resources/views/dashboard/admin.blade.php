@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>
<ul>
    <li>Total Books: {{ $totalBooks }}</li>
    <li>Borrowed Books: {{ $borrowedBooks }}</li>
    <li>Overdue Books: <span class="text-red-600">{{ $overdueBooks }}</span></li>
</ul>
@endsection
