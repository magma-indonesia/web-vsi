<div class="content ht-100v pd-0">
    @include('dashboard.template.content-header')

    <div class="content-body">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="#">Tata Usaha</a></li>
                        <li class="breadcrumb-item">Sub Kepegawaian</li>
                        <li class="breadcrumb-item active" aria-current="page">Pegawai - SIPEG</li>
                    </ol>
                </nav>
            </div>
        </div>

        <h4 class="tx-spacing--1">Tabel Data Pegawai - SIPEG</h4>

        <div class="card">
            <div class="card-body">
                <table id="employee-table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th></th>
                        {{--<th class="align-middle">No</th>--}}
                        <th class="align-middle">EID</th>
                        <th class="align-middle">PID</th>
                        <th class="align-middle">Nama</th>
                        <th class="align-middle">NIP</th>
                        <th class="align-middle">Gol</th>
                        <th class="align-middle">Jabatan</th>
                        <th class="align-middle">Kelompok</th>
                        <th class="align-middle">Email</th>
                        <th class="align-middle">JSON</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ASSETS --}}
<link href="{{ asset('dashforge/lib/datatables.net-dt/css/jquery.dataTables.min.css') }}" rel="stylesheet"/>
{{-- ASSETS --}}

{{-- SCRIPTS --}}
<script src="{{ asset('dashforge/lib/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dashboard/employee/sipeg/index.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        const opts = {
            'getDataTableUrl': '{{ route($tableRouteName, null, false) }}',
            'csrfToken': '{{ csrf_token() }}'
        };
        const sipegHandle = SipegHandler.construct(opts);
        sipegHandle.init();
    });
</script>
{{-- SCRIPTS --}}
