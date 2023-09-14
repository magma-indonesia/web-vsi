<template>
    <a-form :form="form" @submit="handleVerifyCaptcha" :layout="formLayout">
        <a-form-item label="Email" :hasFeedback="true">
            <a-input
                v-decorator="[
                    'email',
                    {
                        rules: [
                            {
                                type: 'email',
                                message: 'Email tidak valid',
                            },
                            {
                                required: true,
                                message: 'Email wajib diisi!',
                            },
                        ],
                    },
                ]"
            />
        </a-form-item>
        <a-form-item>
            <a-button
                type="primary"
                html-type="submit"
                :block="true"
                :disabled="loading"
            >
                <span v-if="!loading"> Submit </span>
                <span v-else> Mohon tunggu... </span>
            </a-button>
        </a-form-item>
    </a-form>
</template>

<script>
import axios from "axios";
export default {
    props: ["url", "routelogin", "csrf", "geetestid"],
    data() {
        return {
            formLayout: "vertical",
            form: this.$form.createForm(this, { name: "coordinated" }),
            loading: false,
            token: this.csrf,
            geetest: null,
        };
    },
    mounted() {
        this.handleInitCaptcha();
    },
    methods: {
        handleInitCaptcha() {
            const web = this;
            initGeetest4(
                {
                    captchaId: this.geetestid,
                    product: "bind",
                },
                function (captchaObj) {
                    captchaObj
                        .onReady(function () {
                            web.geetest = captchaObj;
                        })
                        .onSuccess(function () {
                            web.handleSubmit();
                        })
                        .onError(function () {
                            console.log("ERROR CAPTCHA");
                        });
                }
            );
        },
        handleVerifyCaptcha(e) {
            e.preventDefault();
            this.geetest.showBox();
        },
        handleSubmit() {
            this.loading = true;
            this.form.validateFields((err, values) => {
                if (!err) {
                    var postData = {
                        ...values,
                        _token: this.token,
                    };

                    axios
                        .post(this.url, postData)
                        .then((res) => {
                            this.loading = false;
                            this.token = res.data.csrf;
                            this.$notification.success({
                                message:
                                    "Kami telah mengirimkan tautan pembaruan password ke email Anda, silahkan cek tautan tersebut.",
                                placement: "bottomRight",
                                duration: 5,
                            });
                        })
                        .catch((error) => {
                            if (error.response.data.csrf) {
                                this.token = error.response.data.csrf;
                                this.loading = false;
                                this.$notification.error({
                                    message: error.response
                                        ? `${error.response.data.message}`
                                        : "Terjadi kesalahan pada sistem, silahkan coba kembali nanti.",
                                    placement: "bottomRight",
                                    duration: 5,
                                });
                            } else {
                                window.location.reload(true);
                            }
                        });
                }
            });
        },
    },
};
</script>
