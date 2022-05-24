<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#fee50f">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Login')</title>

    <link href="{{ asset('faviconesdm.png') }}" rel="icon">
    <link href="{{ asset('faviconesdm-large.png') }}" rel="apple-touch-icon">

    {{-- Vendor CSS --}}
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    {{-- Auth CSS --}}
</head>
