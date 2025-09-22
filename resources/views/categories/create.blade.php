<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="h-10 w-10 bg-gradient-to-br from-green-500 to-teal-600 rounded-xl flex items-center justify-center">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Add New Category
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    📂 Create a new book category for better organization
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-green-50 to-teal-50 dark:from-gray-700 dark:to-gray-800 px-8 py-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                        <span class="mr-3">🏷️</span>
                        Category Details
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        Enter the name for your new book category
                    </p>
                </div>

                <!-- Form Section -->
                <div class="px-8 py-8">
                    <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Category Name -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                                📝 Category Name *
                            </label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="name" 
                                    value="{{ old('name') }}"
                                    placeholder="e.g., Science Fiction, Biography, History..."
                                    class="block w-full px-4 py-4 text-lg border border-gray-300 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 shadow-sm {{ $errors->has('name') ? 'border-red-500 bg-red-50 dark:bg-red-900/20' : '' }}"
                                    required
                                    autocomplete="off"
                                >
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Category Suggestions -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-2xl p-6 border border-blue-200 dark:border-blue-700">
                            <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-200 mb-3 flex items-center">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                                💡 Popular Category Ideas
                            </h4>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                                <button type="button" onclick="document.querySelector('input[name=name]').value = 'Fiction'" class="text-xs px-3 py-2 bg-white dark:bg-gray-700 border border-blue-200 dark:border-blue-600 rounded-lg text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-800 transition-colors">Fiction</button>
                                <button type="button" onclick="document.querySelector('input[name=name]').value = 'Non-Fiction'" class="text-xs px-3 py-2 bg-white dark:bg-gray-700 border border-blue-200 dark:border-blue-600 rounded-lg text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-800 transition-colors">Non-Fiction</button>
                                <button type="button" onclick="document.querySelector('input[name=name]').value = 'Science'" class="text-xs px-3 py-2 bg-white dark:bg-gray-700 border border-blue-200 dark:border-blue-600 rounded-lg text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-800 transition-colors">Science</button>
                                <button type="button" onclick="document.querySelector('input[name=name]').value = 'History'" class="text-xs px-3 py-2 bg-white dark:bg-gray-700 border border-blue-200 dark:border-blue-600 rounded-lg text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-800 transition-colors">History</button>
                                <button type="button" onclick="document.querySelector('input[name=name]').value = 'Biography'" class="text-xs px-3 py-2 bg-white dark:bg-gray-700 border border-blue-200 dark:border-blue-600 rounded-lg text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-800 transition-colors">Biography</button>
                                <button type="button" onclick="document.querySelector('input[name=name]').value = 'Technology'" class="text-xs px-3 py-2 bg-white dark:bg-gray-700 border border-blue-200 dark:border-blue-600 rounded-lg text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-800 transition-colors">Technology</button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button 
                                type="submit" 
                                class="flex-1 sm:flex-none inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-green-600 to-teal-700 hover:from-green-700 hover:to-teal-800 text-white font-bold text-lg rounded-xl transition-all duration-200 transform hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 shadow-md"
                            >
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                💾 Create Category
                            </button>
                            
                            <a 
                                href="{{ route('categories.index') }}" 
                                class="flex-1 sm:flex-none inline-flex items-center justify-center px-8 py-4 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold text-lg rounded-xl transition-all duration-200 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                            >
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                ↩️ Back to Categories
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>