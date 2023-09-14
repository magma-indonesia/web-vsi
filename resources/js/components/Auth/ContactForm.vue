<template>
    <a-form :form="form" @submit="handleVerifyCaptcha" :layout="formLayout">
        <a-row :gutter="[12, 12]">
            <a-col :xs="24" :sm="24" :md="24" :lg="12">
                <a-form-item :hasFeedback="true">
                    <a-input placeholder="Nama lengkap" v-decorator="[
                        'name',
                        {
                            rules: [
                                {
                                    required: true,
                                    message: 'Nama wajib diisi!',
                                },
                            ],
                        },
                    ]" />
                </a-form-item>
            </a-col>
            <a-col :xs="24" :sm="24" :md="24" :lg="12">
                <a-form-item :hasFeedback="true">
                    <a-input placeholder="Email" v-decorator="[
                        'email',
                        {
                            rules: [
                                {
                                    required: true,
                                    message: 'Email wajib diisi!',
                                },
                                {
                                    type: 'email',
                                    message: 'Email tidak valid!',
                                },
                            ],
                        },
                    ]" />
                </a-form-item>
            </a-col>
        </a-row>
        <a-form-item :hasFeedback="true">
            <template>
                <div>
                    <!-- <a-select v-if="subject !== 'Lainnya'" v-model="subject" @change="handleSubjectChange">
                        <a-select-option value="Permohonan Data dan Informasi">Permohonan Data dan
                            Informasi</a-select-option>
                        <a-select-option value="Permohonan Narasumber">Permohonan Narasumber</a-select-option>
                        <a-select-option value="Permohonan Integrasi Data">Permohonan Integrasi Data</a-select-option>
                        <a-select-option value="Pelayanan Bimbingan">Pelayanan Bimbingan</a-select-option>
                        <a-select-option value="Lainnya">Lainnya</a-select-option>
                    </a-select> -->

                    <a-input placeholder="Subject" v-decorator="[
                        'subject',
                        {
                            initialValue: subject,
                            rules: [
                                {
                                    required: true,
                                    message: 'Subject wajib diisi!',
                                },
                            ],
                        },
                    ]" />

                </div>
            </template>

        </a-form-item>
        <a-form-item>
            <a-textarea v-decorator="['message']" placeholder="Ketik pesan Anda disini" />
        </a-form-item>
        <a-form-item>
            <a-button type="primary" html-type="submit" :block="true" :disabled="loading"
                style="color: #293d50; background: #fee50f">
                <span v-if="!loading"> Submit </span>
                <span v-else> Mohon tunggu... </span>
            </a-button>
        </a-form-item>
    </a-form>
</template>

<script>
import { navbarSubject } from '../../app.js';
import axios from "axios";
export default {
    props: ["apiurl", "csrf", "geetestid"],
    data() {
        return {
            formLayout: "vertical",
            form: this.$form.createForm(this, { name: "coordinated" }),
            loading: false,
            token: this.csrf,
            geetest: null,
            subject: '',

        };
    },
    mounted() {
        navbarSubject.$on('changeSubject', (data) => {
            this.subject = data
        });
        this.handleInitCaptcha();
        this.selectedSubject = this.subject;
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
                        .post(this.apiurl + "/layanan-publik/contact", postData)
                        .then(() => {
                            this.form.resetFields();
                            this.subject = '';
                            this.loading = false;
                        })
                        .catch(() => {
                            this.loading = false;
                        });
                }
            });
        },
        updateSubject: function (updatedSubject) {
            this.subject = updatedSubject
            console.log(this.subject)
        }
    },
};
</script>
