@extends('dashboard.template.layout')

@section('title', 'Press Release')

@section('body-content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Press Release</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Press Release</h4>
    </div>
</div>
<div class="p-3" id="app">
    <table-press-release apiurl="{{ env('APP_URL') }}" addurl="{{ route('dashboard.press-release.add') }}"
        editurl="{{ route('dashboard.press-release.edit', 0) }}">
    </table-press-release>
</div>
@endsection
