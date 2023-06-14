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

        .img-card {
            height: 100%;
            cursor: pointer;
            background-position: center;
            border-radius: 0.2rem;
        }

        .h-300 {
            height: 300px;
        }

        .news-font {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .card {
            background-color: white;
            border-radius: 0.2rem;
            margin-bottom: 3rem;
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
                    <div class="row mb-3 card">
                        <div class="col-md-4 h-300">
                            <div class="img-card"
                                style="background: url('{{ $pressRelease->thumbnail }}') 0% 0% / cover no-repeat;">
                            </div>
                        </div>
                        <div class="col-md-8 d-flex align-items-center h-300">
                            <div class="d-flex flex-column">
                                <a href="{{ $pressRelease->detail }}" class="news-title news-font">
                                    {{ $pressRelease->title }}
                                </a>
                                {{-- <span class="badge">Badge</span> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach ($volcanoBases as $volcanoBase)
                    <div class="row mb-3 card">
                        <div class="col-md-4 h-300">
                            <div class="img-card"
                                style="background: url('{{ asset('storage/' . $volcanoBase->thumbnail) }}') 0% 0% / cover no-repeat;">
                            </div>
                        </div>
                        <div class="col-md-8 d-flex align-items-center h-300">
                            <div class="d-flex flex-column">
                                <a href="{{ $volcanoBase->detail }}" class="news-title news-font">
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
