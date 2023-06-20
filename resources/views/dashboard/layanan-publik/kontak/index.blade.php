@extends('dashboard.template.layout')

@section('title', 'Kontak')

@section('body-content')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kontak</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Kontak</h4>
        </div>
    </div>

    <div class="p-3" id="app">
        <table-contact apiurl="{{ $appUrl }}" />
    </div>
@endsection

@push('scripts')
    <script>
        function changeMode(url) {
            window.location.href = url;
        }
    </script>
@endpush
