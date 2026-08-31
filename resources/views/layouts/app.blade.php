<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

        <script>
            try {
                const root = document.documentElement;
                root.classList.toggle(
                    'theme-high-contrast',
                    localStorage.getItem('accessibility.highContrast') === 'true'
                );
                root.classList.toggle(
                    'theme-large-text',
                    localStorage.getItem('accessibility.largeText') === 'true'
                );
            } catch (error) {
                // The default theme remains available when browser storage is blocked.
            }
        </script>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="app-shell">
        <x-sidebar></x-sidebar>
        <x-sidebarToggleButton />
        <main class="app-main">
            @yield('content')
        </main>
    </body>
</html>
