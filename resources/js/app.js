/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";
import Vue from "vue";
import Antd, { notification } from "ant-design-vue";
import axios from "axios";
Vue.use(Antd);
window.Vue = require("vue");

export let navbarSubject = new Vue();
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */
Vue.component("navigation-bar-layanan", require("./components/Auth/ChildComponentContact/NavbarSubject.vue").default)

Vue.component("login-form", require("./components/Auth/LoginForm.vue").default);
Vue.component(
    "register-form",
    require("./components/Auth/RegisterForm.vue").default
);
Vue.component(
    "forgot-form",
    require("./components/Auth/ForgotForm.vue").default
);
Vue.component("reset-form", require("./components/Auth/ResetForm.vue").default);
Vue.component(
    "contact-form",
    require("./components/Auth/ContactForm.vue").default
);
Vue.component(
    "table-contact",
    require("./components/Contact/TableContact.vue").default
);
Vue.component("table-news", require("./components/News/TableNews.vue").default);
Vue.component("form-news", require("./components/News/FormNews.vue").default);
Vue.component(
    "table-press-release",
    require("./components/PressRelease/TablePressRelease.vue").default
);
Vue.component(
    "form-press-release",
    require("./components/PressRelease/FormPressRelease.vue").default
);
Vue.component("news", require("./components/News/News.vue").default);
Vue.component(
    "news-detail",
    require("./components/News/NewsDetail.vue").default
);
Vue.component(
    "status-gunung",
    require("./components/News/StatusGunung.vue").default
);
Vue.component(
    "table-ground-movement",
    require("./components/GroundMovement/TableGroundMovement.vue").default
);
Vue.component(
    "form-ground-movement",
    require("./components/GroundMovement/FormGroundMovement.vue").default
);
Vue.component(
    "ground-movement",
    require("./components/GroundMovement/GroundMovement.vue").default
);
Vue.component(
    "ground-movement-detail",
    require("./components/GroundMovement/GroundMovementDetail.vue").default
);
Vue.component(
    "form-profile",
    require("./components/Profile/FormProfile.vue").default
);
Vue.component(
    "profile-detail",
    require("./components/Profile/ProfileDetail.vue").default
);
Vue.component("table-user", require("./components/User/TableUser.vue").default);
Vue.component("form-user", require("./components/User/FormUser.vue").default);

// Yang akan saya kerjakan untuk dibuatkan responsive
Vue.component(
    "table-upload-center",
    require("./components/UploadCenter/TableUploadCenter.vue").default
);
Vue.component(
    "table-upload-center-employee",
    require("./components/UploadCenter/TableEmployee.vue").default
);
Vue.component(
    "card-upload-center-employee",
    require("./components/UploadCenter/CardEmployee.vue").default
);
Vue.component(
    "form-upload-center",
    require("./components/UploadCenter/FormUploadCenter.vue").default
);
// Yang akan saya kerjakan untuk dibuatkan responsive

Vue.component(
    "result-not-found",
    require("./components/Utils/404.vue").default
);
Vue.component(
    "table-public-service",
    require("./components/PublicService/TablePublicService.vue").default
);
Vue.component(
    "form-public-service",
    require("./components/PublicService/FormPublicService.vue").default
);
Vue.component(
    "public-service",
    require("./components/PublicService/PublicService.vue").default
);
Vue.component(
    "public-service-detail",
    require("./components/PublicService/PublicServiceDetail.vue").default
);
Vue.component("table-role", require("./components/Role/TableRole.vue").default);
Vue.component("form-role", require("./components/Role/FormRole.vue").default);
Vue.component(
    "form-role-policy",
    require("./components/Role/FormRolePolicy.vue").default
);
Vue.component(
    "form-change-password",
    require("./components/User/FormChangePassword.vue").default
);
Vue.component("banner", require("./components/Utils/Banner.vue").default);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

/**
 * Axios interceptor response handle
 */
axios.interceptors.response.use(
    (response) => {
        if (response?.config?.method !== "get") {
            if (response?.data?.message) {
                notification.success({
                    message: response.data.message,
                    placement: "bottomRight",
                    duration: 5,
                });
            }
        }
        return response;
    },
    (error) => {
        if (error.response) {
            notification.error({
                message: error.response
                    ? `${error.response.data.message}`
                    : "Something wrong with our server, please try again later.",
                placement: "bottomRight",
                duration: 5,
            });
        }
        return Promise.reject(error);
    }
);
new Vue({
    el: "#app",
});
