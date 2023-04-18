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
    @include('partials.message')
    <div class="row row-xs">
        <div class="col-sm-12 col-lg-9">
            <form class="form-inline">
                <div class="form-group mx-sm-1 mb-2">
                    <label for="search" class="sr-only">Nama File</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Nama File" value="{{ request()->get('search') }}">
                </div>
                
                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="col-sm-12 col-lg-3">
            <div class="text-right">
                <button type="button" class="btn btn-sm btn-outline-primary mb-2" onclick="window.open('{{ $createUrl }}', '_blank', 'height=400,width=1024,toolbar=1,Location=0,Directories=0,Status=0,menubar=0,Scrollbars=0,Resizable=0');"><i class="fa fa-plus"></i> Tambah</button>
            </div>
        </div>
    </div>
    <div class="row row-xs">
        <div class="col-sm-12 col-lg-12">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                    <th class="text-center">#</th>
                    <th>Nama File</th>
                    <th>Path File</th>
                    <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $currentPage = $files->currentPage();
                        $perPage = $files->perPage();
                        $index = 1 + ($perPage * ($currentPage - 1));
                    @endphp
                    @forelse ($files as $file)
                        <tr>
                            <th scope="row" class="text-center align-middle">
                                {{ $index++ }}
                            </th>
                            <td class="align-middle">
                                {{ $file->name }}
                            </td>
                            <td class="align-middle">
                                {{ $file->path }}
                            </td>
                            <td class="text-center align-middle">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('settings.upload.destroy', $file->id) }}" method="POST">
                                    <a href="{{ $file->url() }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-download"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="text-center">
                                    Data tidak ditemukan
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="row row-xs">
        <div class="col-sm-12 col-lg-12">
            <div class="text-right">
                {{ $files->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection