<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BookVault') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col">
            
            <!-- Navigation -->
            <nav class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16 items-center">
                        
                        <!-- Logo / App Name -->
                        <div class="flex-shrink-0 flex items-center text-xl font-bold text-gray-900 dark:text-white">
                            📚 {{ config('app.name', 'Library Manager') }}
                        </div>

                        <!-- Nav Links -->
                        <div class="hidden md:flex space-x-4">
                            <a href="{{ route('books.index') }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                Books
                            </a>
                            <a href="{{ route('categories.index') }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                Categories
                            </a>
                            <a href="{{ route('borrow.index') }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                Borrow Records
                            </a>
                        </div>

                        <!-- User Dropdown / Profile -->
                        <div class="flex items-center space-x-2">
                            @include('layouts.navigation')
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
