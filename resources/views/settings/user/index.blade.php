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
                    <li class="breadcrumb-item active" aria-current="page">Pegawai</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Pegawai</h4>
        </div>
    </div>
    @include('partials.message')
    <div class="row row-xs">
        <div class="col-sm-12 col-lg-6">
            <form class="form-inline">
                <div class="form-group mx-sm-1 mb-2">
                    <label for="search" class="sr-only">NIP / Nama</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="NIP / Nama" value="{{ request()->get('search') }}">
                </div>
                
                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="text-right">
                <button type="button" class="btn btn-sm btn-outline-info mb-2 mr-2" onclick="window.location='{{ $exportCsvUrl }}'"><i class="fa fa-download"></i> Export Csv</button>
                <button type="button" class="btn btn-sm btn-outline-info mb-2 mr-2" onclick="window.location='{{ $exportExcelUrl }}'"><i class="fa fa-download"></i> Export Excel</button>
                <button type="button" class="btn btn-sm btn-outline-primary mb-2" onclick="window.location='{{ $createUrl }}'"><i class="fa fa-plus"></i> Tambah</button>
            </div>
        </div>
    </div>
    <div class="row row-xs">
        <div class="col-sm-12 col-lg-12">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                    <th class="text-center">#</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th class="text-center">Golongan</th>
                    <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $currentPage = $users->currentPage();
                        $perPage = $users->perPage();
                        $index = 1 + ($perPage * ($currentPage - 1));
                    @endphp
                    @forelse ($users as $user)
                        <tr>
                            <th scope="row" class="text-center align-middle">
                                {{ $index++ }}
                            </th>
                            <td class="align-middle">
                                {{ $user->nip }}
                            </td>
                            <td class="align-middle">
                                {{ $user->name }}
                            </td>
                            <td class="align-middle">
                                {{ $user->position }}
                            </td>
                            <td class="text-center align-middle">
                                {{ $user->group . '/' . $user->class }}
                            </td>
                            <td class="text-center align-middle">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('settings.employee.destroy', $user->id) }}" method="POST">
                                    <a href="{{ route('settings.employee.edit', $user->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Ubah</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
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
                {{ $users->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection