@extends('template.layout')

@section('title', 'Press Release Gunung Api')

@push('styles')
    <link href="{{ asset('css/selectric.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <style>
        .d-flex {
            display: flex;
        }

        .justify-content-center {
            justify-content: center;
        }

        .align-items-center {
            align-items: center;
        }

        .my-auto {
            margin-top: auto;
            margin-bottom: auto;
        }
    </style>
@endpush

@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                <h2>Hasil Pencarian</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Hasil Pencarian</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- SAB BANNER END-->
    <div class="city_blog2_wrap team" style="background: #f0f2f7">
        <div class="container">
            <div id="app">
                <h5>Hasil pencarian dari "{{ request()->get('keyword') }}" : </h5>
                @foreach ($pressReleases as $pressRelease)
                    <div class="row mb-3" style="background-color: white; border-radius: 0.2rem;margin-bottom:3rem;">
                        <div class="col-md-4" style="height: 300px;">
                            <div
                                style="height: 100%; cursor: pointer; background: url('{{$pressRelease->thumbnail}}') 0% 0% / cover no-repeat; background-position: center; border-radius: 0.2rem;">
                            </div>
                        </div>
                        <div class="col-md-8 d-flex align-items-center" style="height: 300px;">
                            <div class="d-flex flex-column">
                                <a href="{{ $pressRelease->detail }}" class="news-title"
                                    style="font-size: 24px;margin-bottom: 10px;">
                                    {{ $pressRelease->title }}
                                </a>
                                {{-- <span class="badge">Badge</span> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach ($volcanoBases as $volcanoBase)
                    <div class="row mb-3" style="background-color: white; border-radius: 0.2rem;margin-bottom:3rem;">
                        <div class="col-md-4" style="height: 300px;">
                            <div
                                style="height: 100%; cursor: pointer; background: url('{{asset('storage/'.$volcanoBase->thumbnail)}}') 0% 0% / cover no-repeat;background-position: center; border-radius: 0.2rem;">
                            </div>
                        </div>
                        <div class="col-md-8 d-flex align-items-center" style="height: 300px;">
                            <div class="d-flex flex-column">
                                <a href="{{ $volcanoBase->detail }}" class="news-title"
                                    style="font-size: 24px;margin-bottom: 10px;">
                                    {{ $volcanoBase->title }}
                                </a>
                                {{-- <span class="badge">Badge</span> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
                @if (count($pressReleases) == 0 && count($volcanoBases) == 0)
                    <h4>Tidak ada hasil pencarian</h4>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script src="{{ asset('js/jquery-filterable.js') }}"></script>
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
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script> --}}
@endpush
