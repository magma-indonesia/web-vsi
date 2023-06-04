<template>
    <div>
        <div v-if="loading">
            <a-skeleton active />
        </div>
        <div v-else>
            <div style="display: flex; align-items: center">
                <span style="font-size: 12px">Show</span>
                <a-select
                    @change="handlePageSize"
                    style="width: 80px; margin-left: 10px; margin-right: 10px"
                    :value="pagination.pageSize"
                >
                    <a-select-option value="10">10</a-select-option>
                    <a-select-option value="60">60</a-select-option>
                    <a-select-option value="120">120</a-select-option>
                    <a-select-option value="600">600</a-select-option>
                </a-select>
                <span style="font-size: 12px">entries</span>
                <div style="margin-left: auto">
                    <a-input-search
                        v-model="params.name"
                        @search="handleSearch"
                        placeholder="Cari data disini..."
                    ></a-input-search>
                </div>
            </div>
            <div
                v-if="data.length > 0"
                style="display: flex; flex-direction: column"
            >
                <a-row
                    :gutter="[12, 12]"
                    style="margin-top: 30px; margin-bottom: 30px"
                >
                    <a-col
                        :xs="24"
                        :sm="24"
                        :md="24"
                        :lg="6"
                        v-for="(item, index) in data"
                        :key="index"
                    >
                        <a-card
                            hoverable
                            style="position: relative"
                            @click="handleDetail(item)"
                        >
                            <div
                                v-if="type !== 'document'"
                                slot="cover"
                                :style="{
                                    'background-image': `url(${generateImage(
                                        item
                                    )})`,
                                    'background-repeat': 'no-repeat',
                                    'background-size': 'cover',
                                    'background-position': 'center',
                                    height: '200px',
                                    width: '100%',
                                }"
                                @click="handleDetail(item)"
                            />
                            <div
                                v-else
                                slot="cover"
                                :style="{
                                    'background-image': `url('/images/pdf.png')`,
                                    'background-repeat': 'no-repeat',
                                    'background-size': 'cover',
                                    'background-position': 'center',
                                    height: '200px',
                                    width: '100%',
                                }"
                                @click="handleDetail(item)"
                            />
                            <template slot="actions">
                                <a-button
                                    type="primary"
                                    style="background: #293d50"
                                    @click="handleDetail(item)"
                                >
                                    Pilih File
                                </a-button>
                            </template>
                            <a-card-meta>
                                <div slot="description">
                                    <a
                                        @click="handleDetail(item)"
                                        href="javascript:;"
                                        class="news-title"
                                        style="
                                            margin-top: 10px;
                                            break-word: break-all;
                                        "
                                    >
                                        {{ item.name }}
                                    </a>
                                    <div v-html="truncString(item.notes)" />
                                </div>
                            </a-card-meta>
                        </a-card>
                    </a-col>
                </a-row>
                <a-pagination
                    style="display: block; text-align: center"
                    :current="pagination.current"
                    :page-size.sync="pagination.pageSize"
                    :total="pagination.total"
                    @change="handlePageChange"
                    @showSizeChange="handleSizeChange"
                />
            </div>
            <div v-else>
                <a-empty>
                    <div style="font-size: 12px" slot="description">
                        <b>Oops data kosong</b> <br />
                        <span style="color: #8c8c8c">
                            Data tidak ditemukan.
                        </span>
                    </div>
                </a-empty>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import helper from "../../utils/helper";
export default {
    props: ["index", "type", "apiurl", "role"],
    data() {
        return {
            deleted: [],
            data: [],
            pagination: {
                current: 1,
                pageSize: 10,
                total: 0,
            },
            loading: false,
            params: {
                name: "",
            },
        };
    },
    watch: {
        type: function (val) {
            if (val) {
                this.fetchFile(this.params, this.pagination);
            }
        },
    },
    mounted() {
        this.fetchFile();
    },
    methods: {
        truncString(item, n) {
            return helper.truncString(item, n, "...");
        },
        handleDetail(item) {
            this.$emit("close", item);
        },
        handleSearch(e) {
            this.params.name = e;
            this.fetchFile(
                {
                    name: e,
                },
                this.pagination
            );
        },
        handlePageChange(page, pageSize) {
            this.pagination.current = page;
            this.pagination.pageSize = pageSize;
            this.fetchFile(this.params, {
                current: page,
                pageSize: pageSize,
                total: this.pagination.total,
            });
        },
        handleSizeChange(page, pageSize) {
            this.pagination.current = page;
            this.pagination.pageSize = pageSize;
            this.fetchFile(this.params, {
                current: page,
                pageSize: pageSize,
                total: this.pagination.total,
            });
        },
        handlePageSize(val) {
            this.pagination.pageSize = val;
            this.fetchFile(this.params, {
                current: this.pagination.current,
                pageSize: val,
                total: this.pagination.total,
            });
        },
        generateImage(record) {
            return `${window.location.origin}/files/${
                record.id
            }/${encodeURIComponent(record.name)}`;
        },
        fetchFile(param = this.params, p = this.pagination) {
            this.loading = true;
            axios
                .get(
                    `${this.apiurl}/dashboard/press-release/apis/files${
                        this.role != "1" ? `?user_id=1` : ""
                    }`,
                    {
                        params: {
                            ...param,
                            ext:
                                this.type === "document"
                                    ? "pdf"
                                    : "png,jpeg,jpg,svg",
                            page: p.current,
                            pageSize: p.pageSize,
                        },
                    }
                )
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
