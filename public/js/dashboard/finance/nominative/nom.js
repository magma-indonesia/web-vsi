'use strict';

var NominativeHandler = {
    construct: function (options) {
        var citySelect;
        var employeeSelect;
        var handler = {
            _initialize: function () {
                var self = this;
                console.log(options);
            },
            _clickListener: function () {
                var self = this;

                var maxField = 10;
                var dynamicPersonnelWrapper = $('.dynamic-employee');
                var x = 1;
                var personnel_field = '' +
                    '<div class="form-group row">' +
                    '<label for="" class="col-sm-1 col-form-label"></label>' +
                    '<div class="col-sm-3"><select type="search" class="form-control employee-search" name="employee-name[]"></select></div>' +
                    '<div class="col-sm-2"><input type="text" class="form-control employee-id" value="" name="employee-id[]" disabled></div>' +
                    '<div class="col-sm-1"><input type="text" class="form-control employee-group" value="" name="employee-group[]" disabled></div>' +
                    '<div class="col-sm-2"><a href="javascript:void(0);" class="remove_button btn btn-sm btn-danger"><i class="fa fa-minus"></i></a> </div>' +
                    '</div>';

                dynamicPersonnelWrapper.on('click', '.add_button', function () {
                    if (x < maxField) {
                        x++;
                        $(this).closest('.dynamic-employee').append(personnel_field);
                        self._employeeSearch();
                    }
                });

                dynamicPersonnelWrapper.on('click', '.remove_button', function (e) {
                    e.preventDefault();
                    $(this).closest('.form-group').remove();
                    x--;
                });
            },
            _stepper: function () {
                var self = this;

                $('#wizard4').steps({
                    headerTag: 'h3',
                    bodyTag: 'section',
                    autoFocus: true,
                    titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                    transitionEffect: 2,
                    // stepsOrientation: 1,
                    onStepChanging: function (event, currentIndex, newIndex) {
                        if (currentIndex < newIndex) {
                            // Step 1 form validation
                            if (currentIndex === 0) {

                                console.log($('#form-nominative').serialize());

                                var dest = $('#destination-city').parsley();
                                var sdate = $('#start-date').parsley();
                                var edate = $('#end-date').parsley();

                                if (dest.isValid() && sdate.isValid() && edate.isValid()) {
                                    return true;
                                } else {
                                    dest.validate();
                                    sdate.validate();
                                    edate.validate();
                                }
                            }

                            // Step 2 form validation
                            if (currentIndex === 1) {
                                var email = $('#email').parsley();
                                if (email.isValid()) {
                                    return true;
                                } else {
                                    email.validate();
                                }
                            }
                            // Always allow step back to the previous step even if the current step is not valid.
                        } else {
                            return true;
                        }
                    }
                });
            },
            _citySearch: function () {
                var self = this;

                citySelect = $('#destination-city');
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
                    var nipPlaceholder = $(this).parent().next().children();
                    var groupPlaceholder = $(this).parent().next().next().children();
                    nipPlaceholder.val(data.nip);
                    groupPlaceholder.val(data.group + '/' + data.class);
                });
            },
            init: function () {
                var self = this;
                self._initialize();
                self._stepper();
                // select2 function initialisation should always called last or else everything would break apart
                self._citySearch();
                self._employeeSearch();
                self._clickListener();
            }
        };

        return handler;
    }
};
