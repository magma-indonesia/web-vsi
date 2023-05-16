@extends('dashboard.template.layout')

@section('title')
    {{ $pageTitle }}
@endsection

@section('body-content')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">{{ $pageTitle }}</h4>
        </div>
    </div>
    <div class="p-3" id="app">
        <table-public-service apiurl="{{ $appUrl }}" addurl="{{ $addUrl }}"
            editurl="{{ $editUrl }}" category="{{ $category }}">
        </table-public-service>
    </div>
@endsection