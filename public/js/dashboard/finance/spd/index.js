'use strict';

var SpdHandler = {
    construct: function (options) {
        var _table;
        const handler = {
            _initialize: function () {
                const self = this;
                console.log(options);
                _table = self._initTable();
            },
            _clickListener: function () {
                const self = this;

                $('#spd-table').on('click', '.spd-summary', function (e) {
                    console.log($(this).attr('id'));
                    window.location = options.viewNominativeUrl.replace('#TMP#', $(this).attr('id'));
                })
            },
            _initTable: function () {
                var self = this;
                var tmpTable;

                // SUMMARY =================================================================================
                tmpTable = $("#spd-table").DataTable({
                    processing: true,
                    serverSide: true,
                    paging: false,
                    searching: false,
                    ajax: {
                        url: options.getDataTableUrl,
                        data: function (data) {
                            // filter to send to the other side
                        },
                        dataSrc: ''
                    },
                    columnDefs: [
                        {
                            targets: 0, sortable: false,
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            targets: 1, render: function (data, type, row, meta) {
                                // console.log(row)
                                return row.id;
                            },
                            visible: false,
                        },
                        {
                            targets: 2, render: function (data, type, row, meta) {
                                return "<a href=\"javascript:;\" class=\"spd-summary\" id=" + row.id + ">" + row.code + "</a>"
                            },
                            orderable: false
                        },
                        {
                            targets: 3, render: function (data, type, row, meta) {
                                return row.user.name;
                            },
                            orderable: false
                        },
                        {
                            targets: 4,
                            searchable: false,
                            orderable: false,
                            className: 'dt-body-center',
                            render: function (data, type, row, meta) {
                                return '<input type="checkbox" name="id" value="" checked disabled>';
                                // return row.spd_status.desc + ' (' + row.spd_status.code + ')';
                            }
                        },
                        {
                            className: 'dt-body-center',
                            targets: 5, render: function (data, type, row, meta) {
                                return '<input type="checkbox" name="id" value="" disabled>';
                            },
                            orderable: false
                        },
                        {
                            className: 'dt-body-center',
                            targets: 6, render: function (data, type, row, meta) {
                                return '<input type="checkbox" name="id" value="" disabled>';
                            },
                            orderable: false
                        },
                        {
                            className: 'dt-body-center',
                            targets: 7, render: function (data, type, row, meta) {
                                return '<input type="checkbox" name="id" value="" disabled>';
                            },
                            orderable: false
                        },
                        {
                            className: 'dt-body-center',
                            targets: 8, render: function (data, type, row, meta) {
                                return '<input type="checkbox" name="id" value="" disabled>';
                            },
                            orderable: false
                        },
                        {
                            className: 'dt-body-center',
                            targets: 9, render: function (data, type, row, meta) {
                                return '<input type="checkbox" name="id" value="" disabled>';
                            },
                            orderable: false
                        },
                        {
                            className: 'dt-body-center',
                            targets: 10, render: function (data, type, row, meta) {
                                return '<input type="checkbox" name="id" value="" disabled>';
                            },
                            orderable: false
                        },
                        {
                            targets: 11, render: function (data, type, row, meta) {
                                return 'Sedang dilakukan verifikasi';
                            },
                            orderable: false
                        },
                    ],
                    order: [[0, "asc"]],
                });

                return tmpTable;
            },
            init: function () {
                const self = this;
                self._initialize();
                self._clickListener();
            }
        };

        return handler;
    }
};
