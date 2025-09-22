<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">👤 Profile</h2>
            <span class="text-sm text-gray-500 dark:text-gray-400">
                Last updated: {{ $user->updated_at->format('M j, Y') }}
            </span>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Update Profile Info --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">✏️ Update Information</h3>
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                               class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                               class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            {{-- Update Password --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">🔒 Change Password</h3>
                <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                    @csrf
                    @method('put')

                    <div>
                        <x-input-label for="current_password" :value="__('Current Password')" />
                        <x-text-input id="current_password" name="current_password" type="password"
                                      class="mt-1 block w-full rounded-lg dark:bg-gray-700 dark:text-white" autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('New Password')" />
                        <x-text-input id="password" name="password" type="password"
                                      class="mt-1 block w-full rounded-lg dark:bg-gray-700 dark:text-white" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                      class="mt-1 block w-full rounded-lg dark:bg-gray-700 dark:text-white" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg">
                            {{ __('Update Password') }}
                        </x-primary-button>

                        @if(session('status') === 'password-updated')
                            <p class="text-sm text-green-600 dark:text-green-400">✅ Password updated!</p>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Delete Account --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-red-600 dark:text-red-400 mb-4">⚠️ Delete Account</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    Once deleted, all your data will be permanently removed. Please confirm with your password.
                </p>
                <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
                    @csrf
                    @method('DELETE')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                        <input type="password" name="password"
                               class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-red-500 focus:border-red-500">
                    </div>

                    <div>
                        <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg shadow-md">
                            Delete Account
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
