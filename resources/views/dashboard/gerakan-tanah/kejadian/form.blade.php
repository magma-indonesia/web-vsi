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
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.gerakan-tanah.kejadian.index') }}">{{ $pageTitle }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $isUpdate ? 'Ubah' : 'Tambah' }}</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">{{ $isUpdate ? 'Ubah' : 'Tambah' }} {{ $pageTitle }}</h4>
        </div>
    </div>
    @include('partials.message')
    <form action="{{ $saveUrl }}" method="POST">
        @csrf
        @if ($isUpdate)
            @method('PUT')
        @endif
        <div class="form-group row row-xs">
            <label for="title" class="col-sm-2 col-form-label">Judul Artikel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ Arr::get($input, 'title') }}">
            </div>
        </div>
        <div class="form-group row row-xs">
            <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ Arr::get($input, 'description') }}</textarea>
            </div>
        </div>
        <div class="form-group row row-xs">
            <div class="col-sm-12 col-lg-12">
                <div class="text-right">
                    <button type="button" class="btn btn-sm btn-outline-danger mb-2" onclick="window.location='{{ route('dashboard.gerakan-tanah.kejadian.index') }}'"><i class="fa fa-trash"></i> Batal</button>
                    <button type="submit" class="btn btn-sm btn-outline-success mb-2"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/a12nujrz7c55qi1otfth9e77qsjmct0ovo3gfoe39gpq8lui/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        var editor_config = {
            path_absolute: "/",
            selector: "#description",
            height: 500,
            image_class_list: [
                {
                    title: 'img-responsive',
                    value: 'img-responsive'
                },
            ],
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste imagetools"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",
            relative_urls: false,
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '{{ route("image.upload") }}')
                var token = '{{ csrf_token() }}';
                xhr.setRequestHeader ("X-CSRF-Token", token);
                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    if (xhr.responseText != '') {
                        json = JSON.parse(xhr.responseText);
                        if (!json || typeof json.location != 'string') {
                            failure('Invalid JSON: ' + xhr.responseText);
                            return;
                        }
                        success(json.location);
                    } else {
                        failure('Failed upload');
                        return;
                    }
                };
                formData = new FormData();
                formData.append('upload', blobInfo.blob(), blobInfo.filename ());
                xhr.send(formData);
            }
        };      

        $(document).ready(function() {
            tinymce.init(editor_config);
        });
    </script>
@endpush