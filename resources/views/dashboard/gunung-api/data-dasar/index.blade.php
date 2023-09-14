@extends('dashboard.template.layout')

@section('title', 'Data dasar gunung api')

@section('body-content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item">Gunung Api</li>
                <li class="breadcrumb-item active" aria-current="page">Data dasar</li>
            </ol>
        </nav>
    </div>
</div>

<div class="p-3" id="app">
    <table-news 
        apiurl="{{ route('dashboard.gunung-api.data-dasar.get') }}" 
        addurl="{{ route('dashboard.gunung-api.data-dasar.add') }}"
        editurl="{{ route('dashboard.gunung-api.data-dasar.edit', 0) }}"
    >
    </table-news>
</div>
@endsection
