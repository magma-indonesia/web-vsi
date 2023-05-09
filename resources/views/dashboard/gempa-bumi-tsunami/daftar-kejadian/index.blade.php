@extends('dashboard.template.layout')

@section('title', 'Daftar kejadian gempa & tsunami')

@section('body-content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item">Gempa Bumi & Tsunami</li>
                <li class="breadcrumb-item active" aria-current="page">Daftar kejadian</li>
            </ol>
        </nav>
    </div>
</div>
<div class="p-3" id="app">
    <table-news 
        apiurl="{{ route('dashboard.gempa-bumi-tsunami.daftar-kejadian.get') }}" 
        addurl="{{ route('dashboard.gempa-bumi-tsunami.daftar-kejadian.add') }}"
        editurl="{{ route('dashboard.gempa-bumi-tsunami.daftar-kejadian.edit', 0) }}"
    >
    </table-news>
</div>
@endsection
