@extends('dashboard.template.layout')

@section('title', 'Tanggapan Kejadian Gerakan Tanah')

@section('body-content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item">Gerakan Tanah</li>
                <li class="breadcrumb-item active" aria-current="page">Tanggapan Kejadian</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Tanggapan Kejadian</h4>
    </div>
</div>
<div class="p-3" id="app">
    <table-news apiurl="{{ env('APP_URL') }}" addurl="{{ route('dashboard.gerakan-tanah.news.add') }}?category=4"
        editurl="{{ route('dashboard.gerakan-tanah.news.edit', 0) }}" category="4">
    </table-news>
</div>
@endsection