<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            My Borrowed Books
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <table class="min-w-full border">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="px-4 py-2 text-left">Title</th>
                            <th class="px-4 py-2 text-left">Author</th>
                            <th class="px-4 py-2 text-left">Due Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($borrowedBooks as $borrow)
                            <tr @if($borrow->due_date && $borrow->due_date < now()) class="bg-red-100 dark:bg-red-700" @endif>
                                <td class="px-4 py-2">{{ $borrow->book->title }}</td>
                                <td class="px-4 py-2">{{ $borrow->book->author }}</td>
                                <td class="px-4 py-2">{{ $borrow->due_date ? $borrow->due_date->format('d M Y') : 'No due date' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
