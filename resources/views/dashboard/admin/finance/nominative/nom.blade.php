<div class="content ht-100v pd-0">

    @include('dashboard.template.content-header')

    <div class="content-body">

        {{-- if ever need a compact container use element below --}}
        {{--<div class="container pd-x-0">
            <div class="row d-flex flex-row">
                <div class="col-lg-12">
                </div>
            </div>
        </div>--}}

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

        <div class="card">
            <div class="card-body">
                <div id="wizard4" class="wizard-tab">
                    <h3>Nominatif</h3>
                    <section>
                        <form id="form-nominative">
                            {{-- HEADER --}}
                            <div class="form-group row">
                                <label for="satker-no" class="col-sm-2 col-form-label">1. Nomor Satuan Kerja</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="satker-no"
                                           value="PUSAT VULKANOLOGI DAN MITIGASI BENCANA GEOLOGI" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="satker-code" class="col-sm-2 col-form-label">2. Kode Satuan Kerja</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="satker-code" value="579170" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date-dipa-no" class="col-sm-2 col-form-label">3. Tanggal/No. DIPA</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="date-dipa-no"
                                           value="17 NOVEMBER 2021/No. 020.13.1.579170/2022" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="activity-code" class="col-sm-2 col-form-label">4. Kegiatan dan Sub
                                    Kegiatan</label>
                                <div class="input-group col-md-5 d-flex align-items-end">
                                    <div class="form-group-prepend">
                                        <span class="input-group-text" id="basic-addon2">020.FE.</span>
                                    </div>
                                    <input class="form-control" id="activity-code" value="{{ $activityCode }}" disabled>
                                </div>
                            </div>

                            <hr>

                            {{-- DATE AND DESTINATION --}}
                            <div class="form-group row">
                                <label for="destination-city" class="col-sm-2 col-form-label">Kota Tujuan</label>
                                <div class="col-sm-5">
                                    <select type="search" class="form-select" id="destination-city"
                                            name="destination-city" aria-label="Search"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="start-date" class="col-sm-2 col-form-label">Tanggal Berangkat</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="start-date" name="start-date"
                                           placeholder="Tanggal Berangkat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="end-date" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="end-date" name="end-date" disabled
                                           placeholder="Tanggal Kembali">
                                </div>
                            </div>

                            <hr>

                            <div class="dynamic-employee">
                                <div class="form-group row">
                                    <label for="" class="col-sm-1 col-form-label">Personil</label>
                                    <div class="col-sm-3">
                                        <select type="select" class="form-control employee-search"
                                                name="employee-name[]"></select>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control employee-id" value=""
                                               name="employee-id[]" disabled>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" class="form-control employee-group" value=""
                                               name="employee-group[]" disabled>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="javascript:void(0);" class="add_button btn btn-sm btn-primary"
                                           title="Add field"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                    <h3>RAB</h3>
                    <section>
                        <p class="mg-b-0">Wonderful transition effects.</p>
                        <div class="form-group">
                            <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                            <input id="email" class="form-control" name="email" placeholder="Enter email address"
                                   type="email" required>
                        </div><!-- form-group -->
                    </section>
                    <h3>RRB</h3>
                    <section>
                        <p class="mg-b-0">The next and previous buttons help you to navigate through your content.</p>
                    </section>
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
<script src="{{ asset('dashforge/lib/jqueryui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('dashforge/lib/jqueryui/datepicker-id.js') }}"></script>
<script src="{{ asset('dashforge/lib/prismjs/prism.js') }}"></script>
<script src="{{ asset('dashforge/lib/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('dashforge/lib/jquery-steps/build/jquery.steps.min.js') }}"></script>
<script src="{{ asset('dashforge/lib/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/dashboard/finance/nominative/nom.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // initialize server side variable here
        const opts = {
            'signal': 'fire',
            'searchCityUrl': '{{ route($searchCityRouteName) }}',
            'searchEmployeeUrl': '{{ route($searchEmployeeRouteName) }}'
        };
        var nominativeHandle = NominativeHandler.construct(opts);
        nominativeHandle.init();

        // cannot init datepicker in handler, no fucking clue, code must be placed at the deepest part of hell to work, what the fuck
        $.datepicker.setDefaults(
            $.extend(
                $.datepicker.regional['id'],
                // order fucking matters, put below lines before regional setter and everything will blow into pieces
                {'dateFormat': 'dd M yy'}
            )
        );

        $('#start-date').datepicker({
            minDate: 1,
            onSelect: function (dateStr) {
                var d = $(this).datepicker('getDate');
                d.setDate(d.getDate() + 1);
                $('#end-date')
                    .val('')
                    .attr('disabled', false);
                $("#end-date").datepicker("destroy");
                $("#end-date").datepicker(
                    {
                        minDate: new Date(d),
                        dateFormat: 'dd M yy'
                    }
                );
            }
        });
    });
</script>
{{-- SCRIPTS --}}
