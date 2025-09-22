<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <ul class="space-y-2">
                    <li>Total Books: {{ $totalBooks }}</li>
                    <li>Borrowed Books: {{ $borrowedBooks }}</li>
                    <li>Overdue Books: <span class="text-red-600">{{ $overdueBooks }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
