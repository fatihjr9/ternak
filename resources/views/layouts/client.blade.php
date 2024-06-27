<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ternak Sapi</title>
    <!-- Scripts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
    @livewireStyles
</head>
<body>
    <div class="bg-white border-b">
        <div class="px-4 md:px-6 py-4 drop-shadow-sm flex flex-row items-center justify-between">
            <a href="{{ url('/') }}">
                <x-application-mark/>
            </a>
            <div class="flex flex-row gap-x-6 items-center divide-x">
                <a href="{{ route('keranjang') }}" class=" transition hover:text-emerald-500">Keranjang</a>
                @if (Route::has('login'))
                    <div class="pl-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="rounded-md text-black transition hover:text-emerald-500">
                                Dashboard
                            </a>
                        @else
                            <div class="flex flex-row gap-x-2 items-center">
                                <a href="{{ route('login') }}" class="rounded-md text-black transition hover:text-emerald-500">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="rounded-md text-black transition hover:text-emerald-500">
                                        Daftar
                                    </a>
                                @endif
                            </div>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="px-4 md:px-6 py-4 mx-auto">
        @yield('content')
    </div>
</body>
</html>