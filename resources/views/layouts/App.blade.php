<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'LinenFresh') — Systematic Trust in Every Wash</title>
    <meta name="description" content="@yield('meta_description', 'Professional laundry services designed for busy urbanites.')">

    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Tailwind CSS (via Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Page-specific styles --}}
    @stack('styles')
</head>
<body class="bg-white text-gray-900 antialiased">

    {{-- NAVBAR --}}
    @include('components.navbar.navbar')

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('components.footer.footer')

    {{-- Navbar mobile toggle script --}}
    <script>
        const toggle = document.getElementById('navToggle');
        const menu   = document.getElementById('mobileMenu');
        if (toggle && menu) {
            toggle.addEventListener('click', () => {
                menu.classList.toggle('hidden');
                menu.classList.toggle('flex');
            });
        }
    </script>

    {{-- Page-specific scripts --}}
    @stack('scripts')

</body>
</html>