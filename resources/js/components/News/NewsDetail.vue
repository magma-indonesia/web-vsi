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
                :src="generateThumbnail(JSON.parse(retrieve).thumbnail)"
                alt="Thumbnail"
                style="
                    width: 100%;
                    height: auto;
                    max-height: 500px;
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
                    <iframe       
                        class="myFrame"        
                        :srcdoc="JSON.parse(retrieve).intro? JSON.parse(retrieve).intro : '<p>Belum ada data</p>'"   
                        ref="myIframe"             
                        @load='resizeInitIframe' style="margin-bottom: 10px; margin-top: 10px;height:200px;width:100%;border:none;overflow:hidden;"           
                    />
                </a-tab-pane>
                <a-tab-pane key="2" tab="Sejarah Letusan">
                    <iframe       
                        class="myFrame"        
                        :srcdoc="JSON.parse(retrieve).history? JSON.parse(retrieve).history : '<p>Belum ada data</p>'"                
                        ref="myIframe"             
                        @load='resizeInitIframe' style="margin-bottom: 10px; margin-top: 10px;height:200px;width:100%;border:none;overflow:hidden;"           
                    />
                </a-tab-pane>
                <a-tab-pane key="3" tab="Geologi">
                    <iframe       
                        class="myFrame"        
                        :srcdoc="JSON.parse(retrieve).geology? JSON.parse(retrieve).geology : '<p>Belum ada data</p>'"                
                        ref="myIframe"             
                        @load='resizeInitIframe' style="margin-bottom: 10px; margin-top: 10px;height:200px;width:100%;border:none;overflow:hidden;"           
                    />
                </a-tab-pane>
                <a-tab-pane key="4" tab="Geofisika">
                    <iframe       
                        class="myFrame"        
                        :srcdoc="JSON.parse(retrieve).geophysic? JSON.parse(retrieve).geophysic : '<p>Belum ada data</p>'"                
                        ref="myIframe"             
                        @load='resizeInitIframe' style="margin-bottom: 10px; margin-top: 10px;height:200px;width:100%;border:none;overflow:hidden;"           
                    />
                </a-tab-pane>
                <a-tab-pane key="5" tab="Geokimia">
                    <iframe       
                        class="myFrame"        
                        :srcdoc="JSON.parse(retrieve).geochemistry? JSON.parse(retrieve).geochemistry : '<p>Belum ada data</p>'"                
                        ref="myIframe"             
                        @load='resizeInitIframe' style="margin-bottom: 10px; margin-top: 10px;height:200px;width:100%;border:none;overflow:hidden;"           
                    />
                </a-tab-pane>
                <a-tab-pane key="6" tab="Kawasan Rawan Bencana">
                    <iframe       
                        class="myFrame"        
                        :srcdoc="JSON.parse(retrieve).disaster_area? JSON.parse(retrieve).disaster_area : '<p>Belum ada data</p>'"                
                        ref="myIframe"             
                        @load='resizeInitIframe' style="margin-bottom: 10px; margin-top: 10px;height:200px;width:100%;border:none;overflow:hidden;"           
                    />
                </a-tab-pane>
                <a-tab-pane key="7" tab="Daftar Pustaka">
                    <iframe       
                        class="myFrame"        
                        :srcdoc="JSON.parse(retrieve).reference? JSON.parse(retrieve).reference : '<p>Belum ada data</p>'"                
                        ref="myIframe"             
                        @load='resizeInitIframe' style="margin-bottom: 10px; margin-top: 10px;height:200px;width:100%;border:none;overflow:hidden;"           
                    />
                </a-tab-pane>
            </a-tabs>
            <iframe
                v-else        
                class="myFrame"        
                :srcdoc="JSON.parse(retrieve).content"                
                ref="myIframe"             
                        @load='resizeInitIframe' style="margin-bottom: 10px; margin-top: 10px;height:200px;width:100%;border:none;overflow:hidden;"           
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
                        <a-col :xs="12" :sm="16" :md="16" :lg="4">
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
                        <a-col>
                            <div style="margin-bottom: 5px;">
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
                        <a-col :xs="12" :sm="16" :md="16" :lg="4">
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
                        <a-col>
                            <div style="margin-bottom: 5px;">
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
                    <svg
                        style="width: 20px; height: 20px; color: #042893"
                        xmlns="http://www.w3.org/2000/svg"
                        height="1em"
                        viewBox="0 0 448 512"
                    >
                        <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            fill="#042893"
                            d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"
                        />
                    </svg>
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
        this.$nextTick(() => {
            this.resizeIFrame();
            window.addEventListener('resize', this.resizeIFrame);
        });
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.resizeIFrame);
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
        generateThumbnail(thumb) {
            return this.isPressRelease
                ? thumb
                : window.location.origin +
                      "/storage/" +
                      encodeURIComponent(thumb);
        },
        removeDuplicate(data) {
            return _.uniqBy(data, function (e) {
                return e.name;
            });
        },
        resizeIFrame(){
            var iframe = document.getElementsByClassName("myFrame");      
            for (var i = 0; i < iframe.length; i++) {
                iframe[i].style.height = 50+iframe[i].contentWindow.document.body.scrollHeight + 'px';
            }
        },
        resizeInitIframe() {
            const iframe = this.$refs.myIframe;
            const body = iframe.contentWindow.document.body;
            // console.log(body.style);
            // add css for font family
            body.style.fontFamily = "-apple-system, BlinkMacSystemFont, 'Segoe UI', 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', 'Helvetica Neue', Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'";
            iframe.style.height = `${iframe.contentWindow.document.body.scrollHeight+50}px`;
        },
    },
};
</script>
