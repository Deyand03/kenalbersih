<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/css/style.css'])
</head>
<body>
    {{-- Navbar --}}
    <nav>
        <x-navbar></x-navbar>
    </nav>
    {{-- Content --}}
    <div class="pt-[64]">
        @yield('content')
    </div>
    {{-- Footer --}}
    <footer>

    </footer>

    @vite(['resources/js/app,js'])
    @stack('scripts')
</body>
</html>
