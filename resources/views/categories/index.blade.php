@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Categories</h1>

    @can('create', App\Models\Category::class)
        <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Category</a>
    @endcan

    <table class="table-auto w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $category->name }}</td>
                <td class="px-4 py-2">
                    @can('update', $category)
                        <a href="{{ route('categories.edit', $category) }}" class="text-blue-500 mr-2">Edit</a>
                    @endcan
                    @can('delete', $category)
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500" onclick="return confirm('Delete this category?')">Delete</button>
                        </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
