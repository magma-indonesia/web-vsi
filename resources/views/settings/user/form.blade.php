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
                    <li class="breadcrumb-item"><a href="{{ route('settings.employee.index') }}">Pegawai</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $isUpdate ? 'Ubah' : 'Tambah' }}</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">{{ $isUpdate ? 'Ubah' : 'Tambah' }} Pegawai</h4>
        </div>
    </div>
    @include('partials.message')
    <form action="{{ $saveUrl }}" method="POST">
        @csrf
        @if ($isUpdate)
            @method('PUT')
        @endif
        <div class="form-group row row-xs">
            <label for="segment_id" class="col-sm-2 col-form-label">Bagian</label>
            <div class="col-sm-10">
                <select class="form-control @error('segment_id') is-invalid @enderror" id="segment_id" name="segment_id">
                    <option value="">Pilih</option>
                    @foreach ($segments as $segment)
                        <option value="{{ $segment->id }}" {{ $segment->id == Arr::get($input, 'segment_id') ? 'selected' : '' }}>{{ $segment->pronounce }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row row-xs">
            <label for="nip" class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ Arr::get($input, 'nip') }}">
            </div>
        </div>
        <div class="form-group row row-xs">
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ Arr::get($input, 'name') }}">
            </div>
        </div>
        <div class="form-group row row-xs">
            <label for="position" class="col-sm-2 col-form-label">Jabatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ Arr::get($input, 'position') }}">
            </div>
        </div>
        <div class="form-group row row-xs">
            <label for="group_class" class="col-sm-2 col-form-label">Golongan</label>
            <div class="col-sm-2">
                <select class="form-control @error('group_class') is-invalid @enderror" id="group_class" name="group">
                    <option value="">Pilih</option>
                    <option value="I" {{ 'I' == Arr::get($input, 'group') ? 'selected' : '' }}>I</option>
                    <option value="II" {{ 'II' == Arr::get($input, 'group') ? 'selected' : '' }}>II</option>
                    <option value="III" {{ 'III' == Arr::get($input, 'group') ? 'selected' : '' }}>III</option>
                    <option value="IV" {{ 'IV' == Arr::get($input, 'group') ? 'selected' : '' }}>IV</option>
                </select>
            </div>
            <div class="col-sm-2">
                <select class="form-control @error('group_class') is-invalid @enderror" id="group_class" name="class">
                    <option value="">Pilih</option>
                    <option value="a" {{ 'a' == Arr::get($input, 'class') ? 'selected' : '' }}>a</option>
                    <option value="b" {{ 'b' == Arr::get($input, 'class') ? 'selected' : '' }}>b</option>
                    <option value="c" {{ 'c' == Arr::get($input, 'class') ? 'selected' : '' }}>c</option>
                    <option value="d" {{ 'd' == Arr::get($input, 'class') ? 'selected' : '' }}>d</option>
                    <option value="e" {{ 'e' == Arr::get($input, 'class') ? 'selected' : '' }}>e</option>
                </select>
            </div>
        </div>
        @if ($isUpdate)
            <div class="form-group row row-xs">
                <label for="password" class="col-sm-2 col-form-label">Ubah Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" value="{{ Arr::get($input, 'password') }}">
                </div>
            </div>
        @else
            <div class="form-group row row-xs">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ Arr::get($input, 'password') }}">
                </div>
            </div>
        @endif
        <div class="form-group row row-xs">
            <label for="role_id" class="col-sm-2 col-form-label">Peran</label>
            <div class="col-sm-10">
                <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id">
                    <option value="">Pilih</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $role->id == Arr::get($input, 'role_id') ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @if ($isUpdate)
            <div class="form-group row row-xs">
                <label for="is_active" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-control @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                        <option value="1" {{ '1' == Arr::get($input, 'is_active') ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ '0' == Arr::get($input, 'is_active') ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>
        @endif
        <div class="form-group row row-xs">
            <div class="col-sm-12 col-lg-12">
                <div class="text-right">
                    <button type="button" class="btn btn-sm btn-outline-danger mb-2" onclick="window.location='{{ route('settings.employee.index') }}'"><i class="fa fa-trash"></i> Batal</button>
                    <button type="submit" class="btn btn-sm btn-outline-success mb-2" onclick="window.location='{{ route('settings.employee.store') }}'"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </form>
@endsection