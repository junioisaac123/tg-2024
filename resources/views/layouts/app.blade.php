<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Load favicon --}}
    <link rel="shortcut icon" href="{{ asset('logo-min.png') }}" type="image/x-icon">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @yield('head.scrpits')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased bg-white dark:bg-gray-900" x-data="{ sidebarOpen: false }">

    @include('layouts.navigation')

    @include('layouts.aside')

    <div class="sm:ml-64">

        <main class="mt-16">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <div class="p-4 relative">
                {{ $slot }}

            </div>
        </main>

    </div>

    @yield('body.script')

    @if (session('status') == 'success')
        <script>
            // on load document
            document.addEventListener('DOMContentLoaded', function() {
                SwalFCC({
                    icon: 'success',
                    title: '{{ __('Success') }}',
                    text: '{{ session('message') }}',
                    confirmButtonText: 'OK'
                });
            })
        </script>
    @elseif (session('status') == 'error')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                SwalFCC({
                    icon: 'error',
                    title: '{{ __('Error') }}',
                    text: '{{ session('message') }}',
                    confirmButtonText: 'OK'
                });
            })
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                SwalFCC({
                    icon: 'error',
                    title: 'Error de Validación',
                    html: `
<ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400" style="text-align: left;">
     @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
                `,
                });
            });
        </script>
    @endif

</body>

</html>
