@extends('dashboard.template.layout')

@section('title', 'Edit press release gunung api')

@section('body-content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item">Gunung Api</li>
                <li class="breadcrumb-item" aria-current="page"><a
                        href="{{ route('dashboard.gunung-api.news') }}?category=3">Press Release</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Press Release</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Edit Press Release Gunung Api</h4>
    </div>
</div>
<div class="p-3" id="app">
    <form-news apiurl="{{ env('APP_URL') }}" category="3" backurl="{{ route('dashboard.gunung-api.news') }}?category=3"
        retrieve="{{ $retrieve }}"></form-news>
</div>
@endsection
