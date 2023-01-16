'use strict';

var SipegHandler = {
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

                $('#employee-table tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var tdi = tr.find("i.fa");
                    var row = _table.row(tr);
                    if (row.child.isShown()) {
                        $('div.slider', row.child()).slideUp(function () {
                            row.child.hide();
                            tr.removeClass('shown');
                            tdi.first().removeClass('fa-minus-square');
                            tdi.first().addClass('fa-plus-square');
                        });
                    } else {
                        row.child(self._rowDetailFormat(row.data().json), 'no-padding').show();
                        tr.addClass('shown');
                        tdi.first().removeClass('fa-plus-square');
                        tdi.first().addClass('fa-minus-square');
                        $('div.slider', row.child()).slideDown();
                    }
                });
            },
            _rowDetailFormat: function (d) {
                var container = '';
                container += '<div class="slider">' +
                    '<pre><code>' + JSON.stringify(d, null, 4) + '</code></pre></div>';
                return container;
            },
            _initTable: function () {
                var self = this;
                var tmpTable;

                // SUMMARY =================================================================================
                tmpTable = $("#employee-table").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: options.getDataTableUrl,
                        data: function (data) {
                            // filter to send to the other side
                        },
                        // dataSrc: '' used only if plain array returned from server side
                    },
                    columnDefs: [
                        {
                            targets: 0,
                            className: 'details-control',
                            orderable: false,
                            data: null,
                            defaultContent: '',
                            render: function () {
                                return '<i class="fa fa-plus-square" aria-hidden="true"></i>';
                            },
                        },
                        // {
                        //     targets: 0, sortable: false,
                        //     render: function (data, type, row, meta) {
                        //         return meta.row + meta.settings._iDisplayStart + 1;
                        //     }
                        // },
                        {
                            targets: 1, render: function (data, type, row, meta) {
                                return row.eid;
                            },
                            visible: false,
                        },
                        {
                            targets: 2, render: function (data, type, row, meta) {
                                return row.pid;
                            },
                        },
                        {
                            targets: 3, render: function (data, type, row, meta) {
                                return row.name;
                            },
                            orderable: false
                        },
                        {
                            targets: 4, render: function (data, type, row, meta) {
                                return row.nip;
                            },
                            orderable: false
                        },
                        {
                            targets: 5, render: function (data, type, row, meta) {
                                return row.group;
                            },
                            orderable: false
                        },
                        {
                            targets: 6, render: function (data, type, row, meta) {
                                return row.position;
                            },
                            orderable: false
                        },
                        {
                            targets: 7, render: function (data, type, row, meta) {
                                return row.segment;
                            },
                            orderable: false
                        },
                        {
                            targets: 8, render: function (data, type, row, meta) {
                                return row.email;
                            },
                            orderable: false
                        },
                        {
                            targets: 9, render: function (data, type, row, meta) {
                                return row.json;
                            },
                            visible: false
                        },
                    ],
                    order: [[1, "asc"]],
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
