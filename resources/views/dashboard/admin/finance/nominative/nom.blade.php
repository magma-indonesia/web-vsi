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

        <input type="hidden" id="master-nom" name="master-nom" value="{{ $mnId }}">

        <div class="card">
            <div class="card-body">
                <div class="text-center" id="loading-spinner" style="display: none">
                    <div class="spinner-border"></div>
                </div>
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
                                    <input class="form-control col-md-2" id="basic-addon2" value="020.FE." disabled>
                                    <input class="form-control" id="activity-code" value="{{ $activityCode }}" disabled>
                                </div>
                            </div>

                            <hr>

                            {{-- DATE AND DESTINATION --}}
                            <div class="form-group row">
                                <label for="start-date" class="col-sm-2 col-form-label">Uraian Kegiatan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="activity-desc" name="activity-desc"
                                           value="{{ $activityName }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="origin-city" class="col-sm-2 col-form-label">Kota Asal</label>
                                <div class="col-sm-5">
                                    <select type="search" class="form-select" id="origin-city"
                                            name="origin-city" aria-label="Search"></select>
                                </div>
                            </div>
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

                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label"></label>
                                <label class="col-sm-3 col-form-label border-end">Nama/NIP/Gol.</label>
                                <label class="col-sm-2 col-form-label">Uang Harian</label>
                                <label class="col-sm-2 col-form-label">Penginapan</label>
                                <label class="col-sm-2 col-form-label">Transport PP</label>
                            </div>

                            <div class="dynamic-employee-wrapper">
                                <div class="dynamic-employee">
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label">Personil</label>
                                        <div class="col-sm-3">
                                            <select type="select" class="form-control employee-search"
                                                    name="employee-name[]"></select>
                                        </div>
                                        <div class="oh-wrapper col-sm-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="number" class="form-control employee-oh" value=""
                                                       name="oh[]">
                                            </div>
                                        </div>
                                        <div class="lodging-wrapper col-sm-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="number" class="form-control employee-lodging" value=""
                                                       name="lodging[]">
                                            </div>
                                        </div>
                                        <div class="transport-wrapper col-sm-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="number" class="form-control employee-transport" value=""
                                                       name="transport[]">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="javascript:void(0);" class="add_button btn btn-sm btn-primary"
                                               title="Add field"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label"></label>
                                        <div class="input-group col-md-3 d-flex align-items-end">
                                            <input type="text" class="form-control employee-id" value=""
                                                   name="employee-id[]" placeholder="NIP" disabled>
                                            <input type="text" class="form-control employee-group col-md-3" value=""
                                                   name="employee-group[]" placeholder="Gol" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </section>
                    <h3>RAB</h3>
                    <section>
                        <form id="form-rab">
                            {{-- HEADER --}}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Personil</label>
                                <div class="col-sm-7">
                                    <table class="table" id="rab-personnel-table"></table>
                                </div>
                            </div>

                            <hr>

                            <h3>Pembiayaan</h3>

                            <div class="master-budget-plan-wrapper">
                                {{-- TODO ALL WRAPPER ID BELOW MUST BE CHANGED TO A SERVER SIDE VARIABLE TO MATCH WITH MASTER BUDGET PLAN DATA --}}
                                <h4>1. UANG HARIAN</h4>
                                <div class="rab-oh-wrapper" id="1">

                                </div>

                                <hr>

                                <h4>2. UANG PENGINAPAN</h4>
                                <div class="rab-lodging-wrapper" id="2">

                                </div>

                                <hr>

                                <h4>3. TRANSPORTASI</h4>
                                <div class="rab-transport-wrapper" id="3">
                                    <div class="dynamic-rab-transport">
                                        <div class="form-group row">
                                            <input class="form-control col-sm-2" name="desc[]" value=""
                                                   placeholder="Keterangan">
                                            <div class="input-group col-md-7">
                                                <input class="form-control col-md-1" id="first-transport" name="qty1[]"
                                                       value="" placeholder="qty">
                                                <input class="form-control col-md-1" id="" name="unit1[]" value="org x"
                                                       disabled>
                                                <input class="form-control col-md-1" id="" name="qty2[]" value=""
                                                       placeholder="qty">
                                                <input class="form-control col-md-1" id="" name="unit2[]" value="P x"
                                                       disabled>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="number" class="form-control col-md-3" value=""
                                                       name="nominal[]" placeholder="Nominal">
                                                <a href="javascript:void(0);"
                                                   class="add_button_transport btn btn-sm btn-primary ml-3"
                                                   title="Add field"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h4>4. BAHAN-BAHAN</h4>
                                <div class="rab-materials-wrapper" id="4">
                                    <div class="material-prospect">
                                        <div class="form-group row">
                                            <label for="activity-code" class="col-sm-2 col-form-label">Prospeksi
                                                Lapangan</label>
                                            <input type="hidden" name="desc[]" value="Prospeksi Lapangan">
                                            <div class="input-group col-md-7 d-flex align-items-end">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-1"></div>
                                                <input class="form-control col-md-1" id="" name="qty1[]" value=""
                                                       placeholder="qty">
                                                <input class="form-control col-md-1" id="" name="unit1[]" value="lok x"
                                                       disabled>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="number" class="form-control col-md-3" value=""
                                                       name="nominal[]" placeholder="Nominal">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="material-report">
                                        <div class="form-group row">
                                            <label for="activity-code" class="col-sm-2 col-form-label">Penggandaan
                                                Laporan</label>
                                            <input type="hidden" name="desc[]" value="Penggandaan Laporan">
                                            <div class="input-group col-md-7 d-flex align-items-end">
                                                <input class="form-control col-md-1" id="" name="qty1[]" value=""
                                                       placeholder="qty">
                                                <input class="form-control col-md-1" id="" name="unit1[]" value="lap x"
                                                       disabled>
                                                <input class="form-control col-md-1" id="" name="qty2[]" value=""
                                                       placeholder="qty">
                                                <input class="form-control col-md-1" id="" name="unit2[]" value="jld x"
                                                       disabled>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="number" class="form-control col-md-3" value=""
                                                       name="nominal[]" placeholder="Nominal">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h4>5. UPAH TENAGA HARIAN LEPAS</h4>
                                <div class="rab-fees-wrapper" id="5">
                                    <div class="form-group row">
                                        <label for="activity-code" class="col-sm-2 col-form-label"></label>
                                        <input type="hidden" name="desc[]" value="Upah Tenaga Harian Lepas">
                                        <div class="input-group col-md-7 d-flex align-items-end">
                                            <input class="form-control col-md-1" id="" name="qty1[]" value=""
                                                   placeholder="qty">
                                            <input class="form-control col-md-1" id="" name="unit1[]" value="org x"
                                                   disabled>
                                            <input class="form-control col-md-1" id="" name="qty2[]" value=""
                                                   placeholder="qty">
                                            <input class="form-control col-md-1" id="" name="unit2[]" value="hari x"
                                                   disabled>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="number" class="form-control col-md-3" value="" name="nominal[]"
                                                   placeholder="Nominal">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h4>6. SEWA KENDARAAN</h4>
                                <div class="rab-rent-wrapper" id="6">
                                    <div class="form-group row">
                                        <label for="activity-code" class="col-sm-2 col-form-label"></label>
                                        <input type="hidden" name="desc[]" value="Sewa Kendaraan">
                                        <div class="input-group col-md-7 d-flex align-items-end">
                                            <input class="form-control col-md-1" id="" name="qty1[]" value=""
                                                   placeholder="qty">
                                            <input class="form-control col-md-1" id="" name="unit1[]" value="unit x"
                                                   disabled>
                                            <input class="form-control col-md-1" id="" name="qty2[]" value=""
                                                   placeholder="qty">
                                            <input class="form-control col-md-1" id="" name="unit2[]" value="hari x"
                                                   disabled>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="number" class="form-control col-md-3" value="" name="nominal[]"
                                                   placeholder="Nominal">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h4>7. UJI LABORATORIUM TANAH</h4>
                                <div class="rab-lab-wrapper" id="7">
                                    <div class="form-group row">
                                        <label for="activity-code" class="col-sm-2 col-form-label"></label>
                                        <input type="hidden" name="desc[]" value="Uji Laboratorium Tanah">
                                        <div class="input-group col-md-7 d-flex align-items-end">
                                            <input class="form-control col-md-1" id="" name="qty1[]" value=""
                                                   placeholder="qty">
                                            <input class="form-control col-md-1" id="" name="unit1[]" value="smpl x"
                                                   disabled>
                                            <input class="form-control col-md-1" id="" name="qty2[]" value=""
                                                   placeholder="qty">
                                            <input class="form-control col-md-1" id="" name="unit2[]" value="lok x"
                                                   disabled>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="number" class="form-control col-md-3" value="" name="nominal[]"
                                                   placeholder="Nominal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                    <h3>RRB</h3>
                    <section>
                        <form id="form-rrb">
                            <table class="table table-bordered table-hover text-center">
                                <thead>
                                <tr class="align-middle">
                                    <th class="align-middle">NO</th>
                                    <th class="align-middle">URAIAN KEGIATAN</th>
                                    <th>PERJALANAN (524111)</th>
                                    <th>BAHAN-BAHAN (521211)</th>
                                    <th>UPAH (521219)</th>
                                    <th>SEWA (522141)</th>
                                    <th>UJI LAB (522191)</th>
                                    <th>JUMLAH (Rp.)</th>
                                    <th class="align-middle">KETERANGAN</th>
                                </tr>
                                </thead>
                                <tbody id="rrb-table">
                                <tr>
                                    <td>1</td>
                                    <td id="rrb-activity-desc"></td>
                                    <td class="trip-total">10000</td>
                                    <td class="materials-total">10000</td>
                                    <td class="fees-total">10000</td>
                                    <td class="rent-total">10000</td>
                                    <td class="labs-total">10000</td>
                                    <td class="rrb-total">10000</td>
                                    <td id="rrb-team-lead">Ketua Tim Anjar Heriwaseso</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Jumlah</th>
                                    <th id="trip-total">10000</th>
                                    <th id="materials-total">10000</th>
                                    <th id="fees-total">10000</th>
                                    <th id="rent-total">10000</th>
                                    <th id="labs-total">10000</th>
                                    <th id="rrb-total">10000</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </form>
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
            'searchEmployeeUrl': '{{ route($searchEmployeeRouteName) }}',
            'saveNominativeUrl': '{{ route($saveNominativeRouteName) }}',
            'saveBpUrl': '{{ route($saveBudgetPlanRouteName) }}',
            'saveCpdUrl': '{{ route($saveCostPlanDetailRouteName) }}',
            'getMbpUrl': '{{ route($masterBudgetPlanRouteName) }}',
            'csrfToken': '{{ csrf_token() }}'
        };
        var nominativeHandle = NominativeHandler.construct(opts);
        nominativeHandle.init();

        // cannot init datepicker in handler, no fucking clue, code must be placed at the deepest part of hell to work, what the fuck
        $.datepicker.setDefaults(
            $.extend(
                $.datepicker.regional['id'],
                // order fucking matters, put below lines before regional setter and everything will blow into pieces
                {'dateFormat': 'yy-mm-dd'}
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
                        dateFormat: 'yy-mm-dd'
                    }
                );
            }
        });
    });
</script>
{{-- SCRIPTS --}}
