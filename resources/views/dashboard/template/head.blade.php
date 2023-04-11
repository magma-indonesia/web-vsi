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
    <link href="{{ asset('dashforge/lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashforge/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">

    {{-- DashForge CSS --}}
    <link href="{{ asset('dashforge/assets/css/dashforge.css') }}" rel="stylesheet">
    <link href="{{ asset('dashforge/assets/css/dashforge.dashboard.css') }}" rel="stylesheet">

    {{-- LOAD ONLY JQUERY IN HEADER SO WE COULD SLIP IN ANOTHER JS FILE PER CONTENTS --}}
    <script src="{{ asset('dashforge/lib/jquery/jquery.min.js') }}"></script>
    <style>
        .table-hover:hover {
            border-radius: 5px;
            cursor: pointer;
            box-shadow: inset 1px 0 0 #dadce0, inset -1px 0 0 #dadce0, 0 1px 2px 0 rgba(60,64,67,.3), 0 1px 3px 1px rgba(60,64,67,.15);
        }
    </style>
</head>
