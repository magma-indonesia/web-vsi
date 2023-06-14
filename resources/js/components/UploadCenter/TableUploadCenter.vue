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
                    <a-button v-if="loginid == userid" icon="plus" type="primary" @click="handleAdd"
                        style="margin-left: 10px">
                        Create new
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
                                    <a-button type="primary" key="/download" icon="download"
                                        @click="handleDownload(record)"></a-button>
                                    <a-button type="primary" key="/copy" icon="copy"
                                        @click="handleCopyToClipboard(record)"></a-button>
                                    <a-popconfirm v-if="loginid == record.user_id" placement="left"
                                        title="Anda yakin ingin menghapus data ini?" @confirm="handleDelete(record)"
                                        ok-text="Iya" cancel-text="Tidak">
                                        <a-button type="danger" key="/delete" icon="delete"></a-button>
                                    </a-popconfirm>
                                </div>
                            </div>
                        </template>
                        <template slot="created_at" slot-scope="text, record">
                            <div style="font-size: 12px">
                                {{ formattedTime(new Date(record.created_at)) }}
                            </div>
                        </template>
                        <template slot="tags_name" slot-scope="text, record">
                            <div style="
                        display: flex;
                        flex-wrap: wrap;
                        margin-top: 10px;
                    " v-if="record.tags_name.split(',').length > 0">
                                <a-tag color="#4682B4" style="margin-bottom: 10px" v-for="(
                            tag, idx
                        ) in record.tags_name.split(',')" :key="idx">
                                    {{ tag }}
                                </a-tag>
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
import helper from "../../utils/helper";
import { notification } from "ant-design-vue";

export default {
    props: [
        "apiurl",
        "addurl",
        "editurl",
        "role",
        "loginid",
        "userid",
    ],
    data() {
        return {
            columns: [
                {
                    title: "Nama File",
                    dataIndex: "name",
                },
                // {
                //     title: "Path File",
                //     dataIndex: "path",
                // },
                {
                    title: "Label",
                    dataIndex: "tags_name",
                    scopedSlots: { customRender: "tags_name" },
                },
                {
                    title: "Waktu",
                    dataIndex: "created_at",
                    scopedSlots: { customRender: "created_at" },
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
            var win = window.open(this.addurl, '_blank', 'height=400,width=1024,toolbar=1,Location=0,Directories=0,Status=0,menubar=0,Scrollbars=0,Resizable=0');
            win.onbeforeunload = () => {
                this.$notification.success({
                    message: 'File berhasil diupload!',
                    placement: "bottomRight",
                    duration: 0,
                });
                this.fetchData(this.params, this.pagination);
            }
        },
        handleDelete(val) {
            const postData = { id: val.id };
            axios({
                url: `${this.apiurl}/dashboard/api/upload-center`,
                method: "DELETE",
                data: postData,
            }).then(() => {
                this.fetchData(this.params, this.pagination);
            });
        },
        handleDownload(val) {
            window.open(val.url, '_blank');
        },
        async handleCopyToClipboard(val) {
            await navigator.clipboard.writeText(val.url);
            notification.success({
                message: 'Url Copied!',
                placement: "bottomRight",
                duration: 5,
            });
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
                        user_id: this.userid,
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
