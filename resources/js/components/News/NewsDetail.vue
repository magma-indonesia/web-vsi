<template>
    <div>
        <div
            v-if="retrieve"
            style="
                display: flex;
                flex-direction: column;
                background: #fff;
                padding: 20px;
            "
        >
            <img
                :src="JSON.parse(retrieve).thumbnail"
                alt="Thumbnail"
                style="
                    width: 100%;
                    height: 500px;
                    object-fit: contain;
                    margin-bottom: 50px;
                "
            />
            <div
                v-if="
                    JSON.parse(retrieve)?.categories?.length > 0 ||
                    JSON.parse(retrieve)?.tags?.length > 0
                "
                class="flex"
                style="
                    margin-top: 10px;
                    background: rgba(0, 0, 0, 0.03);
                    padding: 10px;
                    margin-bottom: 20px;
                "
            >
                <div
                    v-if="JSON.parse(retrieve)?.categories?.length > 0"
                    style="display: flex; flex-wrap: wrap"
                >
                    <a-tag
                        color="#dc3545"
                        v-for="(cat, idx) in removeDuplicate(
                            JSON.parse(retrieve).categories
                        )"
                        :key="idx"
                    >
                        {{ cat.category }}
                    </a-tag>
                </div>
                <div
                    v-if="JSON.parse(retrieve)?.tags?.length > 0"
                    style="display: flex; flex-wrap: wrap"
                >
                    <a-tag
                        color="#1b84e7"
                        v-for="(cat, idx) in removeDuplicate(
                            JSON.parse(retrieve).tags
                        )"
                        :key="idx"
                    >
                        {{ cat.name }}
                    </a-tag>
                </div>
            </div>
            <div
                style="
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    margin-bottom: 10px;
                "
            >
                <a-icon type="calendar" />
                <div style="font-size: 12px">
                    {{ convertDate(JSON.parse(retrieve).created_at) }}
                </div>
                <a-divider type="vertical" />
                <a-icon type="user" />
                <div style="font-size: 12px">
                    {{ JSON.parse(retrieve).created_by }}
                </div>
            </div>
            <div
                style="font-size: 20px; font-weight: bold; margin-bottom: 10px"
            >
                {{ JSON.parse(retrieve).title || "Untitled" }}
            </div>

            <a-tabs default-active-key="1" v-if="isDataDasar">
                <a-tab-pane key="1" tab="Intro">
                    <div
                        v-html="JSON.parse(retrieve).intro"
                        style="margin-bottom: 10px; margin-top: 10px"
                    />
                </a-tab-pane>
                <a-tab-pane key="2" tab="Sejarah Letusan">
                    <div
                        v-html="JSON.parse(retrieve).history"
                        style="margin-bottom: 10px; margin-top: 10px"
                    />
                </a-tab-pane>
                <a-tab-pane key="3" tab="Geologi">
                    <div
                        v-html="JSON.parse(retrieve).geology"
                        style="margin-bottom: 10px; margin-top: 10px"
                    />
                </a-tab-pane>
                <a-tab-pane key="4" tab="Geofisika">
                    <div
                        v-html="JSON.parse(retrieve).geophysic"
                        style="margin-bottom: 10px; margin-top: 10px"
                    />
                </a-tab-pane>
                <a-tab-pane key="5" tab="Geokimia">
                    <div
                        v-html="JSON.parse(retrieve).geochemistry"
                        style="margin-bottom: 10px; margin-top: 10px"
                    />
                </a-tab-pane>
                <a-tab-pane key="6" tab="Kawasan Rawan Bencana">
                    <div
                        v-html="JSON.parse(retrieve).disaster_area"
                        style="margin-bottom: 10px; margin-top: 10px"
                    />
                </a-tab-pane>
                <a-tab-pane key="7" tab="Daftar Pustaka">
                    <div
                        v-html="JSON.parse(retrieve).reference"
                        style="margin-bottom: 10px; margin-top: 10px"
                    />
                </a-tab-pane>
            </a-tabs>
            <div
                v-else
                v-html="JSON.parse(retrieve).content"
                style="margin-bottom: 10px; margin-top: 10px"
            />
            <div
                style="margin-top: 10px"
                v-if="
                    JSON.parse(retrieve)?.files?.length > 0 && !isPressRelease
                "
            >
                <a-button
                    style="margin-bottom: 5px"
                    type="primary"
                    ghost
                    icon="file-pdf"
                    @click="openLink(file)"
                    v-for="(file, idx) in removeDuplicate(
                        JSON.parse(retrieve).files
                    )"
                    :key="idx"
                >
                    {{ file.name }}
                </a-button>
            </div>
            <div v-if="isPressRelease">
                <div
                    style="
                        font-size: 14px;
                        font-weight: bold;
                        letter-spacing: 1px;
                    "
                >
                    Daftar Foto, Gambar dan Peta
                </div>
                <div v-if="JSON.parse(retrieve)?.thumbnails?.length > 0">
                    <a-row
                        v-for="(file, idx) in removeDuplicate(
                            JSON.parse(retrieve).thumbnails
                        )"
                        :key="idx"
                        style="
                            margin-top: 10px;
                            border-top: 1px solid #e8e8e8;
                            padding-top: 10px;
                            margin-top: 10px;
                            display: flex;
                            align-items: center;
                        "
                    >
                        <a-col :xs="24" :sm="24" :md="24" :lg="4">
                            <div
                                :style="{
                                    width: '100%',
                                    height: '70px',
                                    cursor: 'pointer',
                                    background: `url('${generateImage(file)}`,
                                    backgroundSize: 'contain',
                                    backgroundRepeat: 'no-repeat',
                                    backgroundPosition: 'center',
                                    margin: 'auto',
                                }"
                                @click="openLink(file)"
                            ></div>
                        </a-col>
                        <a-col :xs="24" :sm="24" :md="24" :lg="20">
                            <div style="margin-bottom: 5px">
                                {{ file.name }}
                            </div>
                            <a-button
                                type="primary"
                                ghost
                                shape="round"
                                @click="openLink(file)"
                            >
                                Download
                            </a-button>
                        </a-col>
                    </a-row>
                </div>
                <div
                    style="margin-top: 10px"
                    v-if="JSON.parse(retrieve)?.maps?.length > 0"
                >
                    <a-row
                        v-for="(file, idx) in removeDuplicate(
                            JSON.parse(retrieve).maps
                        )"
                        :key="idx"
                        style="
                            margin-top: 10px;
                            border-top: 1px solid #e8e8e8;
                            padding-top: 10px;
                            margin-top: 10px;
                            display: flex;
                            align-items: center;
                        "
                    >
                        <a-col :xs="24" :sm="24" :md="24" :lg="4">
                            <div
                                :style="{
                                    width: '100%',
                                    height: '70px',
                                    cursor: 'pointer',
                                    background: `url('${generateImage(file)}`,
                                    backgroundSize: 'contain',
                                    backgroundRepeat: 'no-repeat',
                                    backgroundPosition: 'center',
                                    margin: 'auto',
                                }"
                                @click="openLink(file)"
                            ></div>
                        </a-col>
                        <a-col :xs="24" :sm="24" :md="24" :lg="20">
                            <div style="margin-bottom: 5px">
                                {{ file.name }}
                            </div>
                            <a-button
                                type="primary"
                                ghost
                                shape="round"
                                @click="openLink(file)"
                            >
                                Download
                            </a-button>
                        </a-col>
                    </a-row>
                </div>
                <div
                    style="
                        font-size: 14px;
                        font-weight: bold;
                        letter-spacing: 1px;
                        margin-top: 20px;
                    "
                >
                    Dokumen Press Release
                </div>
                <div
                    style="margin-top: 10px"
                    v-if="JSON.parse(retrieve)?.documents?.length > 0"
                >
                    <a-button
                        style="margin-bottom: 5px"
                        type="primary"
                        ghost
                        icon="file"
                        @click="openLink(file)"
                        v-for="(file, idx) in removeDuplicate(
                            JSON.parse(retrieve).documents
                        )"
                        :key="idx"
                    >
                        {{ file.name }}
                    </a-button>
                </div>
            </div>
            <a-divider />
            <div style="font-size: 14px; margin-bottom: 10px">
                Bagikan postingan ini ke :
            </div>
            <div style="display: flex; align-items: center; gap: 10px">
                <ShareNetwork
                    network="facebook"
                    :url="getUrl()"
                    :title="JSON.parse(retrieve).title"
                    :description="truncString(JSON.parse(retrieve).content)"
                    :quote="JSON.parse(retrieve).title"
                >
                    <a-icon type="facebook" style="font-size: 20px" />
                </ShareNetwork>
                <ShareNetwork
                    network="twitter"
                    :url="getUrl()"
                    :title="JSON.parse(retrieve).title"
                    :description="truncString(JSON.parse(retrieve).content)"
                    :quote="JSON.parse(retrieve).title"
                >
                    <a-icon type="twitter" style="font-size: 20px" />
                </ShareNetwork>
                <ShareNetwork
                    network="whatsapp"
                    :url="getUrl()"
                    :title="JSON.parse(retrieve).title"
                    :description="truncString(JSON.parse(retrieve).content)"
                    :quote="JSON.parse(retrieve).title"
                >
                    <a-icon type="phone" style="font-size: 20px" :rotate="90" />
                </ShareNetwork>
            </div>
        </div>
    </div>
</template>
<script>
import moment from "moment";
import "moment/locale/id";
moment.locale("id");
import Vue from "vue";
import SocialSharing from "vue-social-sharing";
import _ from "lodash";
Vue.use(SocialSharing);
import helper from "../../utils/helper";
export default {
    props: ["retrieve"],
    computed: {
        isPressRelease() {
            return window.location.pathname.indexOf("/press-release") > -1;
        },
        isDataDasar() {
            return window.location.pathname.indexOf("/data-dasar") > -1;
        },
    },
    mounted() {
        console.log(JSON.parse(this.retrieve));
    },
    methods: {
        convertDate(date) {
            return moment(date).format("DD MMM YYYY HH:mm:ss");
        },
        getUrl() {
            return window.location.href;
        },
        truncString(str) {
            return helper.truncString(str, 30, "...");
        },
        openLink(item) {
            window.open(
                `${window.location.origin}/files/${
                    item.id
                }/${encodeURIComponent(item.name)}`
            );
        },
        generateImage(record) {
            return `${window.location.origin}/files/${
                record.id
            }/${encodeURIComponent(record.name)}`;
        },
        removeDuplicate(data) {
            return _.uniqBy(data, function (e) {
                return e.name;
            });
        },
    },
};
</script>
