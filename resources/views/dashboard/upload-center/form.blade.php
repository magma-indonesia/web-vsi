@extends('dashboard.template.blank-layout')

@section('title')
    {{ $isUpdate ? 'Ubah' : 'Tambah' }} {{ $pageTitle }}
@endsection

@section('body-content')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item">{{ $pageTitle }}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $isUpdate ? 'Ubah' : 'Tambah' }}</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">{{ $isUpdate ? 'Ubah' : 'Tambah' }} File</h4>
        </div>
    </div>
    <div class="p-3" id="app">
        <form-upload-center
            apiurl="{{ $appUrl }}"
        >
        </form-upload-center>
    </div>
@endsection