<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                📖 My Borrowed Books
            </h2>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ $borrowedBooks->count() }} borrowed
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    📚 Title
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    ✍️ Author
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    ⏰ Due Date
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($borrowedBooks as $borrow)
                                @php
                                    $isOverdue = $borrow->due_date && $borrow->due_date < now();
                                @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 {{ $isOverdue ? 'bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500' : '' }}">
                                    <!-- Title -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-start space-x-3">
                                            <div class="h-10 w-10 flex items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 text-white font-bold">
                                                {{ substr($borrow->book->title, 0, 1) }}
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $borrow->book->title }}
                                                </h3>
                                                @if($isOverdue)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 mt-1">
                                                        ⚠️ Overdue
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Author -->
                                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                                        {{ $borrow->book->author }}
                                    </td>

                                    <!-- Due Date -->
                                    <td class="px-6 py-4">
                                        <span class="font-medium {{ $isOverdue ? 'text-red-600 dark:text-red-400' : 'text-gray-700 dark:text-gray-300' }}">
                                            {{ $borrow->due_date ? $borrow->due_date->format('M j, Y') : 'No due date' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
