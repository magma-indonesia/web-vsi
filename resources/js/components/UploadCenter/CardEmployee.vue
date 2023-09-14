<template>
    <div>
        <div v-if="loading">
            <a-skeleton active />
        </div>
        <div v-else>
            <div
                v-if="data.length > 0"
                style="display: flex; flex-direction: column"
            >
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
                        <a-select-option value="12">12</a-select-option>
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
                        Upload
                    </a-button>
                </div>
            </div>
        </a-card>
                <a-row
                    :gutter="[12, 12]"
                    style="margin-top: 30px; margin-bottom: 30px"
                >
                    <a-col
                        :xs="12"
                        :sm="6"
                        :md="4"
                        :lg="4"
                        v-for="(item, index) in data"
                        :key="index"
                    >
                    <div class="card-group">
                        <div class="card">
                        <a-card
                            class="card-img-top"
                            hoverable
                            style="position: relative"
                            @click="handleDetail(item)"
                        >
                            <div
                                class="img-thumbnail"
                                slot="cover"
                                :style="{
                                    'background-image': `url(${
                                        apiurl + '/images/folder.png'
                                    })`,
                                    'background-repeat': 'no-repeat',
                                    'background-size': 'cover',
                                    'background-position': 'center',
                                    'height': 'auto',
                                    'padding-top':'75%',
                                    'width': '100%',
                                }"
                                @click="handleDetail(item)"
                            />
                            <template slot="actions">
                                <a-button
                                    type="primary"
                                    style="background: #293d50"
                                    @click="handleDetail(item)"
                                >
                                    Detail
                                </a-button>
                            </template>
                            <a-card-meta>
                                <div
                                    style="
                                        display: flex;
                                        flex-direction: column;
                                    "
                                    slot="title"
                                >
                                    <a
                                        @click="handleDetail(item)"
                                        href="javascript:;"
                                        class="news-title"
                                        style="margin-top: 10px"
                                        :title="item.name"
                                    >
                                        {{ item.name }}
                                    </a>
                                </div>
                                <!-- <div
                                    slot="description"
                                    v-html="truncString(item.name)"
                                ></div> -->
                            </a-card-meta>
                        </a-card>
                    </div>
                    </div>
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
                <div style="display: flex; align-items: center">
                    <div style="margin-left: auto">
                        <a-input-search
                            placeholder="Cari data"
                            @search="handleSearch"
                        ></a-input-search>
                    </div>
                </div>
                <a-empty>
                    <div style="font-size: 12px" slot="description">
                        <b>Oops data kosong</b> <br />
                        <span style="color: #8c8c8c">
                            Data dasar tidak ditemukan.
                        </span>
                    </div>
                </a-empty>
            </div>
        </div>
    </div>
</template>
<script>
import helper from "../../utils/helper";
export default {
    props: [
        "apiurl",
        "addurl",
        "detailurl",
    ],
    data() {
        return {
            data: [],
            loading: false,
            params: {
                search: "",
            },
            pagination: {
                current: 1,
                pageSize: 12, 
                total: 0,
            },
        };
    },
    mounted() {
        this.fetchData(this.params, this.pagination);
    },
    methods: {
        truncString(item) {
            return helper.truncString(item, 120, "...");
        },
        handleAdd() {
            window.location.href = this.addurl;
        },
        handleDetail(item) {
            window.location.href = this.detailurl + "?user_id=" + item.id;
        },
        handlePageChange(page, pageSize) {
            this.pagination.current = page;
            this.pagination.pageSize = pageSize;
            this.fetchData(this.params, {
                current: page,
                pageSize: pageSize,
                total: this.pagination.total,
            });
        },
        handleSizeChange(page, pageSize) {
            this.pagination.current = page;
            this.pagination.pageSize = pageSize;
            this.fetchData(this.params, {
                current: page,
                pageSize: pageSize,
                total: this.pagination.total,
            });
        },
        handlePageSize(val) {
            this.pagination.pageSize = val;
            this.fetchData(this.params, {
                current: this.pagination.current,
                pageSize: val,
                total: this.pagination.total,
            });
        },
        handleSearch(e) {
            console.log(e);
            this.params.search = e;
            this.fetchData(
                {
                    search: e,
                },
                this.pagination
            );
        },
        fetchData(param = this.params, p = this.pagination) {
            this.loading = true;
            axios
                .get(`${this.apiurl}/dashboard/api/upload-center`, {
                    params: {
                        ...param,
                        page: p.current,
                        pageSize: p.pageSize,
                        category_id: this.category,
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