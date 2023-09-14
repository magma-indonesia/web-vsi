@extends('dashboard.template.layout')

@section('title', 'Edit press release')

@section('body-content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page"><a
                        href="{{ route('dashboard.press-release.index') }}">Press Release</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Press Release</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Edit Press Release</h4>
    </div>
</div>
<div class="p-3" id="app">
    <form-press-release 
        apiurl="{{ env('APP_URL') }}" 
        backurl="{{ route('dashboard.press-release.index') }}"
        retrieve="{{ $retrieve }}"
        role="{{ auth()->user()->role->id }}"
    ></form-press-release>
</div>
@endsection
