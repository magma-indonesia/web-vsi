<template>
    <a-form :form="form" @submit="handleSubmit" :layout="formLayout">
        <a-form-item label="Judul" :hasFeedback="true">
            <a-input
                v-decorator="[
                    'title',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Judul wajib diisi!',
                            },
                        ],
                    },
                ]"
            />
        </a-form-item>
        <a-form-item label="Deskripsi">
            <a-textarea v-decorator="['desc']" :auto-size="{ minRows: 5 }" />
        </a-form-item>
        <a-form-item label="Waktu" :hasFeedback="true">
            <a-input
                type="datetime-local"
                v-decorator="[
                    'created_at',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Waktu wajib diisi!',
                            },
                        ],
                    },
                ]"
            />
        </a-form-item>
        <a-form-item label="Thumbnail">
            <div v-if="thumbnail" class="d-flex flex-column">
                <img
                    :src="thumbnail"
                    alt="avatar"
                    style="
                        width: 100%;
                        height: 152px;
                        object-fit: contain;
                        margin-bottom: 10px;
                    "
                />
                <a-button
                    type="link"
                    style="color: red"
                    icon="delete"
                    @click="thumbnail = null"
                >
                    Hapus
                </a-button>
            </div>
            <a-button
                v-else
                style="margin-top: 8px; font-size: 12px"
                @click="handleUpload"
            >
                <span v-if="!loading"> Upload Thumbnail </span>
                <span v-else> Mohon tunggu... </span>
            </a-button>
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
        </a-form-item>
    </a-form>
</template>

<script>
import axios from "axios";
import helper from "../../utils/helper";
export default {
    props: ["apiurl", "retrieve", "category"],
    data() {
        return {
            formLayout: "vertical",
            form: null,
            loading: false,
            thumbnail: null,
        };
    },
    created() {
        this.thumbnail = this.retrieve.thumbnail;
        this.form = this.$form.createForm(this, {
            name: "form-volcano",

            mapPropsToFields: () => {
                return {
                    title: this.$form.createFormField({
                        ...this.retrieve,
                        value: this.retrieve?.title,
                    }),
                    desc: this.$form.createFormField({
                        ...this.retrieve,
                        value: this.retrieve?.content,
                    }),
                    created_at: this.$form.createFormField({
                        ...this.retrieve,
                        value: helper.formattedTime(
                            new Date(this.retrieve?.created_at)
                        ),
                    }),
                };
            },
        });
    },
    watch: {
        retrieve: function (val) {
            this.thumbnail = this.retrieve.thumbnail;
            this.form.updateFields({
                title: this.$form.createFormField({
                    ...this.retrieve,
                    value: this.retrieve?.title,
                }),
                desc: this.$form.createFormField({
                    ...this.retrieve,
                    value: this.retrieve?.content,
                }),
                created_at: this.$form.createFormField({
                    ...this.retrieve,
                    value: helper.formattedTime(
                        new Date(this.retrieve?.created_at)
                    ),
                }),
            });
        },
    },
    methods: {
        handleUpload() {
            const input = document.createElement("input");
            input.type = "file";
            input.accept = "image/*";
            input.onchange = (e) => {
                const file = e.target.files[0];
                const fd = new FormData();
                fd.append("file", file);
                axios
                    .post(`${this.apiurl}/api/upload`, fd)
                    .then(async (res) => {
                        this.loading = false;
                        if (res) {
                            this.thumbnail = res.data.serve.url;
                        }
                    })
                    .catch(() => {
                        this.loading = false;
                    });
            };
            input.click();
        },
        handleSubmit(e) {
            this.loading = true;
            e.preventDefault();
            this.form.validateFields((err, values) => {
                if (!err) {
                    var postData = {
                        ...values,
                    };

                    postData.categories = [this.category];
                    postData.thumbnail = this.thumbnail;
                    if (this.retrieve) {
                        postData.id = this.retrieve.id;
                        axios
                            .put(`${this.apiurl}/apis/v1/news`, postData)
                            .then(() => {
                                this.form.resetFields();
                                this.loading = false;
                                this.$emit("close");
                            })
                            .catch(() => {
                                this.loading = false;
                            });
                    } else {
                        axios
                            .post(`${this.apiurl}/apis/v1/news`, postData)
                            .then(() => {
                                this.form.resetFields();
                                this.loading = false;
                                this.$emit("close");
                            })
                            .catch(() => {
                                this.loading = false;
                            });
                    }
                }
            });
        },
    },
};
</script>
