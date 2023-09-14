@extends('dashboard.template.layout')

@section('title', 'Edit data dasar gunung api')

@section('body-content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item">Gunung Api</li>
                <li class="breadcrumb-item" aria-current="page"><a
                        href="{{ route('dashboard.gunung-api.data-dasar.index') }}">Data dasar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit data dasar</li>
            </ol>
        </nav>
    </div>
</div>
<div class="p-3" id="app">
    <form-news 
        category="1" 
        apiurl="{{ route('dashboard.gunung-api.data-dasar.update') }}" 
        backurl="{{ route('dashboard.gunung-api.data-dasar.index') }}"
        retrieve="{{ $retrieve }}"
    ></form-news>
</div>
@endsection
