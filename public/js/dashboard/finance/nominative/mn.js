'use strict';

var MasterNominativeHandler = {
    construct: function (options) {
        const handler = {
            _initialize: function () {
                const self = this;
                console.log(options);
                $('#budget-year').val('/' + new Date().getFullYear()).attr('disabled', 'disabled');
            },
            _clickListener: function () {
                const self = this;

                // kosmetik banget
                $('#initiate-nominative').on('click', function (e) {
                    if (self._validate()) {
                        $('#initiate-nominative').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                        setTimeout(function (e) {
                            // do ajax post here,
                            // this entrypoint should act as a save or edit func
                            // retrieve saved master nominative id
                            // replace route placeholder id
                            // set window location to form input nominative
                            window.location = options.next;
                        }, 500);
                    }
                });
            },
            _validate: function () {
                if ($('#id-sppd').val().length === 0) {
                    alert('NO SPD tidak boleh kosong!');
                    return false;
                }

                if ($('#code-mak').val().length === 0) {
                    alert('NO MAK tidak boleh kosong!');
                    return false;
                }

                return true;
            },
            _activitySearch: function () {
                var self = this;

                var activitySelect = $('#code-mak');
                activitySelect.select2({
                    width: '100%',
                    allowClear: true,
                    theme: 'bootstrap-5',
                    placeholder: 'Cari No MAK',
                    minimumInputLength: 3,
                    ajax: {
                        url: options.searchActivityUrl,
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {search: params.term};
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.code,
                                        id: item.id,
                                        name: item.name
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });

                // prevent enter key behaviour in typehead
                activitySelect.keydown(function (event) {
                    if (event.keyCode === 13) {
                        event.preventDefault();
                        return false;
                    }
                });

                activitySelect.on('select2:selecting', function (e) {
                    var data = e.params.args.data;
                    options.next = options.next.replace("#TMP#", data.id);
                });
            },
            init: function () {
                const self = this;
                self._initialize();
                self._clickListener();
                self._activitySearch();
            }
        };

        return handler;
    }
};
