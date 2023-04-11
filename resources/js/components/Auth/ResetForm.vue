<template>
    <a-form :form="form" @submit="handleVerifyCaptcha" :layout="formLayout">
        <a-form-item label="Email" :hasFeedback="true">
            <a-input
                disabled
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
        <a-form-item label="Password" :hasFeedback="true">
            <a-input-password
                v-decorator="[
                    'password',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Password wajib diisi!',
                            },
                            {
                                pattern: new RegExp(
                                    '^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,}$'
                                ),
                                message:
                                    'Password harus mengandung setidaknya satu huruf kecil, huruf besar, angka, dan karakter khusus',
                            },
                            {
                                validator: validateToNextPassword,
                            },
                        ],
                    },
                ]"
            />
        </a-form-item>
        <a-form-item label="Konfirmasi password" :hasFeedback="true">
            <a-input-password
                v-decorator="[
                    'password_confirmation',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Konfirmasi password wajib diisi!',
                            },
                            {
                                pattern: new RegExp(
                                    '^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,}$'
                                ),
                                message:
                                    'Password harus mengandung setidaknya satu huruf kecil, huruf besar, angka, dan karakter khusus',
                            },
                            {
                                validator: compareToFirstPassword,
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
                <span v-if="!loading">Submit</span>
                <span v-else> Mohon tunggu... </span>
            </a-button>
        </a-form-item>
    </a-form>
</template>

<script>
import axios from "axios";
export default {
    props: ["url", "routelogin", "csrf", "geetestid", "tokenchange", "email"],
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
        this.form.setFieldsValue({
            email: new URLSearchParams(window.location.search).get("email"),
        });
        this.handleInitCaptcha();
    },
    methods: {
        compareToFirstPassword(rule, value, callback) {
            const form = this.form;
            if (value && value !== form.getFieldValue("password")) {
                callback("Password yang Anda masukkan tidak konsisten");
            } else {
                callback();
            }
        },
        validateToNextPassword(rule, value, callback) {
            const form = this.form;
            if (value && this.confirmDirty) {
                form.validateFields(["password_confirmation"], { force: true });
            }
            callback();
        },
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
                        token: this.tokenchange,
                        _token: this.token,
                    };

                    axios
                        .post(this.url, postData)
                        .then((res) => {
                            this.loading = false;
                            this.token = res.data.csrf;
                            this.$notification.success({
                                message:
                                    "Password berhasil diganti, silahkan login kembali.",
                                placement: "bottomRight",
                                duration: 5,
                            });
                            setTimeout(() => {
                                window.location.href = this.routelogin;
                            }, 1000);
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
                                //window.location.reload(true);
                            }
                        });
                }
            });
        },
    },
};
</script>
