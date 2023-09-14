'use strict';

var NominativeHandler = {
    construct: function (options) {
        var citySelect;
        var employeeSelect;
        var teamLead;
        var handler = {
            _initialize: function () {
                var self = this;
                console.log(options);
            },
            _clickListener: function () {
                var self = this;

                self._citySearch('origin-city');
                self._citySearch('destination-city');

                var maxField = 10;
                var dynamicPersonnelWrapper = $('.dynamic-employee');
                var x = 1;

                dynamicPersonnelWrapper.on('click', '.add_button', function (e) {
                    if (x < maxField) {
                        var firstOh = $(this)
                            .parent().parent()
                            .find('.oh-wrapper').find('.employee-oh')
                            .val();
                        var firstLodging = $(this)
                            .parent().parent()
                            .find('.lodging-wrapper').find('.employee-lodging')
                            .val();
                        var firstTransport = $(this)
                            .parent().parent()
                            .find('.transport-wrapper').find('.employee-transport')
                            .val();
                        x++;
                        $(this).closest('.dynamic-employee')
                            .append(self._dynamicPersonnelFieldTemplate(firstOh, firstLodging, firstTransport));
                        self._employeeSearch();
                    }
                });

                dynamicPersonnelWrapper.on('click', '.remove_button', function (e) {
                    e.preventDefault();
                    $(this).closest('.dynamic-employee').remove();
                    x--;
                });
            },
            _stepper: function () {
                var self = this;

                var is_async_step = false;

                $('#wizard4').steps({
                    headerTag: 'h3',
                    bodyTag: 'section',
                    autoFocus: true,
                    titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                    transitionEffect: 2,
                    // stepsOrientation: 1,
                    onStepChanged: function () {
                        $('#loading-spinner').hide();
                    },
                    onStepChanging: function (event, currentIndex, newIndex) {

                        if (is_async_step) {
                            is_async_step = false;
                            //ALLOW NEXT STEP
                            return true;
                        }

                        if (currentIndex < newIndex) {
                            // Step 1 form validation
                            if (currentIndex === 0) {

                                var dest = $('#destination-city').parsley();
                                var sdate = $('#start-date').parsley();
                                var edate = $('#end-date').parsley();

                                var personnelArray = [];
                                var personnelLength = [];
                                $.map($("select[name='employee-name[]']"), function (obj, index) {
                                    personnelLength.push($(obj).val());
                                });

                                var ohLength = [];
                                $.map($("input[name='oh[]']"), function (obj, index) {
                                    ohLength.push($(obj).val());
                                });

                                var lodgingLength = [];
                                $.map($("input[name='lodging[]']"), function (obj, index) {
                                    lodgingLength.push($(obj).val());
                                });

                                var transportLength = [];
                                $.map($("input[name='transport[]']"), function (obj, index) {
                                    transportLength.push($(obj).val());
                                });

                                $.each(personnelLength, function (k, v) {
                                    var personnel = {
                                        id: v,
                                        oh: ohLength[k],
                                        lodging: lodgingLength[k],
                                        transport: transportLength[k],
                                    };
                                    personnelArray.push(personnel);
                                });

                                var request = {
                                    '_token': options.csrfToken,
                                    'data': {
                                        'id_mn': $('#master-nom').val(),
                                        'personnel': personnelArray,
                                        'origin': $('#origin-city').val(),
                                        'destination': $('#destination-city').val(),
                                        'start_date': $('#start-date').val(),
                                        'end_date': $('#end-date').val()
                                    }
                                };

                                if (dest.isValid() && sdate.isValid() && edate.isValid()) {
                                    $('#loading-spinner').show();
                                    $.post(options.saveNominativeUrl, request)
                                        .done(function (data) {
                                            console.log(data);
                                            is_async_step = true;
                                            // self._constructRabLayout();
                                            self._populateRabStep();
                                            //This will move to next step.
                                            $("#wizard4").steps("next");
                                        })
                                        .fail(function (xhr, statusText, errorThrown) {
                                            alert('Terjadi Kesalahan!');
                                            return false;
                                            // window.location.reload();
                                        });

                                    // self._populateRabStep();
                                    // return true;
                                } else {
                                    dest.validate();
                                    sdate.validate();
                                    edate.validate();
                                }
                            }

                            // Step 2 form validation
                            if (currentIndex === 1) {

                                $('#loading-spinner').show();
                                var idMn = $('#master-nom').val();

                                var budgetPlanObject = {
                                    '_token': options.csrfToken,
                                    'bp': [],
                                    'idMn': idMn
                                };

                                // todo fix all idMbp usage below to refer to database value instead of hardcoded

                                var tripTotal = 0;
                                // oh
                                var ohQty1Array = $('.rab-oh-wrapper').find('input[name="qty1[]"]');
                                var ohUnit1Array = $('.rab-oh-wrapper').find('input[name="unit1[]"]');
                                var ohQty2Array = $('.rab-oh-wrapper').find('input[name="qty2[]"]');
                                var ohUnit2Array = $('.rab-oh-wrapper').find('input[name="unit2[]"]');
                                var ohNominalArray = $('.rab-oh-wrapper').find('input[name="nominal[]"]');
                                var ohDescArray = $('.rab-oh-wrapper').find('input[name="desc[]"]');
                                var o = [];
                                $.each(ohQty1Array, function (k, v) {
                                    tripTotal = tripTotal + ($(v).val() * $(ohQty2Array[k]).val() * $(ohNominalArray[k]).val())
                                    o.push({
                                        'idMbp': 1,
                                        'desc': $(ohDescArray[k]).val(),
                                        'qty1': $(v).val(),
                                        'unit1': $(ohUnit1Array[k]).val(),
                                        'qty2': $(ohQty2Array[k]).val(),
                                        'unit2': $(ohUnit2Array[k]).val(),
                                        'nominal': $(ohNominalArray[k]).val()
                                    })
                                });

                                budgetPlanObject.bp.push(o);

                                // lodging
                                var lodgingQty1Array = $('.rab-lodging-wrapper').find('input[name="qty1[]"]');
                                var lodgingUnit1Array = $('.rab-lodging-wrapper').find('input[name="unit1[]"]');
                                var lodgingQty2Array = $('.rab-lodging-wrapper').find('input[name="qty2[]"]');
                                var lodgingUnit2Array = $('.rab-lodging-wrapper').find('input[name="unit2[]"]');
                                var lodgingNominalArray = $('.rab-lodging-wrapper').find('input[name="nominal[]"]');
                                var lodgingDescArray = $('.rab-lodging-wrapper').find('input[name="desc[]"]');
                                o = [];
                                $.each(lodgingQty1Array, function (k, v) {
                                    tripTotal = tripTotal + ($(v).val() * $(lodgingQty2Array[k]).val() * $(lodgingNominalArray[k]).val())
                                    o.push({
                                        'idMbp': 2,
                                        'desc': $(lodgingDescArray[k]).val(),
                                        'qty1': $(v).val(),
                                        'unit1': $(lodgingUnit1Array[k]).val(),
                                        'qty2': $(lodgingQty2Array[k]).val(),
                                        'unit2': $(lodgingUnit2Array[k]).val(),
                                        'nominal': $(lodgingNominalArray[k]).val()
                                    })
                                });

                                budgetPlanObject.bp.push(o);

                                // transport
                                var transportQty1Array = $('.rab-transport-wrapper').find('input[name="qty1[]"]');
                                var transportUnit1Array = $('.rab-transport-wrapper').find('input[name="unit1[]"]');
                                var transportQty2Array = $('.rab-transport-wrapper').find('input[name="qty2[]"]');
                                var transportUnit2Array = $('.rab-transport-wrapper').find('input[name="unit2[]"]');
                                var transportNominalArray = $('.rab-transport-wrapper').find('input[name="nominal[]"]');
                                var transportDescArray = $('.rab-transport-wrapper').find('input[name="desc[]"]');
                                o = [];
                                $.each(transportQty1Array, function (k, v) {
                                    tripTotal = tripTotal + ($(v).val() * $(transportQty2Array[k]).val() * $(transportNominalArray[k]).val())
                                    o.push({
                                        'idMbp': 3,
                                        'desc': $(transportDescArray[k]).val(),
                                        'qty1': $(v).val(),
                                        'unit1': $(transportUnit1Array[k]).val(),
                                        'qty2': $(transportQty2Array[k]).val(),
                                        'unit2': $(transportUnit2Array[k]).val(),
                                        'nominal': $(transportNominalArray[k]).val()
                                    })
                                });

                                budgetPlanObject.bp.push(o);

                                $('.trip-total').text(tripTotal);
                                $('#trip-total').text(tripTotal);

                                // material-prospect
                                var materialsTotal = 0;
                                var prospectQty1Array = $('.material-prospect').find('input[name="qty1[]"]');
                                var prospectUnit1Array = $('.material-prospect').find('input[name="unit1[]"]');
                                var prospectNominalArray = $('.material-prospect').find('input[name="nominal[]"]');
                                var prospectDescArray = $('.material-prospect').find('input[name="desc[]"]');
                                o = [];
                                $.each(prospectQty1Array, function (k, v) {
                                    materialsTotal = materialsTotal + ($(v).val() * $(prospectNominalArray[k]).val())
                                    o.push({
                                        'idMbp': 4,
                                        'desc': $(prospectDescArray[k]).val(),
                                        'qty1': $(v).val(),
                                        'unit1': $(prospectUnit1Array[k]).val(),
                                        'nominal': $(prospectNominalArray[k]).val()
                                    })
                                });

                                budgetPlanObject.bp.push(o);

                                // material-report
                                var reportQty1Array = $('.material-report').find('input[name="qty1[]"]');
                                var reportUnit1Array = $('.material-report').find('input[name="unit1[]"]');
                                var reportQty2Array = $('.material-report').find('input[name="qty2[]"]');
                                var reportUnit2Array = $('.material-report').find('input[name="unit2[]"]');
                                var reportNominalArray = $('.material-report').find('input[name="nominal[]"]');
                                var reportDescArray = $('.material-report').find('input[name="desc[]"]');
                                o = [];
                                $.each(reportQty1Array, function (k, v) {
                                    materialsTotal = materialsTotal + ($(v).val() * $(reportQty2Array[k]).val() * $(reportNominalArray[k]).val())
                                    o.push({
                                        'idMbp': 4,
                                        'desc': $(reportDescArray[k]).val(),
                                        'qty1': $(v).val(),
                                        'unit1': $(reportUnit1Array[k]).val(),
                                        'qty2': $(reportQty2Array[k]).val(),
                                        'unit2': $(reportUnit2Array[k]).val(),
                                        'nominal': $(reportNominalArray[k]).val()
                                    })
                                });

                                budgetPlanObject.bp.push(o);

                                $('.materials-total').text(materialsTotal);
                                $('#materials-total').text(materialsTotal);

                                // fee
                                var feesTotal = 0;
                                var feeQty1Array = $('.rab-fees-wrapper').find('input[name="qty1[]"]');
                                var feeUnit1Array = $('.rab-fees-wrapper').find('input[name="unit1[]"]');
                                var feeQty2Array = $('.rab-fees-wrapper').find('input[name="qty2[]"]');
                                var feeUnit2Array = $('.rab-fees-wrapper').find('input[name="unit2[]"]');
                                var feeNominalArray = $('.rab-fees-wrapper').find('input[name="nominal[]"]');
                                var feeDescArray = $('.rab-fees-wrapper').find('input[name="desc[]"]');
                                o = [];
                                $.each(feeQty1Array, function (k, v) {
                                    feesTotal = feesTotal + ($(v).val() * $(feeQty2Array[k]).val() * $(feeNominalArray[k]).val())
                                    o.push({
                                        'idMbp': 5,
                                        'desc': $(feeDescArray[k]).val(),
                                        'qty1': $(v).val(),
                                        'unit1': $(feeUnit1Array[k]).val(),
                                        'qty2': $(feeQty2Array[k]).val(),
                                        'unit2': $(feeUnit2Array[k]).val(),
                                        'nominal': $(feeNominalArray[k]).val()
                                    })
                                });

                                budgetPlanObject.bp.push(o);

                                $('.fees-total').text(feesTotal);
                                $('#fees-total').text(feesTotal);

                                // rent
                                var rentTotal = 0;
                                var rentQty1Array = $('.rab-rent-wrapper').find('input[name="qty1[]"]');
                                var rentUnit1Array = $('.rab-rent-wrapper').find('input[name="unit1[]"]');
                                var rentQty2Array = $('.rab-rent-wrapper').find('input[name="qty2[]"]');
                                var rentUnit2Array = $('.rab-rent-wrapper').find('input[name="unit2[]"]');
                                var rentNominalArray = $('.rab-rent-wrapper').find('input[name="nominal[]"]');
                                var rentDescArray = $('.rab-rent-wrapper').find('input[name="desc[]"]');
                                o = [];
                                $.each(rentQty1Array, function (k, v) {
                                    rentTotal = rentTotal + ($(v).val() * $(rentQty2Array[k]).val() * $(rentNominalArray[k]).val())
                                    o.push({
                                        'idMbp': 6,
                                        'desc': $(rentDescArray[k]).val(),
                                        'qty1': $(v).val(),
                                        'unit1': $(rentUnit1Array[k]).val(),
                                        'qty2': $(rentQty2Array[k]).val(),
                                        'unit2': $(rentUnit2Array[k]).val(),
                                        'nominal': $(rentNominalArray[k]).val()
                                    })
                                });

                                budgetPlanObject.bp.push(o);

                                $('.rent-total').text(rentTotal);
                                $('#rent-total').text(rentTotal);

                                // lab
                                var labTotal = 0;
                                var labQty1Array = $('.rab-lab-wrapper').find('input[name="qty1[]"]');
                                var labUnit1Array = $('.rab-lab-wrapper').find('input[name="unit1[]"]');
                                var labQty2Array = $('.rab-lab-wrapper').find('input[name="qty2[]"]');
                                var labUnit2Array = $('.rab-lab-wrapper').find('input[name="unit2[]"]');
                                var labNominalArray = $('.rab-lab-wrapper').find('input[name="nominal[]"]');
                                var labDescArray = $('.rab-lab-wrapper').find('input[name="desc[]"]');
                                o = [];
                                $.each(labQty1Array, function (k, v) {
                                    labTotal = labTotal + ($(v).val() * $(labQty2Array[k]).val() * $(labNominalArray[k]).val())
                                    o.push({
                                        'idMbp': 7,
                                        'desc': $(labDescArray[k]).val(),
                                        'qty1': $(v).val(),
                                        'unit1': $(labUnit1Array[k]).val(),
                                        'qty2': $(labQty2Array[k]).val(),
                                        'unit2': $(labUnit2Array[k]).val(),
                                        'nominal': $(labNominalArray[k]).val()
                                    })
                                });

                                budgetPlanObject.bp.push(o);

                                $('.labs-total').text(labTotal);
                                $('#labs-total').text(labTotal);

                                // total
                                $('#rrb-activity-desc').text($('#activity-desc').val());
                                var total = tripTotal + materialsTotal + feesTotal + rentTotal + labTotal;
                                $('.rrb-total').text(total);
                                $('#rrb-total').text(total);
                                $('#rrb-team-lead').html('Ketua Tim<br> ' + teamLead);

                                console.log(budgetPlanObject);

                                $.post(options.saveBpUrl, budgetPlanObject)
                                    .done(function (data) {
                                        console.log(data);
                                        is_async_step = true;
                                        //This will move to next step.
                                        $("#wizard4").steps("next");
                                    })
                                    .fail(function (xhr, statusText, errorThrown) {
                                        alert('Terjadi Kesalahan!');
                                        return false;
                                        // window.location.reload();
                                    });
                                return false;
                                // return true;
                            }
                            // Always allow step back to the previous step even if the current step is not valid.
                        } else {
                            return true;
                        }
                    },
                    onFinished: function (event, currentIndex) {
                        var request = {
                            '_token': options.csrfToken,
                            'idMn': $('#master-nom').val(),
                            'activityDesc': $('#rrb-activity-desc').text(),
                            'travelTotal': $('#trip-total').text(),
                            'materialTotal': $('#materials-total').text(),
                            'wagesTotal': $('#fees-total').text(),
                            'rentTotal': $('#rent-total').text(),
                            'labsTotal': $('#labs-total').text(),
                            'desc': $('#rrb-team-lead').text()
                        }

                        $.post(options.saveCpdUrl, request)
                            .done(function (data) {
                                console.log(data);
                                is_async_step = true;

                                alert('Data berhasil disimpan!');
                                // todo move this hardcoded path to a variable
                                window.location = '/dashboard/admin/finance/track-spd'
                            })
                            .fail(function (xhr, statusText, errorThrown) {
                                alert('Terjadi Kesalahan!');
                                return false;
                            });
                    }
                });
            },
            _citySearch: function (id) {
                var self = this;

                citySelect = $('#' + id);
                citySelect.select2({
                    width: '100%',
                    allowClear: true,
                    theme: 'bootstrap-5',
                    placeholder: 'Cari Kota/Kabupaten...',
                    minimumInputLength: 3,
                    ajax: {
                        url: options.searchCityUrl,
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {search: params.term};
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });

                // autofocus on input upon search box open
                citySelect.on('select2:open', function (e) {
                    // need a native `document` selector for this to work, using jquery `$` won't work
                    $('.select2-search__field').focus();
                });

                // prevent enter key behaviour in typehead
                citySelect.keydown(function (event) {
                    if (event.keyCode === 13) {
                        event.preventDefault();
                        return false;
                    }
                });
            },
            _employeeSearch: function () {
                var self = this;

                employeeSelect = $('.employee-search');
                employeeSelect.select2({
                    width: '100%',
                    allowClear: true,
                    theme: 'bootstrap-5',
                    placeholder: 'Cari Nama Pegawai...',
                    minimumInputLength: 3,
                    ajax: {
                        url: options.searchEmployeeUrl,
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {search: params.term};
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id,
                                        nip: item.nip,
                                        group: item.group,
                                        class: item.class
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });

                // prevent enter key behaviour in typehead
                employeeSelect.keydown(function (event) {
                    if (event.keyCode === 13) {
                        event.preventDefault();
                        return false;
                    }
                });

                employeeSelect.on('select2:selecting', function (e) {
                    var data = e.params.args.data;
                    var parentDiv = $(this).parent().parent().next().children()[1];
                    $($(parentDiv).children()[0]).val(data.nip);
                    $($(parentDiv).children()[1]).val(data.group + '/' + data.class);
                });
            },
            _dynamicPersonnelFieldTemplate: function (oh, lodging, transport) {
                return '<div class="dynamic-employee">\n' +
                    '   <div class="form-group row">\n' +
                    '       <label class="col-sm-1 col-form-label"></label>\n' +
                    '       <div class="col-sm-3">\n' +
                    '           <select type="select" class="form-control employee-search" name="employee-name[]"></select>\n' +
                    '       </div>\n' +
                    '   <div class="oh-wrapper col-sm-2">\n' +
                    '       <div class="input-group">\n' +
                    '           <div class="input-group-prepend">\n' +
                    '               <span class="input-group-text">Rp.</span>\n' +
                    '           </div>\n' +
                    '           <input type="number" class="form-control employee-id" value="' + oh + '" name="oh[]">\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '   <div class="lodging-wrapper col-sm-2">\n' +
                    '       <div class="input-group">\n' +
                    '           <div class="input-group-prepend">\n' +
                    '               <span class="input-group-text">Rp.</span>\n' +
                    '           </div>\n' +
                    '           <input type="number" class="form-control employee-group" value="' + lodging + '" name="lodging[]">\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '   <div class="transport-wrapper col-sm-2">\n' +
                    '       <div class="input-group">\n' +
                    '           <div class="input-group-prepend">\n' +
                    '               <span class="input-group-text">Rp.</span>\n' +
                    '           </div>\n' +
                    '           <input type="number" class="form-control employee-transport" value="' + transport + '" name="transport[]">\n' +
                    '       </div>\n' +
                    '   </div>\n' +
                    '   <div class="col-sm-2"><a href="javascript:void(0);" class="remove_button btn btn-sm btn-danger"><i class="fa fa-minus"></i></a></div>' +
                    '</div>\n' +
                    '<div class="form-group row">\n' +
                    '   <label class="col-sm-1 col-form-label"></label>\n' +
                    '   <div class="input-group col-md-3 d-flex align-items-end">\n' +
                    '       <input type="text" class="form-control employee-id" value="" name="employee-id[]" placeholder="NIP" disabled>\n' +
                    '       <input type="text" class="form-control employee-group col-md-3" value="" name="employee-group[]" placeholder="Gol" disabled>\n' +
                    '   </div>\n' +
                    '</div>';
            },
            _populateRabStep: function () {
                var self = this;

                // personnel
                var personnelLength = [];
                $.map($("select[name='employee-name[]']"), function (obj, index) {
                    personnelLength.push($(obj).text());
                });

                var personnelGroup = [];
                $.map($("input[name='employee-group[]']"), function (obj, index) {
                    // $(obj).attr('disabled', false);
                    personnelGroup.push($(obj).val().split('/')[0]);
                    // $(obj).attr('disabled', true);
                });

                var trString = '';
                $.each(personnelLength, function (k, v) {
                    if (k === 0) teamLead = v;
                    trString += "<tr>" +
                        "<td>" + (k + 1) + "</td>" +
                        "<td>" + v + "</td>" +
                        "<td>Gol. " + personnelGroup[k] + "</td>" +
                        "<td>" + ((k === 0) ? "Kepala Tim" : "Anggota") + "</td>" +
                        "</tr>";
                });
                $('#rab-personnel-table').html(trString);

                // 1 & 2
                var theGroup = {};
                for (var i = 0; i < personnelGroup.length; i++) {
                    theGroup[personnelGroup[i]] = 1 + (theGroup[personnelGroup[i]] || 0);
                }

                var start = $('#start-date').datepicker('getDate');
                var end = $('#end-date').datepicker('getDate');
                var days = (end - start) / 1000 / 60 / 60 / 24
                var oh = '';
                var lodging = '';
                $.each(theGroup, function (k, v) {
                    oh += self._rabOhLodgingTemplate(k, v, (days + 1), 'oh');
                    lodging += self._rabOhLodgingTemplate(k, v, days, 'lodging');
                });
                $('.rab-oh-wrapper').html(oh);
                $('.rab-lodging-wrapper').html(lodging);

                var maxField = 10;
                var dynamicRabTransportWrapper = $('.dynamic-rab-transport');
                var x = 1;

                $('#first-transport').val(personnelLength.length);

                dynamicRabTransportWrapper.on('click', '.add_button_transport', function (e) {
                    if (x < maxField) {
                        var parent = $(this).parent().children();
                        var firstTransport = $($(parent)[0]).val();
                        x++;
                        $(this).closest('.dynamic-rab-transport').append(self._dynamicTransportFieldTemplate(firstTransport));
                    }
                });

                dynamicRabTransportWrapper.on('click', '.remove_button_transport', function (e) {
                    e.preventDefault();
                    $(this).closest('.dynamic-rab-transport').remove();
                    x--;
                });
            },
            _constructRabLayout: function () { // todo make this functional
                var template = '';
                $.get(options.getMbpUrl, function (data, status) {
                    if (data != null) {
                        $.each(data, function (k, v) {
                            var c = v.name.toLowerCase().replaceAll(" ", "-");
                            template += '<div class="rab-' + c + '" id="' + v.id + '"><h4>' + (k + 1) + '. ' + v.name.toUpperCase() + '</h4></div><hr>';
                        });
                    }
                    $('.master-budget-plan-wrapper').html(template);
                });
            },
            _rabOhLodgingTemplate: function (gol, qty, days, id) { // identical element
                return '' +
                    '<div class="form-group row">\n' +
                    '   <label for="activity-code" class="col-sm-2 col-form-label">Golongan ' + gol + '</label>\n' +
                    '   <input type="hidden" name="desc[]" value="Golongan ' + gol + '">' +
                    '   <div class="input-group col-md-7 d-flex align-items-end">\n' +
                    '       <input class="form-control col-md-1" id="" name="qty1[]" value="' + qty + '" placeholder="qty">\n' +
                    '       <input class="form-control col-md-1" id="" name="unit1[]" value="org x" disabled>\n' +
                    '       <input class="form-control col-md-1" id="" name="qty2[]" value="' + days + '" placeholder="qty">\n' +
                    '       <input class="form-control col-md-1" id="" name="unit2[]" value="hari x" disabled>\n' +
                    '       <div class="input-group-prepend">\n' +
                    '           <span class="input-group-text">Rp.</span>\n' +
                    '       </div>\n' +
                    '       <input type="number" class="form-control col-md-3" value="" name="nominal[]" placeholder="Nominal">\n' +
                    '   </div>\n' +
                    '</div>';
            },
            _dynamicTransportFieldTemplate: function (qty) {
                return '' +
                    '<div class="dynamic-rab-transport"><div class="form-group row">\n' +
                    '   <input class="form-control col-sm-2" name="desc[]" value="" placeholder="Keterangan">\n' +
                    '   <div class="input-group col-md-7">\n' +
                    '       <input class="form-control col-md-1" name="qty1[]" value="' + qty + '" placeholder="qty">\n' +
                    '       <input class="form-control col-md-1" name="unit1[]" value="org x" disabled>\n' +
                    '       <input class="form-control col-md-1" name="qty2[]" value="" placeholder="qty">\n' +
                    '       <input class="form-control col-md-1" name="unit2[]" value="P x" disabled>\n' +
                    '       <div class="input-group-prepend">\n' +
                    '           <span class="input-group-text">Rp.</span>\n' +
                    '       </div>\n' +
                    '       <input type="number" class="form-control col-md-3" value="" name="nominal[]" placeholder="Nominal">\n' +
                    '       <a href="javascript:void(0);" class="remove_button_transport btn btn-sm btn-danger ml-3"><i class="fa fa-minus"></i></a>' +
                    '   </div>\n' +
                    '</div></div>';
            },
            init: function () {
                var self = this;
                self._initialize();
                self._stepper();
                self._employeeSearch();
                self._clickListener();
            }
        };

        return handler;
    }
};
