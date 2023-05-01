@extends('dashboard.template.layout')

@section('title', 'Tambah kajian kejadian')

@section('body-content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item">Gempa Bumi & Tsunami</li>
                <li class="breadcrumb-item" aria-current="page"><a
                        href="{{ route('dashboard.gempa-bumi-tsunami.news') }}?category=5">Kajian Kejadian</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Kajian Kejadian</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Tambah Kajian Kejadian</h4>
    </div>
</div>
<div class="p-3" id="app">
    <form-news apiurl="{{ env('APP_URL') }}" category="5" backurl="{{ route('dashboard.gempa-bumi-tsunami.news') }}?category=5"></form-news>
</div>
@endsection
