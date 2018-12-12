<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check()
        ]) !!};
    </script>
    
    @yield('head')
</head>
<body class="bg-blue-lightest h-screen antialiased font-sans">
    <div id="app" v-cloak>
        @include('admin.layouts.nav')

        @yield('content')

        <flash message="{{ session('flash') }}"></flash>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
