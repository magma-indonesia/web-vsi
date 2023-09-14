<template>
    <div>
        <a-card>
            <div
                class="d-flex flex-wrap"
                style="width: 100%; align-items: flex-end"
            >
                <div class="d-flex align-items-center">
                    <span style="font-size: 12px">Show</span>
                    <a-select
                        @change="handlePageSize"
                        style="
                            width: 80px;
                            margin-left: 10px;
                            margin-right: 10px;
                        "
                        :value="pagination.pageSize"
                    >
                        <a-select-option value="10">10</a-select-option>
                        <a-select-option value="50">50</a-select-option>
                        <a-select-option value="100">100</a-select-option>
                        <a-select-option value="500">500</a-select-option>
                    </a-select>
                    <span style="font-size: 12px">entries</span>
                </div>
                <div
                    style="margin-left: auto"
                    class="d-flex align-items-center"
                >
                    <a-input-search
                        placeholder="Cari data"
                        @search="handleSearch"
                    />
                    <a-button
                        icon="plus"
                        type="primary"
                        @click="handleAdd"
                        style="margin-left: 10px"
                    >
                        Create new
                    </a-button>
                </div>
            </div>
            <a-divider />
            <a-table
                :rowKey="'id'"
                style="margin-top: 10px"
                :columns="columns"
                :data-source="data"
                :pagination="pagination"
                :loading="loading"
                @change="handleTableChange"
            >
                <template slot="action" slot-scope="text, record">
                    <div
                        class="d-flex align-items-center justify-content-center flex-column"
                        style="gap: 10px"
                    >
                        <div
                            class="d-flex align-items-center justify-content-center"
                            style="gap: 10px"
                        >
                            <a-button
                                type="primary"
                                key="/edit"
                                icon="edit"
                                @click="handleEdit(record)"
                            >
                                Edit
                            </a-button>
                            <a-popconfirm
                                placement="left"
                                title="Anda yakin ingin menghapus data ini?"
                                @confirm="handleDelete(record)"
                                ok-text="Iya"
                                cancel-text="Tidak"
                            >
                                <a-button
                                    type="danger"
                                    key="/delete"
                                    icon="delete"
                                >
                                    Hapus
                                </a-button>
                            </a-popconfirm>
                        </div>
                    </div>
                </template>
                <template slot="files" slot-scope="text, record">
                    <div style="font-size: 12px">
                        {{ record.files?.length }}
                    </div>
                </template>
                <template slot="status" slot-scope="text, record">
                    <div style="font-size: 12px">
                        {{ record.status == "1" ? "Ya" : "Tidak" }}
                    </div>
                </template>
            </a-table>
        </a-card>
    </div>
</template>
<script>
import axios from "axios";
import helper from "../../utils/helper";

export default {
    props: ["apiurl", "addurl", "editurl"],
    data() {
        return {
            columns: [
                {
                    title: "Judul",
                    dataIndex: "title",
                },
                {
                    title: "Jumlah File(s)",
                    dataIndex: "files",
                    scopedSlots: { customRender: "files" },
                },
                {
                    title: "Published",
                    dataIndex: "status",
                    scopedSlots: { customRender: "status" },
                },
                {
                    title: "Kontributor",
                    dataIndex: "created_by",
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
                name: "",
            },
            loading: false,
            current: false,
        };
    },
    mounted() {
        this.fetchData(this.params, this.pagination);
    },
    methods: {
        formattedTime(data) {
            return helper.formattedTime(data);
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
        handleEdit(val) {
            this.current = val;
            window.location.href =
                this.editurl.replace(/\/0/g, "") + "/" + val.id;
        },
        handleDelete(val) {
            const postData = { id: val.id };
            axios({
                url: `${this.apiurl}/dashboard/press-release/apis`,
                method: "DELETE",
                data: postData,
            }).then(() => {
                this.fetchData(this.params, this.pagination);
            });
        },
        handleSearch(e) {
            this.params.name = e;
            this.fetchData(
                {
                    name: e,
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
                .get(`${this.apiurl}/dashboard/press-release/apis`, {
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
