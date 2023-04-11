<template>
    <a-form :form="form" @submit="handleVerifyCaptcha" :layout="formLayout">
        <a-row :gutter="[12, 12]">
            <a-col
                class="gutter-row"
                :xs="24"
                :sm="24"
                :md="24"
                :lg="8"
                :xl="8"
            >
                <a-form-item label="Gelar depan">
                    <a-input v-decorator="['first_degree']" />
                </a-form-item>
            </a-col>
            <a-col
                class="gutter-row"
                :xs="24"
                :sm="24"
                :md="24"
                :lg="16"
                :xl="16"
            >
                <a-form-item label="Nama depan" :hasFeedback="true">
                    <a-input
                        v-decorator="[
                            'first_name',
                            {
                                rules: [
                                    {
                                        required: true,
                                        message: 'Nama depan wajib diisi!',
                                    },
                                ],
                            },
                        ]"
                    />
                </a-form-item>
            </a-col>
            <a-col
                class="gutter-row"
                :xs="24"
                :sm="24"
                :md="24"
                :lg="16"
                :xl="16"
            >
                <a-form-item label="Nama belakang">
                    <a-input v-decorator="['last_name']" />
                </a-form-item>
            </a-col>
            <a-col
                class="gutter-row"
                :xs="24"
                :sm="24"
                :md="24"
                :lg="8"
                :xl="8"
            >
                <a-form-item label="Gelar belakang">
                    <a-input v-decorator="['last_degree']" />
                </a-form-item>
            </a-col>
            <a-col
                class="gutter-row"
                :xs="24"
                :sm="24"
                :md="24"
                :lg="24"
                :xl="24"
            >
                <a-form-item label="Jenis kelamin">
                    <a-radio-group
                        v-decorator="['gender']"
                        button-style="solid"
                    >
                        <a-radio-button value="Laki-laki"
                            >Laki-laki</a-radio-button
                        >
                        <a-radio-button value="Perempuan"
                            >Perempuan</a-radio-button
                        >
                    </a-radio-group>
                </a-form-item>
            </a-col>
            <a-col
                class="gutter-row"
                :xs="24"
                :sm="24"
                :md="24"
                :lg="24"
                :xl="24"
            >
                <a-form-item label="Agama">
                    <a-select v-decorator="['agama']" button-style="solid">
                        <a-select-option value="Islam">Islam</a-select-option>
                        <a-select-option value="Kristen"
                            >Kristen</a-select-option
                        >
                        <a-select-option value="Katolik"
                            >Katolik</a-select-option
                        >
                        <a-select-option value="Hindu">Hindu</a-select-option>
                        <a-select-option value="Budha">Budha</a-select-option>
                        <a-select-option value="Konghucu"
                            >Konghucu</a-select-option
                        >
                        <a-select-option value="Lainnya"
                            >Lainnya</a-select-option
                        >
                    </a-select>
                </a-form-item>
            </a-col>
            <a-col
                class="gutter-row"
                :xs="24"
                :sm="24"
                :md="24"
                :lg="24"
                :xl="24"
            >
                <a-form-item label="Institusi" :hasFeedback="true">
                    <a-input
                        v-decorator="[
                            'institution',
                            {
                                rules: [
                                    {
                                        required: true,
                                        message: 'Institusi wajib diisi!',
                                    },
                                ],
                            },
                        ]"
                    ></a-input>
                </a-form-item>
            </a-col>
        </a-row>
        <a-divider></a-divider>
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
                <span v-if="!loading"> Daftar Sekarang </span>
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
                        _token: this.token,
                    };

                    axios
                        .post(this.url, postData)
                        .then((res) => {
                            this.loading = false;
                            this.token = res.data.csrf;
                            this.$notification.success({
                                message:
                                    "Daftar akun berhasil, silahkan lakukan login.",
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
                                window.location.reload(true);
                            }
                        });
                }
            });
        },
    },
};
</script>
