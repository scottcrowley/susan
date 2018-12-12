<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('head')
</head>
<body class="bg-blue-lightest h-screen antialiased font-sans">
    <div id="app" v-cloak>
        @include('layouts.nav')

        @yield('content')

        <flash message="{{ session('flash') }}"></flash>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
