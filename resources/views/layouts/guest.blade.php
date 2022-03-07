<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Small Hurry') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/small-hurry.jpeg')}}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{asset('assets/css/notiflix.css')}}" rel="stylesheet" type="text/css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/notiflix.js')}}"></script>
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
    @yield('script')
</body>

</html>