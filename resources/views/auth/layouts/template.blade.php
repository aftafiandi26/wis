<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Wide Information Systems') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <style>
        .body {
            background-image: linear-gradient(to right, #3366ff, yellow, maroon);
        }

        @keyframes bodys {
            from {
                background-color: mediumblue;
            }

            to {
                background-color: lightblue;
            }
        }
    </style>

    @stack('style')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="body">
    <div>
        @include('sweetalert::alert')
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>