<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                📚 Library Books
            </h2>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ $books->total() }} total books
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 mb-8 border border-gray-200 dark:border-gray-700">
                <form method="GET" action="{{ route('books.index') }}" class="space-y-4">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <!-- Search Input -->
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Search by title, author, or ISBN..." 
                                value="{{ request('search') }}" 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            >
                        </div>

                        <!-- Category Filter -->
                        <div class="lg:w-48">
                            <select name="category" class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Availability Filter -->
                        <div class="lg:w-40">
                            <select name="availability" class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                                <option value="">All Books</option>
                                <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>📗 Available</option>
                                <option value="unavailable" {{ request('availability') == 'unavailable' ? 'selected' : '' }}>📕 Out of Stock</option>
                            </select>
                        </div>

                        <!-- Filter Button -->
                        <button 
                            type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            🔍 Filter
                        </button>
                    </div>
                </form>

                @can('create', App\Models\Book::class)
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a 
                            href="{{ route('books.create') }}" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                        >
                            ➕ Add New Book
                        </a>
                    </div>
                @endcan
            </div>

            <!-- Books Grid/Table -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    📖 Book Details
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    📂 Category
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    📊 Availability
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    ⚙️ Actions
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    📚 Borrow
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($books as $book)
                                @php
                                    $borrowedRecord = $book->borrow_records()
                                        ->where('user_id', Auth::id())
                                        ->whereNull('returned_at')
                                        ->first();
                                    $isOverdue = $borrowedRecord && $borrowedRecord->due_date < now();
                                @endphp

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 {{ $isOverdue ? 'bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500' : '' }}">
                                    <!-- Book Details -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0">
                                                <div class="h-12 w-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                                                    {{ substr($book->title, 0, 1) }}
                                                </div>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $book->title }}
                                                </h3>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    by {{ $book->author }}
                                                </p>
                                                @if($isOverdue)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 mt-1">
                                                        ⚠️ Overdue
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Category -->
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                            {{ $book->category->name }}
                                        </span>
                                    </td>

                                    <!-- Availability -->
                                    <td class="px-6 py-4">
                                        <div class="space-y-1">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Stock:</span>
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold {{ $book->stock_count > 0 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                                    {{ $book->stock_count > 0 ? '✅' : '❌' }} {{ $book->stock_count }}
                                                </span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Borrowed:</span>
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                                    📋 {{ $book->borrow_records_count }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Admin Actions -->
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            @can('update', $book)
                                                <a 
                                                    href="{{ route('books.edit', $book) }}" 
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200"
                                                >
                                                    ✏️ Edit
                                                </a>
                                            @endcan

                                            @can('delete', $book)
                                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button 
                                                        type="submit" 
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 transition-colors duration-200" 
                                                        onclick="return confirm('Are you sure you want to delete this book?')"
                                                    >
                                                        🗑️ Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>

                                    <!-- Borrow Actions -->
                                    <td class="px-6 py-4">
                                        @if(Auth::user()->role === 'member')
                                            @if($borrowedRecord)
                                                <div class="space-y-2">
                                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                                        <span class="font-medium">Due:</span> 
                                                        <span class="{{ $isOverdue ? 'text-red-600 dark:text-red-400 font-bold' : '' }}">
                                                            {{ $borrowedRecord->due_date ? $borrowedRecord->due_date->format('M j, Y') : 'No due date' }}
                                                        </span>
                                                    </div>
                                                    <form action="{{ route('borrow.return', $borrowedRecord) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')    
                                                        <button 
                                                            type="submit" 
                                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-black bg-yellow-400 hover:bg-yellow-500 transition-colors duration-200 shadow-sm"
                                                        >
                                                            ↩️ Return Book
                                                        </button>
                                                    </form>
                                                </div>
                                            @elseif($book->stock_count > 0)
                                                <form action="{{ route('borrow.store', $book) }}" method="POST">
                                                    @csrf
                                                    <button 
                                                        type="submit" 
                                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 transition-colors duration-200 shadow-sm"
                                                    >
                                                        📖 Borrow
                                                    </button>
                                                </form>
                                            @else
                                                <span class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                                                    📵 Unavailable
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-gray-500 dark:text-gray-400 text-sm">Admin View</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-app-layout>