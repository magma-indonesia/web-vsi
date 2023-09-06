<template>
    <div>
        <a-card>
            <div class="d-flex flex-wrap" style="width: 100%; align-items: flex-end">
                <div class="d-flex align-items-center">
                    <span style="font-size: 12px">Show</span>
                    <a-select @change="handlePageSize" style="
                            width: 80px;
                            margin-left: 10px;
                            margin-right: 10px;
                        " :value="pagination.pageSize">
                        <a-select-option value="10">10</a-select-option>
                        <a-select-option value="50">50</a-select-option>
                        <a-select-option value="100">100</a-select-option>
                        <a-select-option value="500">500</a-select-option>
                    </a-select>
                    <span style="font-size: 12px">entries</span>
                </div>
                <div style="margin-left: auto" class="d-flex align-items-center">
                    <a-input-search placeholder="Cari data" @search="handleSearch" />
                </div>
            </div>
        </a-card>
        <div class="table table-responsive">
            <div class="row">
                <div class="col">
                    <a-table :rowKey="'id'" style="margin-top: 10px" :columns="columns" :data-source="data"
                        :pagination="pagination" :loading="loading" @change="handleTableChange">
                        <template slot="is_read" slot-scope="text, record">
                            <a-tag v-if="record.is_read === 1" color="green">Sudah dibaca</a-tag>
                            <a-tag v-else color="red">Belum dibaca</a-tag>
                        </template>
                        <template slot="action" slot-scope="text, record">
                            <div class="d-flex align-items-center justify-content-center flex-column">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a-button type="primary" key="/detail" icon="eye"
                                        @click="handleDetail(record)"></a-button>
                                </div>
                            </div>
                        </template>
                    </a-table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="notif-detail" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Detail Pesan
                        </h5>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label
                                    class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Subject</label>
                                <p class="mg-b-0" v-text="notifDetail.subject"></p>
                            </div>
                            <div class="col-6 col-sm mb-3">
                                <label
                                    class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Nama</label>
                                <p class="mg-b-0" v-text="notifDetail.name"></p>
                            </div>
                            <div class="col-6 col-sm mb-3">
                                <label
                                    class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Email</label>
                                <p class="mg-b-0" v-text="notifDetail.email"></p>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label
                                    class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Pesan</label>
                                <p class="mg-b-0" v-text="notifDetail.message"></p>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label
                                    class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Pertama kali
                                    dibaca Oleh</label>
                                <p class="mg-b-0" v-text="handleReadBy(notifDetail)"></p>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label
                                    class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Pesan
                                    Diterima</label>
                                <p class="mg-b-0" v-text="handleFormatDate(notifDetail.created_at)"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="closeModal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import moment from "moment";

export default {
    props: ["apiurl", "usernip"],
    data() {
        return {
            notifDetail: {},
            columns: [
                {
                    title: "No",
                    customRender: function (text, record, index) {
                        return index + 1;
                    },
                },
                {
                    title: "Nama",
                    dataIndex: "name",
                },
                {
                    title: "Subject",
                    dataIndex: "subject",
                },
                {
                    title: "Tanggal Pesan",
                    dataIndex: "created_at",
                    customRender: (text, record, index) => {
                        return moment(text).format("DD MMMM YYYY HH:mm:ss");
                    },
                },
                {
                    title: "#",
                    width: "15%",
                    align: "center",
                    dataIndex: "is_read",
                    scopedSlots: { customRender: "is_read" },
                },
                {
                    title: "#",
                    width: "10%",
                    align: "center",
                    dataIndex: "action",
                    scopedSlots: { customRender: "action" },
                },
            ],
            data: [],
            pagination: {
                current: 1,
                pageSize: 10,
                total: 0,
            },
            params: {
                search: "",
            },
            loading: false,
            current: false,
        };
    },
    mounted() {
        this.fetchData(this.params, this.pagination);
    },
    methods: {
        handleFormatDate(date) {
            return moment(date).format("DD MMMM YYYY HH:mm:ss");
        },
        handlePageSize(val) {
            this.pagination.pageSize = val;
            this.fetchData(this.params, {
                current: this.pagination.current,
                pageSize: val,
                total: this.pagination.total,
            });
        },
        handleCloseDrawer() {
            this.current = false;
            this.fetchData(this.params, this.pagination);
        },
        handleAdd() {
            window.location.href = this.addurl;
        },
        async handleDetail(record) {
            axios
                .post(`${this.apiurl}/dashboard/api/public-services/messages/detail`,
                    {
                        'id' : record.id,
                        'nip' : this.usernip,
                    })
                .then(async (data) => {
                    this.notifDetail = data?.data?.serve;
                });
            $("#notif-detail").modal("show");
        },
        handleSearch(e) {
            this.params.search = e;
            this.pagination = {
                current: 1,
                pageSize: 10,
                total: 0,
            };

            this.fetchData({search: e}, this.pagination);
        },
        handleTableChange(page) {
            this.fetchData(this.params, page);
        },
        handleReadBy(record) {
            // upon open by user this will always null if message have not been opened by anyone
            // hanya kosmetik
            if (record.reader_name === null || record.reader_name === "")  {
                return "---";
            }
            return record.reader_name + ' - ' + record.read_by;
        },
        fetchData(param = this.params, p = this.pagination) {
            this.loading = true;
            axios
                .get(`${this.apiurl}/dashboard/api/public-services/messages/`, {
                    params: {
                        ...param,
                        page: p.current,
                        pageSize: p.pageSize,
                    },
                })
                .then(async (data) => {
                    this.loading = false;
                    this.data = data?.data?.serve.data;
                    this.pagination = {
                        current: data?.data?.serve.current_page,
                        pageSize: data?.data?.serve.per_page,
                        total: data?.data?.serve.total,
                    };
                });
        },
        closeModal() {
            this.fetchData(this.params, this.pagination);
        },
    },
};
</script>
