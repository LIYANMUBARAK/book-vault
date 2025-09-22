<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="h-10 w-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-4H3m16 8H1m18 4H3"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                        Categories
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        📂 Manage your book categories and classifications
                    </p>
                </div>
            </div>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ $categories->total() }} categories
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Add New Category Button -->
            @can('create', App\Models\Category::class)
                <div class="mb-8">
                    <a 
                        href="{{ route('categories.create') }}" 
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        ➕ Add New Category
                    </a>
                </div>
            @endcan

            <!-- Categories Grid View -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @forelse($categories as $category)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 group">
                        <div class="p-6">
                            <!-- Category Icon & Name -->
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="h-12 w-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-lg group-hover:scale-110 transition-transform duration-200">
                                    {{ substr($category->name, 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-200">
                                        {{ $category->name }}
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Category ID: #{{ $category->id }}
                                    </p>
                                </div>
                            </div>

                            <!-- Stats -->
                            <!-- <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Books in category</span>
                                    <span class="text-lg font-bold text-indigo-600 dark:text-indigo-400">
                                        {{ $category->books_count ?? 0 }}
                                    </span>
                                </div>
                            </div> -->

                            <!-- Actions -->
                            <div class="flex space-x-2">
                                @can('update', $category)
                                    <a 
                                        href="{{ route('categories.edit', $category) }}" 
                                        class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200 shadow-sm"
                                    >
                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                @endcan

                                @can('delete', $category)
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit"
                                            class="inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 transition-colors duration-200 shadow-sm" 
                                            onclick="return confirm('Are you sure you want to delete this category? This action cannot be undone.')"
                                        >
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-12">
                            <div class="flex flex-col items-center justify-center space-y-4">
                                <div class="h-16 w-16 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-4H3m16 8H1m18 4H3"></path>
                                    </svg>
                                </div>
                                <div class="text-gray-500 dark:text-gray-400">
                                    <h3 class="text-lg font-medium">No categories found</h3>
                                    <p class="text-sm mt-1">Get started by creating your first book category.</p>
                                </div>
                                @can('create', App\Models\Category::class)
                                    <a 
                                        href="{{ route('categories.create') }}" 
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 text-white font-medium rounded-xl transition-all duration-200"
                                    >
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Add First Category
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>


            <!-- Pagination -->
            <div class="mt-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</x-app-layout>