@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Book</h1>

<form action="{{ route('books.update', $book->id) }}" method="POST" class="bg-white p-4 rounded shadow">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <label class="block mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $book->title) }}" class="border p-2 w-full">
        @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>

    <div class="mb-2">
        <label class="block mb-1">Author</label>
        <input type="text" name="author" value="{{ old('author', $book->author) }}" class="border p-2 w-full">
        @error('author')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>

    <div class="mb-2">
        <label class="block mb-1">Category</label>
        <select name="category_id" class="border p-2 w-full">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>

    <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded mt-2">Update Book</button>
</form>
@endsection
