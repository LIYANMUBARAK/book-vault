<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                📊 Admin Dashboard
            </h2>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Last updated: {{ now()->format('M j, Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Books -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Books</p>
                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalBooks }}</p>
                        </div>
                        <div class="h-12 w-12 flex items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-900/40 dark:text-blue-300">
                            📚
                        </div>
                    </div>
                </div>

                <!-- Borrowed Books -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Borrowed Books</p>
                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $borrowedBooks }}</p>
                        </div>
                        <div class="h-12 w-12 flex items-center justify-center rounded-xl bg-yellow-100 text-yellow-600 dark:bg-yellow-900/40 dark:text-yellow-300">
                            📖
                        </div>
                    </div>
                </div>

                <!-- Overdue Books -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Overdue Books</p>
                            <p class="mt-2 text-3xl font-bold text-red-600 dark:text-red-400">{{ $overdueBooks }}</p>
                        </div>
                        <div class="h-12 w-12 flex items-center justify-center rounded-xl bg-red-100 text-red-600 dark:bg-red-900/40 dark:text-red-300">
                            ⚠️
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
