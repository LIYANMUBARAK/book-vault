<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="h-10 w-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                        Borrow Records
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        📋 Track all library borrowing activity
                    </p>
                </div>
            </div>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ $records->total() }} total records
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-700 rounded-2xl p-4 shadow-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800 dark:text-green-200">
                                ✅ {{ session('success') }}
                            </p>
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 dark:bg-green-900/20 text-green-500 rounded-lg focus:ring-2 focus:ring-green-600 p-1.5 hover:bg-green-100 dark:hover:bg-green-800/40 transition-colors" onclick="this.parentElement.parentElement.remove()">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/20 dark:to-pink-900/20 border border-red-200 dark:border-red-700 rounded-2xl p-4 shadow-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800 dark:text-red-200">
                                ❌ {{ session('error') }}
                            </p>
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 dark:bg-red-900/20 text-red-500 rounded-lg focus:ring-2 focus:ring-red-600 p-1.5 hover:bg-red-100 dark:hover:bg-red-800/40 transition-colors" onclick="this.parentElement.parentElement.remove()">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Records Table -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    📚 Book Details
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    👤 Borrower
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    📅 Borrowed Date
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    ↩️ Return Status
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    ⚙️ Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($records as $record)
                                @php
                                    $isOverdue = !$record->returned_at && $record->due_date && $record->due_date < now();
                                    $isActive = !$record->returned_at;
                                @endphp
                                
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 {{ $isOverdue ? 'bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500' : ($isActive ? 'bg-yellow-50 dark:bg-yellow-900/10 border-l-4 border-yellow-500' : '') }}">
                                    <!-- Book Details -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                <div class="h-12 w-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                                                    {{ substr($record->book->title, 0, 1) }}
                                                </div>
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    {{ $record->book->title }}
                                                </h3>
                                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                                    by {{ $record->book->author }}
                                                </p>
                                                @if($record->book->category)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200 mt-1">
                                                        {{ $record->book->category->name }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Borrower -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-2">
                                            <div class="h-8 w-8 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                                {{ substr($record->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $record->user->name }}
                                                </div>
                                                <div class="text-xs text-gray-600 dark:text-gray-400">
                                                    {{ $record->user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Borrowed Date -->
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            <div class="font-medium">
                                                {{ $record->borrowed_at ? \Carbon\Carbon::parse($record->borrowed_at)->format('M j, Y') : 'N/A' }}
                                            </div>
                                            <div class="text-xs text-gray-600 dark:text-gray-400">
                                                {{ $record->borrowed_at ? \Carbon\Carbon::parse($record->borrowed_at)->format('g:i A') : '' }}
                                            </div>
                                            @if($record->due_date && !$record->returned_at)
                                                <div class="text-xs mt-1 {{ $isOverdue ? 'text-red-600 dark:text-red-400 font-bold' : 'text-orange-600 dark:text-orange-400' }}">
                                                    Due: {{ \Carbon\Carbon::parse($record->due_date)->format('M j, Y') }}
                                                    @if($isOverdue)
                                                        <span class="block">⚠️ Overdue</span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Return Status -->
                                    <td class="px-6 py-4">
                                        @if($record->returned_at)
                                            <div class="flex items-center space-x-2">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    ✅ Returned
                                                </span>
                                            </div>
                                            <div class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                                {{ \Carbon\Carbon::parse($record->returned_at)->format('M j, Y g:i A') }}
                                            </div>
                                        @else
                                            <div class="flex items-center space-x-2">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $isOverdue ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                                                    {{ $isOverdue ? '⚠️ Overdue' : '📖 Active' }}
                                                </span>
                                            </div>
                                            @if($record->due_date)
                                                @php
                                                    $daysUntilDue = \Carbon\Carbon::parse($record->due_date)->diffInDays(now(), false);
                                                @endphp
                                                <div class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                                    @if($daysUntilDue > 0)
                                                        {{ $daysUntilDue }} day{{ $daysUntilDue != 1 ? 's' : '' }} overdue
                                                    @else
                                                        {{ abs($daysUntilDue) }} day{{ abs($daysUntilDue) != 1 ? 's' : '' }} remaining
                                                    @endif
                                                </div>
                                            @endif
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4">
                                        @if(!$record->returned_at && Auth::id() === $record->user_id)
                                            <form action="{{ route('borrow.return', $record->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button 
                                                    type="submit" 
                                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                                    onclick="return confirm('Are you sure you want to return this book?')"
                                                >
                                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                                    </svg>
                                                    Return Book
                                                </button>
                                            </form>
                                        @else
                                            <span class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                                                @if($record->returned_at)
                                                    📋 Completed
                                                @else
                                                    📖 Not Returned
                                                @endif
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-3">
                                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                            <div class="text-gray-500 dark:text-gray-400">
                                                <h3 class="text-lg font-medium">No borrow records found</h3>
                                                <p class="text-sm mt-1">There are no borrowing activities to display.</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                {{ $records->links() }}
            </div>
        </div>
    </div>
</x-app-layout>