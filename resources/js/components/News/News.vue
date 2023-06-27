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
                    <a-select-option value="15">15</a-select-option>
                    <a-select-option value="60">60</a-select-option>
                    <a-select-option value="120">120</a-select-option>
                    <a-select-option value="600">600</a-select-option>
                </a-select>
                <span style="font-size: 12px">entries</span>
                <div style="margin-left: auto">
                    <a-input-search
                        @search="handleSearch"
                        placeholder="Cari data disini..."
                    ></a-input-search>
                </div>
            </div>
            <div
                v-if="news.length > 0"
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
                        :lg="8"
                        v-for="(item, index) in news"
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
                        <!-- <a-card
                            style="position: relative"
                            :bodyStyle="{ padding: 0 }"
                        >
                            <a-row class="flex items-center">
                                <a-col
                                    :xs="24"
                                    :sm="24"
                                    :md="24"
                                    :lg="6"
                                    style="height: 300px"
                                >
                                    <div
                                        :style="{
                                            height: '100%',
                                            cursor: 'pointer',
                                            background: `url('${generateImage(
                                                item
                                            )}`,
                                            backgroundSize: 'cover',
                                            backgroundRepeat: 'no-repeat',
                                        }"
                                        @click="openImage(generateImage(item))"
                                    ></div>
                                </a-col>
                                <a-col :xs="24" :sm="24" :md="24" :lg="18">
                                    <div
                                        style="
                                            display: flex;
                                            flex-direction: column;
                                            margin: 20px;
                                            border-radius: 8px;
                                        "
                                    >
                                        <div
                                            style="
                                                color: #868ba1;
                                                font-size: 12px;
                                            "
                                        >
                                            {{ formatDate(item.created_at) }}
                                        </div>
                                        <a
                                            @click="handleDetail(item)"
                                            href="javascript:;"
                                            class="news-title"
                                            style="
                                                font-size: 24px;
                                                margin-bottom: 10px;
                                            "
                                        >
                                            {{ truncString(item.title, 100) }}
                                        </a>

                                        <div
                                            v-html="
                                                truncString(item.content, 250)
                                            "
                                        ></div>
                                        <div
                                            style="
                                                display: flex;
                                                flex-wrap: wrap;
                                            "
                                            v-if="
                                                item.tags?.length > 0 ||
                                                item.categories?.length > 0 ||
                                                item.mountain
                                            "
                                        >
                                            <a-tag
                                                style="margin-bottom: 5px"
                                                color="#dc3545"
                                                v-for="(
                                                    cat, idx
                                                ) in removeDuplicate(item.tags)"
                                                :key="idx"
                                            >
                                                {{ cat.name }}
                                            </a-tag>
                                            <a-tag
                                                style="margin-bottom: 5px"
                                                color="#1b84e7"
                                                v-for="(
                                                    cat, idx
                                                ) in item.categories"
                                                :key="idx"
                                            >
                                                {{ cat.category }}
                                            </a-tag>
                                            <a-tag
                                                style="margin-bottom: 5px"
                                                color="#1b84e7"
                                            >
                                                Gunung Api
                                                {{
                                                    item.mountain?.ga_nama_gapi
                                                }}
                                            </a-tag>
                                        </div>
                                    </div>
                                </a-col>
                            </a-row>
                        </a-card> -->
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
import moment from "moment";
import "moment/locale/id";
import _ from "lodash";
import helper from "../../utils/helper";
moment.locale("id");

export default {
    props: ["apiurl", "detailurl"],
    data() {
        return {
            news: [],
            loading: false,
            params: {
                name: "",
            },
            pagination: {
                current: 1,
                pageSize: 15,
                total: 0,
            },
        };
    },
    computed: {
        isPressRelease() {
            return window.location.pathname.indexOf("/press-release") > -1;
        },
        isDataDasar() {
            return window.location.pathname.indexOf("/data-dasar") > -1;
        },
    },
    mounted() {
        this.fetchData(this.params, this.pagination);
    },
    methods: {
        removeDuplicate(data) {
            return _.uniqBy(data, function (e) {
                return e.name;
            });
        },
        generateImage(item) {
            console.log(item);
            return item.thumbnail
                ? this.isPressRelease
                    ? item.thumbnail
                    : window.location.origin +
                      "/storage/" +
                      encodeURIComponent(item.thumbnail)
                : window.location.origin + "/images/placeholder-image.jpeg";
        },
        truncString(item, n) {
            return helper.truncString(item, n, "...");
        },
        formatDate(date) {
            return moment(date).format("dddd, DD MMM YYYY");
        },
        handleDetail(item) {
            window.location.href = this.detailurl + "/" + item.route;
        },
        openImage(item) {
            window.open(item, "_blank");
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
        fetchData(param = this.params, p = this.pagination) {
            this.loading = true;
            axios
                .get(`${this.apiurl}?is_published=1`, {
                    params: {
                        ...param,
                        page: p.current,
                        pageSize: p.pageSize,
                        category_id: this.category,
                    },
                })
                .then(async (data) => {
                    this.loading = false;
                    this.news = data?.data?.serve.data;
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
