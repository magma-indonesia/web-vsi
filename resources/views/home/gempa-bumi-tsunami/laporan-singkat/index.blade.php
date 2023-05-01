@extends('template.layout', ['tingkatAktivitas' => $tingkatAktivitas])

@section('title', 'Laporan Singkat Gempa Bumi & Tsunami')

@push('styles')
<link href="{{ asset('css/selectric.css') }}" rel="stylesheet">
<link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<!-- SAB BANNER START-->
<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <h2>Laporan Singkat Gempa Bumi & Tsunami</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Gempa Bumi & Tsunami</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('gempa-bumi-tsunami.laporan-singkat') }}">Laporan Singkat Gempa Bumi & Tsunami</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- SAB BANNER END-->
<div class="city_blog2_wrap team" style="background: #fff">
    <div class="container">
        <div id="app">
            <news apiurl="{{ env('APP_URL') }}" category="8"></news>
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
