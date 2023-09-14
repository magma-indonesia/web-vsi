<div class="content ht-100v pd-0">
    @include('dashboard.template.content-header')

    <div class="content-body">
        <div class="container pd-x-0">
            <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                            <li class="breadcrumb-item"><a href="#">Tata Usaha</a></li>
                            <li class="breadcrumb-item">Sub Keuangan</li>
                            <li class="breadcrumb-item active" aria-current="page">Nominatif</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <h4 class="tx-spacing--1">Untuk Membuat Nominatif, Silahkan masukkan <u><strong>NO SPD</strong></u> pada
                kolom dibawah</h4>
            <h5 class="mg-b-50 tx-spacing--1">(Gunakan <u><strong>NO SPD</strong></u> Ketua Tim)</h5>

            <div class="row row-xs">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-11">
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <input class="form-control" name="id-sppd" id="id-sppd" value=""
                                                   placeholder="NO SPD" maxlength="3" required>
                                        </div>
                                        <div class="form-group col-md-3 d-flex align-items-end">
                                            <input class="form-control" name="placeholder-spd" value="/SPD/PPK/"
                                                   disabled>
                                        </div>
                                        <div class="form-group col-md-5 d-flex align-items-end">
                                            <select class="form-control" type="search" name="code-mak"
                                                    id="code-mak"></select>
                                        </div>
                                        <div class="form-group col-md-2 d-flex align-items-end">
                                            <input class="form-control" name="budget-year" id="budget-year" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <label for="button"></label>
                                    <button type="button" class="btn btn-primary btn-icon" id="initiate-nominative">
                                        <i data-feather="arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ASSETS --}}
<link href="{{ asset('dashforge/lib/select2/css/select2.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('dashforge/lib/select2/css/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet"/>
{{-- ASSETS --}}

{{-- SCRIPTS --}}
<script src="{{ asset('dashforge/lib/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/dashboard/finance/nominative/mn.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        const opts = {
            'signal': 'fire',
            'next': '{{ route($nominativeRouteName, ['id' => '#TMP#'], false) }}',
            'searchActivityUrl': '{{ $searchActivityRouteName }}',
            'saveMasterNominativeUrl': '{{ route($saveMasterNominativeRouteName, null, false) }}',
            'csrfToken': '{{ csrf_token() }}'
        };
        const masterNominativeHandle = MasterNominativeHandler.construct(opts);
        masterNominativeHandle.init();
    });
</script>
{{-- SCRIPTS --}}
