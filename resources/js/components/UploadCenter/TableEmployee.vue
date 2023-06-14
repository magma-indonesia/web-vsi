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
                    <a-button icon="plus" type="primary" @click="handleAdd" style="margin-left: 10px">
                        Upload
                    </a-button>
                </div>
            </div>
        </a-card>
        <div class="table table-responsive">
            <div class="row">
                <div class="col">
                    <a-table :rowKey="'id'" style="margin-top: 10px" :columns="columns" :data-source="data"
                        :pagination="pagination" :loading="loading" @change="handleTableChange">
                        <template slot="action" slot-scope="text, record">
                            <div class="d-flex align-items-center justify-content-center flex-column" style="gap: 10px">
                                <div class="d-flex align-items-center justify-content-center" style="gap: 10px">
                                    <a-button type="primary" key="/detail" icon="eye"
                                        @click="handleDetail(record)"></a-button>
                                </div>
                            </div>
                        </template>
                    </a-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: [
        "apiurl",
        "addurl",
        "detailurl",
    ],
    data() {
        return {
            columns: [
                {
                    title: "NIP",
                    dataIndex: "nip",
                },
                {
                    title: "Nama",
                    dataIndex: "name",
                },
                {
                    title: "Kelompok Kerja",
                    dataIndex: "segment_name",
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
            window.location.href = this.detailurl + "?user_id=" + val.id;
        },
        handleSearch(e) {
            this.params.search = e;
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
                .get(`${this.apiurl}/dashboard/api/upload-center`, {
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
    },
};
</script>
