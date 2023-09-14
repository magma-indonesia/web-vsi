<template>
    <div class="dropdown dropdown-message notification-badge">
        <a @click="handleOpenDrawer" href="" class="dropdown-link new-indicator" data-toggle="dropdown">
            <i data-feather="bell"></i>
            <span>{{ totalNotification }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right notif-container">
            <div class="dropdown-header">New Messages</div>
            <a href="#" class="dropdown-item" v-for="(notification, index) in notifications" :key="index">
                <div class="media">
                    <div class="avatar avatar-sm avatar-online"><img src="https://placehold.co/350" class="rounded-circle" alt=""></div>
                    <div class="media-body mg-l-15">
                        <strong>{{ notification.name }}</strong>
                        <p>{{ notification.subject }}</p>
                        <span>{{ handleFormatDate(notification.created_at) }}</span>
                    </div>
                </div>
            </a>

            <div v-if="notifications.length === 0">
                <div class="media">
                    <div class="media-body mg-l-15">
                        <strong>No Message Available</strong>
                    </div>
                </div>
            </div>
            <div class="dropdown-footer"><a :href="this.messageurl">View all Messages</a></div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import moment from "moment";

export default {
    props: ["url", "messageurl"],
    methods: {
        fetchData() {
            axios
                .get(`${this.url}/dashboard/api/public-services/messages/notifications`)
                .then(async (data) => {
                    this.notifications = data?.data?.serve;
                    this.totalNotification = this.notifications.length;
                });
        },
        handleOpenDrawer() {
            this.fetchData();
        },
        handleClickItem() {
        },
        handleFormatDate(date) {
            return moment(date).format('DD MMM YYYY HH:mm');
        }
    },
    data() {
        return {
            notifications: [],
            totalNotification: 0
        }
    },
    mounted() {
        this.fetchData();
    },
}
</script>

<style scoped>
.notification-badge {
    position: relative;
    display: inline-block;
    border-right: 1px solid rgba(72, 94, 144, 0.16) !important;
    padding-right: 10px;
    margin-right: 10px;
}
.notif-container {
    max-height: 500px;
    overflow-y: auto;
}
</style>
