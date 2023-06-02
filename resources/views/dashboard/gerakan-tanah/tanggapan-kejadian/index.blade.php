@extends('dashboard.template.layout')

@section('title', 'Tanggapan kejadian gerakan tanah')

@section('body-content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item">Gerakan Tanah</li>
                <li class="breadcrumb-item active" aria-current="page">Tanggapan kejadian</li>
            </ol>
        </nav>
    </div>
</div>
<div class="p-3" id="app">
    <table-news
        apiurl="{{ route('dashboard.tanggapan-kejadian.get') }}" 
        addurl="{{ route('dashboard.tanggapan-kejadian.add') }}"
        editurl="{{ route('dashboard.tanggapan-kejadian.edit', 0) }}"
    >
    </table-news>
</div>
@endsection
