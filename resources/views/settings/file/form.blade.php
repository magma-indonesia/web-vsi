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
                    <li class="breadcrumb-item"><a href="{{ route('settings.upload.index') }}">{{ $pageTitle }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $isUpdate ? 'Ubah' : 'Tambah' }}</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">{{ $isUpdate ? 'Ubah' : 'Tambah' }} File</h4>
        </div>
    </div>
    @include('partials.message')
    <form action="{{ $saveUrl }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($isUpdate)
            @method('PUT')
        @endif
        <div class="input-group row row-xs">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="file_upload" name="file_uploads[]" multiple>
                <label class="custom-file-label" for="file_upload">Choose file</label>
            </div>
            <div class="input-group-append">
                <button type="submit" class="btn btn-outline-success">Upload</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        let isSuccess = '{{ Session::has("success") }}';
        $(document).ready(function() {
            $(".custom-file-input").on("change", function() {
                let fileNames = [];
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    fileNames.push($(this)[0].files[i].name);
                }
                
                // var fileName = $(this).val().split("\\").pop();
                var fileName = fileNames.join(' ');
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            if (isSuccess == 1) {
                setTimeout(function () {
                    window.close('','_parent','');
                }, 2000);
            }
        });
    </script>
@endpush