<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="flex flex-col md:flex-row min-h-screen">

        <div
            class="relative flex-1 bg-gradient-to-br from-emerald-900 via-emerald-700 to-emerald-600 flex items-center justify-center overflow-hidden min-h-[280px] md:min-h-screen">

            <div class="absolute -top-24 -right-24 w-72 h-72 bg-white/10 rounded-full"></div>
            <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-white/5 rounded-full"></div>

            <div class="absolute top-6 left-6 md:top-8 md:left-8 z-20 hidden md:flex items-center gap-3">
                <div
                    class="w-10 h-10 md:w-12 md:h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center p-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain" />
                </div>
                <span class="text-white font-bold tracking-wide text-sm md:text-lg">
                    PonPes Syekh Mahmud
                </span>
            </div>

            <div class="relative z-10 text-center px-10">
                <div
                    class="inline-flex items-center justify-center w-32 h-32 md:w-48 md:h-48 bg-gradient-to-br from-white/15 to-white/5 backdrop-blur-xl rounded-full border-2 border-white/30 shadow-2xl mb-6 overflow-hidden p-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Besar" class="w-full h-full object-contain" />
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">
                    Selamat Datang
                </h1>
                <p class="text-white/80 text-base md:text-lg max-w-sm mx-auto leading-relaxed">
                    Sistem Manajemen Pesantren Syekh Mahmud
                </p>
            </div>
        </div>

        <div class="flex-1 flex flex-col justify-center items-center p-8 md:p-12 bg-white">
            <div class="w-full max-w-[420px]">
                {{ $slot }}
            </div>
        </div>

    </div>
</body>

</html>
