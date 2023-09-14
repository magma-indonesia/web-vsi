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
        <div class="col-sm-12 col-lg-6">
            <form class="form-inline">
                <div class="form-group mx-sm-1 mb-2">
                    <label for="search" class="sr-only">Judul Artikel</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Judul Artikel" value="{{ request()->get('search') }}">
                </div>
                
                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="text-right">
                <button type="button" class="btn btn-sm btn-outline-primary mb-2" onclick="window.location='{{ $createUrl }}'"><i class="fa fa-plus"></i> Tambah</button>
            </div>
        </div>
    </div>
    <div class="row row-xs">
        <div class="col-sm-12 col-lg-12">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                    <th class="col-sm-1 text-center">#</th>
                    <th class="col-sm-6">Judul Artikel</th>
                    <th class="col-sm-2 text-center">Tanggal</th>
                    <th class="col-sm-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $currentPage = $events->currentPage();
                        $perPage = $events->perPage();
                        $index = 1 + ($perPage * ($currentPage - 1));
                    @endphp
                    @forelse ($events as $event)
                        <tr>
                            <th scope="row" class="text-center align-middle">
                                {{ $index++ }}
                            </th>
                            <td class="align-middle">
                                {{ $event->title }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $event->created_at->translatedFormat('d M Y H:i:s') }}
                            </td>
                            <td class="text-center align-middle">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('dashboard.gerakan-tanah.kejadian.destroy', $event->id) }}" method="POST">
                                    <a href="{{ route('dashboard.gerakan-tanah.kejadian.edit', $event->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Ubah</a>
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
                {{ $events->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection