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
                        <template slot="action" slot-scope="text, record">
                            <div class="d-flex align-items-center justify-content-center flex-column">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a-button type="primary" key="/detail" icon="eye"
                                        @click="handleDetail(record)"></a-button>
                                </div>
                            </div>
                        </template>
                    </a-table>

                    <div v-for="item in data">
                        <div class="modal fade" :id="'modal-detail' + item.id" tabindex="-1" role="dialog"
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
                                                <p class="mg-b-0" v-text="item.subject"></p>
                                            </div>
                                            <div class="col-6 col-sm mb-3">
                                                <label
                                                    class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Nama</label>
                                                <p class="mg-b-0" v-text="item.name"></p>
                                            </div>
                                            <div class="col-6 col-sm mb-3">
                                                <label
                                                    class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Email</label>
                                                <p class="mg-b-0" v-text="item.email"></p>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label
                                                    class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Pesan</label>
                                                <p class="mg-b-0" v-text="item.message"></p>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label
                                                    class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Pesan
                                                    Diterima</label>
                                                <p class="mg-b-0" v-text="handleFormatDate(item.created_at)"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
// moment
import moment from "moment";

export default {
    props: [
        "apiurl",
        // "addurl",
        // "detailurl",
    ],
    data() {
        return {
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
                        // return date and time
                        return moment(text).format("DD MMMM YYYY HH:mm:ss");
                    },
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
        handleDetail(val) {
            this.current = val;
            // show modal-detail{id}
            $("#modal-detail" + val.id).modal("show");
        },
        handleSearch(e) {
            this.params.search = e;
            // reset pagination
            this.pagination = {
                current: 1,
                pageSize: 10,
                total: 0,
            };

            this.fetchData(
                {
                    search: e,
                },
                this.pagination
            );
        },
        handleTableChange(page) {
            this.fetchData(this.params, page);
        },
        fetchData(param = this.params, p = this.pagination) {
            this.loading = true;
            axios
                .get(`${this.apiurl}/dashboard/api/layanan-publik/kontak/`, {
                    params: {
                        ...param,
                        page: p.current,
                        pageSize: p.pageSize,
                    },
                })
                .then(async (data) => {
                    this.loading = false;
                    this.data = data?.data?.serve.data;
                    // console.log(this.data);
                    this.pagination = {
                        current: data?.data?.serve.current_page,
                        pageSize: data?.data?.serve.per_page,
                        total: data?.data?.serve.total,
                    };
                });
        },
    },
};
</script>
