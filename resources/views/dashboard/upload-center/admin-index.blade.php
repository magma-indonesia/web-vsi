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
        <div class="d-md-flex align-items-start mt-3 mt-md-0">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary">
                    <input type="radio" name="options" autocomplete="off" @checked($mode == 'folder') onclick="changeMode('{{ route('dashboard.upload-center.index', ['mode' => 'folder']) }}');">
                    <i data-feather="folder" class="wd-10"></i>
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="options" autocomplete="off" @checked($mode == 'list') onclick="changeMode('{{ route('dashboard.upload-center.index', ['mode' => 'list']) }}');">
                    <i data-feather="list" class="wd-10"></i>
                </label>
            </div>
        </div>
    </div>
    
    <div class="p-3" id="app">
        @if ($mode == 'list')
            <table-upload-center-employee
                apiurl="{{ $appUrl }}"
                addurl="{{ $addUrl }}"
                detailurl="{{ $detailUrl }}">
            </table-upload-center-employee>
        @else
            <card-upload-center-employee
                apiurl="{{ $appUrl }}"
                addurl="{{ $addUrl }}"
                detailurl="{{ $detailUrl }}">
            </card-upload-center-employee>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        function changeMode(url) {
            window.location.href = url;
        }
    </script>
@endpush