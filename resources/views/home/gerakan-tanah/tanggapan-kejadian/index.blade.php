@extends('template.layout')

@section('title', 'Tanggapan Kejadian Gerakan Tanah')

@push('styles')
<link href="{{ asset('css/selectric.css') }}" rel="stylesheet">
<link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<!-- SAB BANNER START-->
<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <h2>Tanggapan Kejadian Gerakan Tanah</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Gerakan Tanah</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('gerakan-tanah.tanggapan-kejadian.index') }}">Tanggapan Kejadian Gerakan Tanah</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- SAB BANNER END-->
<div class="city_blog2_wrap team" style="background: #f0f2f7">
    <div class="container">
        <div id="app">
            <news 
                apiurl="{{ route('gerakan-tanah.tanggapan-kejadian.get') }}" 
                detailurl="{{ route('gerakan-tanah.tanggapan-kejadian.detail', '') }}" 
            ></news>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/jquery-filterable.js') }}"></script>
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/web/collab/index.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var collabHandle = CollabHandler.construct({
            maxPicField: 2,
            maxInvolvedField: 5
        });
        collabHandle.init();
    });

</script>
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
@endpush
