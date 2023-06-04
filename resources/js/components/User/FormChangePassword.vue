<template>
    <a-form :form="form" @submit="handleSubmit" :layout="formLayout">
        <a-form-item label="New Password" :hasFeedback="true">
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
        <a-form-item label="Confirm Password" :hasFeedback="true">
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
                <span v-if="!loading"> Simpan </span>
                <span v-else> Mohon tunggu... </span>
            </a-button>
            <a-button
                style="margin-top: 10px"
                type="link"
                :block="true"
                @click="handleClose"
            >
                Tutup
            </a-button>
        </a-form-item>
    </a-form>
</template>

<script>
import axios from "axios";

export default {
    props: [
        "apiurl",
        "backurl",
        "retrieve",
    ],
    data() {
        return {
            formLayout: "vertical",
            form: null,
            loading: false,
            isUpdate: false,
        };
    },
    async created() {
        this.form = this.$form.createForm(this, {
            name: "form-change-password",
        });
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
        handleClose() {
            window.location.href = this.backurl;
        },
        handleSubmit(e) {
            this.loading = true;
            e.preventDefault();
            this.form.validateFields(async (err, values) => {
                if (!err) {
                    var postData = {
                        ...values,
                    };

                    let retrieve = await JSON.parse(this.retrieve);
                    postData.id = retrieve.id;
                    axios
                        .put(`${this.apiurl}/dashboard/api/change-password`, postData)
                        .then(() => {
                            this.form.resetFields();
                            this.loading = false;
                            this.handleClose();
                        })
                        .catch(() => {
                            this.loading = false;
                        });
                } else {
                    this.loading = false;
                }
            });
        },
    },
};
</script>
