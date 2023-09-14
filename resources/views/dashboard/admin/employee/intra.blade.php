<div class="content ht-100v pd-0">
    @include('dashboard.template.content-header')

    <div class="content-body">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="#">Tata Usaha</a></li>
                        <li class="breadcrumb-item">Sub Keuangan</li>
                        <li class="breadcrumb-item active" aria-current="page">Tracking SPPD</li>
                    </ol>
                </nav>
            </div>
        </div>

        <h4 class="tx-spacing--1">Tabel Data SPPD</h4>

        <a class="btn btn-info mb-2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
           aria-controls="collapseExample">Keterangan</a>

        <div class="collapse mg-t-5" id="collapseExample">
            <div class="alert alert-success" role="alert">
                LS01: Menunggu Verifikasi<br>
                LS02: Telah Diverifikasi<br>
                LS03: Telah Diajukan<br>
                LS04: Dana Telah Cair<br>
                UP01: Berkas Lengkap<br>
                UP03: Diajukan ke Bendahara<br>
                UP05: Dana Telah Cair<br>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table id="spd-table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th rowspan="2" class="align-middle">No</th>
                        <th rowspan="2" class="align-middle">ID Nominative</th>
                        <th rowspan="2" class="align-middle text-center">No SPD</th>
                        <th rowspan="2" class="align-middle">Diajukan Oleh</th>
                        <th colspan="4" class="text-center">STATUS (LS)</th>
                        <th colspan="3" class="text-center">STATUS (UP)</th>
                        <th rowspan="2" class="align-middle">Keterangan</th>
                    </tr>
                    <tr>
                        <th>LS01</th>
                        <th>LS02</th>
                        <th>LS03</th>
                        <th>LS04</th>
                        <th>UP01</th>
                        <th>UP03</th>
                        <th>UP05</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- ASSETS --}}
<link href="{{ asset('dashforge/lib/datatables.net-dt/css/jquery.dataTables.min.css') }}" rel="stylesheet"/>
{{--<link href="{{ asset('dashforge/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}" rel="stylesheet"/>--}}
{{-- ASSETS --}}

{{-- SCRIPTS --}}
<script src="{{ asset('dashforge/lib/datatables.net/js/jquery.dataTables.min.js') }}"></script>
{{--<script src="{{ asset('dashforge/lib/datatables.net-dt/js/datatables.dataTables.min.js') }}"></script>--}}
{{--<script src="{{ asset('dashforge/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js') }}"></script>--}}
<script src="{{ asset('js/dashboard/finance/spd/index.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        const opts = {
            'signal': 'fire',
            'getDataTableUrl': '{{ route($getDataTableRouteName, null, false) }}',
            'viewNominativeUrl': '{{ route($viewNominativeRouteName, ['id' => '#TMP#']) }}',
            'csrfToken': '{{ csrf_token() }}'
        };
        const trackSpdHandle = SpdHandler.construct(opts);
        trackSpdHandle.init();
    });
</script>
{{-- SCRIPTS --}}
