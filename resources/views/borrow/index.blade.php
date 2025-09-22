<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Borrow Records
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-200 text-red-800 p-2 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <table class="min-w-full border">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 border">Book</th>
                            <th class="px-4 py-2 border">User</th>
                            <th class="px-4 py-2 border">Borrowed At</th>
                            <th class="px-4 py-2 border">Returned At</th>
                            <th class="px-4 py-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="border px-4 py-2">{{ $record->book->title }}</td>
                                <td class="border px-4 py-2">{{ $record->user->name }}</td>
                                <td class="border px-4 py-2">{{ $record->borrowed_at }}</td>
                                <td class="border px-4 py-2">
                                    {{ $record->returned_at ?? 'Not returned' }}
                                </td>
                                <td class="border px-4 py-2">
                                    @if(!$record->returned_at && Auth::id() === $record->user_id)
                                        <form action="{{ route('borrow.return', $record->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">
                                                Return
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-500">N/A</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $records->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
