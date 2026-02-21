<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pesantren Syekh Mahmud') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body 
    x-data="{ 
        sidebarOpen: false, 
        toggleSidebar() { 
            this.sidebarOpen = !this.sidebarOpen 
        } 
    }"
    class="font-sans antialiased"
>
    <div class="flex h-screen bg-gray-100 overflow-hidden">
        
        @include('layouts.sidebar')
        <div 
            x-show="sidebarOpen" 
            class="fixed inset-0 bg-black bg-opacity-40 z-30 md:hidden"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false"
        ></div>

        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow-sm z-8">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1 overflow-y-auto p-4 md:p-6 text-gray-900">
                {{ $slot }}
            </main>

        </div>
    </div>
</body>
</html>
