<template>
    <div>
        <div v-if="retrieve" style="display: flex; flex-direction: column">
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
            <!-- <img :src="JSON.parse(retrieve).thumbnail" alt="Thumbnail" /> -->
            <div
                v-if="JSON.parse(retrieve)?.news_categories?.length > 0"
                style="display: flex; flex-wrap: wrap; margin-top: 10px"
            >
                <a-tag
                    color="blue-inverse"
                    v-for="(cat, idx) in JSON.parse(retrieve).news_categories"
                    :key="idx"
                >
                    {{ cat.category }}
                </a-tag>
            </div>
            <div
                v-html="JSON.parse(retrieve).content"
                style="margin-bottom: 10px; margin-top: 10px"
            />
            <div
                style="margin-top: 10px"
                v-if="JSON.parse(retrieve)?.news_files?.length > 0"
            >
                <a-button
                    type="link"
                    icon="file-pdf"
                    @click="openLink(file)"
                    v-for="(file, idx) in JSON.parse(retrieve).news_files"
                    :key="idx"
                >
                    {{ file.name }}
                </a-button>
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
Vue.use(SocialSharing);
import helper from "../../utils/helper";
export default {
    props: ["retrieve"],
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
            window.open(`/files/${item.id}/${item.name}`);
        },
    },
};
</script>
