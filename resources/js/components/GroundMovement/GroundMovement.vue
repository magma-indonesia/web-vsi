<template>
    <div>
        <div v-if="loading">
            <a-skeleton active />
        </div>
        <div v-else>
            <div
                v-if="articles.length > 0"
                style="display: flex; flex-direction: column"
            >
                <div style="display: flex; align-items: center">
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
                        <a-select-option value="60">60</a-select-option>
                        <a-select-option value="120">120</a-select-option>
                        <a-select-option value="600">600</a-select-option>
                    </a-select>
                    <span style="font-size: 12px">entries</span>
                    <div style="margin-left: auto">
                        <a-input-search
                            placeholder="Cari data"
                            @search="handleSearch"
                        ></a-input-search>
                    </div>
                </div>
                <a-row
                    :gutter="[12, 12]"
                    style="margin-top: 30px; margin-bottom: 30px"
                >
                    <a-col
                        :xs="24"
                        :sm="24"
                        :md="24"
                        :lg="8"
                        v-for="(item, index) in articles"
                        :key="index"
                    >
                        <a-card
                            hoverable
                            style="position: relative"
                            @click="handleDetail(item)"
                        >
                            <div
                                slot="cover"
                                :style="{
                                    'background-image': `url(${
                                        item.thumbnail
                                            ? item.thumbnail
                                            : apiurl +
                                              '/images/placeholder-image.jpeg'
                                    })`,
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
                                    Selengkapnya
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
                                    <!-- <div
                                        style="
                                            display: flex;
                                            flex-wrap: wrap;
                                            margin-top: 10px;
                                        "
                                        v-if="item.news_categories?.length > 0"
                                    >
                                        <a-tag
                                            color="#fee50f"
                                            style="margin-bottom: 10px"
                                            v-for="(
                                                cat, idx
                                            ) in item.news_categories"
                                            :key="idx"
                                        >
                                            {{ cat.category }}
                                        </a-tag>
                                    </div> -->
                                    <a
                                        @click="handleDetail(item)"
                                        href="javascript:;"
                                        class="news-title"
                                        style="margin-top: 10px"
                                    >
                                        {{ item.title }}
                                    </a>
                                </div>
                                <div
                                    slot="description"
                                    v-html="truncString(item.description)"
                                ></div>
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
    props: ["category", "apiurl", "menuslug"],
    data() {
        return {
            articles: [],
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
        handleDetail(item) {
            window.location.href =
                this.apiurl +
                "/gerakan-tanah/" +
                this.menuslug +
                "/" +
                item.slug;
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
                .get(`${this.apiurl}/gerakan-tanah`, {
                    params: {
                        ...param,
                        page: p.current,
                        pageSize: p.pageSize,
                        category_id: this.category,
                    },
                })
                .then(async (data) => {
                    this.loading = false;
                    this.articles = data?.data?.serve.data;
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
