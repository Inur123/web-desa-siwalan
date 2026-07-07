<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('code') - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-desa.png') }}">
    @vite('resources/css/app.css')
</head>
<body class="@yield('bg-color', 'bg-gradient-to-br from-gray-50 to-blue-50')">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="text-center">
            <h1 class="@yield('text-color', 'text-gray-600') font-bold mb-4" style="font-size: 8rem;">
                @yield('code')
            </h1>
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">
                @yield('title')
            </h2>
            <p class="text-gray-600 mb-8">
                @yield('message')
            </p>
            <div class="flex gap-4 justify-center">
                <a href="javascript:history.back()" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                    Kembali
                </a>
                <a href="{{ route('guest.home') }}" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    Halaman Utama
                </a>
            </div>
        </div>
    </div>
</body>
