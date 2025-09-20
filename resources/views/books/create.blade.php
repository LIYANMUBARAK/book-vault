@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Add New Book</h1>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block">Title</label>
            <input type="text" name="title" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label class="block">Author</label>
            <input type="text" name="author" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label class="block">Category</label>
            <select name="category_id" class="border p-2 w-full" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

      <div class="mb-2">
    <label class="block mb-1">Published Year</label>
    <input type="number" name="published_year" value="{{ old('published_year') }}" class="border p-2 w-full">
    @error('published_year')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
</div>

<div class="mb-2">
    <label class="block mb-1">Stock Count</label>
    <input type="number" name="stock_count" value="{{ old('stock_count', 0) }}" class="border p-2 w-full">
    @error('stock_count')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
</div>


        <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
