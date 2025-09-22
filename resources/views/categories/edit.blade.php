<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="h-10 w-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Edit Category
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    ✏️ Update "{{ $category->name }}" category details
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-orange-50 to-red-50 dark:from-gray-700 dark:to-gray-800 px-8 py-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                                <span class="mr-3">🏷️</span>
                                Update Category
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                Modify the category name and settings
                            </p>
                        </div>
                        <div class="hidden sm:block">
                            <div class="flex items-center space-x-2 bg-white dark:bg-gray-700 rounded-xl px-4 py-2 shadow-sm">
                                <div class="h-8 w-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                    {{ substr($category->name, 0, 1) }}
                                </div>
                                <div class="text-sm">
                                    <div class="font-medium text-gray-900 dark:text-white">{{ $category->name }}</div>
                                    <div class="text-gray-500 dark:text-gray-400">Category #{{ $category->id }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="px-8 py-8">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Category Name -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 flex items-center">
                                <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Category Name
                            </label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="name"
                                    name="name" 
                                    value="{{ old('name', $category->name) }}" 
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-orange-500 focus:bg-white dark:focus:bg-gray-800 transition-all duration-200 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                    placeholder="Enter category name..."
                                    required
                                >
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('name')
                                <div class="flex items-center mt-2 text-red-600 dark:text-red-400">
                                    <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-sm font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button 
                                type="submit"
                                class="flex-1 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                <span>Update Category</span>
                            </button>
                            
                            <a 
                                href="{{ route('categories.index') }}"
                                class="flex-1 sm:flex-none bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold py-3 px-6 rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span>Cancel</span>
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Additional Info Footer -->
                <!-- <div class="bg-gray-50 dark:bg-gray-900 px-8 py-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
                        <div class="flex items-center space-x-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Last updated: {{ $category->updated_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-2 py-1 rounded-full">
                                Active
                            </span>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</x-app-layout>