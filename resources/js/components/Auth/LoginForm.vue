<template>
    <a-tabs default-active-key="1">
        <a-tab-pane key="1" tab="Guest">
            <login-form-guest
                :url="url"
                :csrf="csrf"
                :routeforget="routeforget"
            ></login-form-guest>
        </a-tab-pane>
        <a-tab-pane key="2" tab="Non-Guest" force-render>
            <login-form-nip
                :url="url"
                :csrf="csrf"
                :routeforget="routeforget"
            ></login-form-nip>
        </a-tab-pane>
    </a-tabs>
</template>

<script>
import LoginFormGuest from "./LoginFormGuest.vue";
import LoginFormNip from "./LoginFormNip.vue";
export default {
    components: { LoginFormGuest, LoginFormNip },
    props: ["url", "csrf", "routeforget"],
    data() {
        return {};
    },
};
</script>
