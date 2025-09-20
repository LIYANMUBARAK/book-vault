@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Add New Category</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block">Name</label>
            <input type="text" name="name" class="border p-2 w-full" required>
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
