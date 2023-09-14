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
                    @if ($roleSlug != Param::ROLE_SLUG_ADMIN)
                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.upload-center.index') }}">{{ $pageTitle }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
                    @endif
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">{{ $pageTitle }}</h4>
        </div>
    </div>
    <div class="p-3" id="app">
        <table-upload-center
            apiurl="{{ $appUrl }}"
            addurl="{{ $addUrl }}"
            role="{{ $roleSlug }}"
            loginid="{{ $loginId }}"
            userid="{{ $user->id }}"
        >
        </table-upload-center>
    </div>
@endsection