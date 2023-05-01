@extends('dashboard.template.layout')

@section('title')
    {{ $isUpdate ? 'Ubah' : 'Tambah' }} {{ $pageTitle }}
@endsection

@section('body-content')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.pegawai.index') }}">Pegawai</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $isUpdate ? 'Ubah' : 'Tambah' }}</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">{{ $isUpdate ? 'Ubah' : 'Tambah' }} Pegawai</h4>
        </div>
    </div>
    <div class="p-3" id="app">
        <form-user
            apiurl="{{ $appUrl }}"
            backurl="{{ route('dashboard.pegawai.index') }}"
            retrieve="{{ $retrieve }}"
            segments="{{ $segments }}"
            roles="{{ $roles }}"
            groupclasses="{{ json_encode($groupClasses) }}"
        ></form-user>
    </div>
@endsection