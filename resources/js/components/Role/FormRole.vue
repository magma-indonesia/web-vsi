<template>
    <a-form :form="form" @submit="handleSubmit" :layout="formLayout">
        <a-form-item label="Nama" :hasFeedback="true">
            <a-input
                v-decorator="[
                    'name',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Nama wajib diisi!',
                            },
                        ],
                    },
                ]"
            />
        </a-form-item>
        <a-form-item label="Slug" :hasFeedback="true">
            <a-input
                v-decorator="[
                    'slug',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Slug wajib diisi!',
                            },
                            {
                                pattern: new RegExp(
                                    '^[a-z]+(-[a-z]+)*$'
                                ),
                                message: 'Slug harus menggunakan huruf kecil dan spasi diganti dengan -. (Contoh: depan-tengah-belakang)',
                            },
                        ],
                    },
                ]"
            />
        </a-form-item>
        <a-form-item label="Deskripsi" :hasFeedback="true">
            <a-input
                v-decorator="[
                    'description',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Deskripsi wajib diisi!',
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
        let retrieve = null;
        if (this.retrieve) {
            retrieve = await JSON.parse(this.retrieve);
            this.isUpdate = true;
        }

        this.form = this.$form.createForm(this, {
            name: "form-role",

            mapPropsToFields: () => {
                return {
                    name: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.name,
                    }),
                    slug: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.slug,
                    }),
                    description: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.description,
                    }),
                };
            },
        });
    },
    methods: {
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

                    if (this.retrieve) {
                        let retrieve = await JSON.parse(this.retrieve);
                        postData.id = retrieve.id;
                        axios
                            .put(`${this.apiurl}/dashboard/api/role`, postData)
                            .then(() => {
                                this.form.resetFields();
                                this.loading = false;
                                this.handleClose();
                            })
                            .catch(() => {
                                this.loading = false;
                            });
                    } else {
                        axios
                            .post(`${this.apiurl}/dashboard/api/role`, postData)
                            .then(() => {
                                this.form.resetFields();
                                this.loading = false;
                                this.handleClose();
                            })
                            .catch(() => {
                                this.loading = false;
                            });
                    }
                } else {
                    this.loading = false;
                }
            });
        },
    },
};
</script>
