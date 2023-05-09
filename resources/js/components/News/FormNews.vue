<template>
    <a-card>
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
            <a-form-item label="Tanggal" :hasFeedback="true">
                <a-input
                    type="datetime-local"
                    v-decorator="[
                        'created_at',
                        {
                            rules: [
                                {
                                    required: true,
                                    message: 'Tanggal wajib diisi!',
                                },
                            ],
                        },
                    ]"
                />
            </a-form-item>
            <a-form-item label="Konten">
                <tiny-mce
                    @change="handleChangeTiny($event)"
                    :value.sync="desc"
                    :apiurl="apiurl"
                ></tiny-mce>
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
            <div
                v-if="category == '1'"
                style="
                    margin-bottom: 10px;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                "
            >
                <a-button type="primary" @click="openModal = true"
                    >Upload PDF</a-button
                >
                <div style="font-size: 12px; font-weight: bold">
                    {{ files.length }} File PDF diupload
                </div>
            </div>
            <a-divider />
            <a-form-item>
                <a-button
                    style="margin-right: 5px"
                    type="danger"
                    ghost
                    @click="handleClose"
                >
                    Tutup
                </a-button>
                <a-button type="primary" html-type="submit" :disabled="loading">
                    <span v-if="!loading"> Simpan </span>
                    <span v-else> Mohon tunggu... </span>
                </a-button>
            </a-form-item>

            <a-modal v-model="openModal" title="Upload PDF" :footer="false">
                <form-news-file
                    @close="handleCloseModalFile"
                    :apiurl="apiurl"
                />
            </a-modal>
        </a-form>
    </a-card>
</template>

<script>
import axios from "axios";
import helper from "../../utils/helper";
import TinyMce from "../Utils/TinyMce.vue";
import FormNewsFile from "./FormNewsFile.vue";
export default {
    components: { TinyMce, FormNewsFile },
    props: ["apiurl", "backurl", "retrieve", "category"],
    data() {
        return {
            formLayout: "vertical",
            form: null,
            loading: false,
            thumbnail: null,
            desc: null,
            openModal: false,
            files: [],
        };
    },
    async created() {
        let retrieve = null;
        if (this.retrieve) {
            retrieve = await JSON.parse(this.retrieve);
        }

        this.thumbnail = retrieve?.thumbnail;
        this.desc = retrieve?.content;
        this.form = this.$form.createForm(this, {
            name: "form-news",

            mapPropsToFields: () => {
                return {
                    title: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.title,
                    }),
                    created_at: this.$form.createFormField({
                        ...retrieve,
                        value: helper.formattedTime(
                            new Date(retrieve?.created_at)
                        ),
                    }),
                };
            },
        });
    },
    methods: {
        handleChangeTiny(e) {
            this.desc = e;
        },
        handleUpload() {
            const input = document.createElement("input");
            input.type = "file";
            input.accept = "image/*";
            input.onchange = (e) => {
                const file = e.target.files[0];
                const fd = new FormData();
                fd.append("file", file);
                axios
                    .post(`${window.location.origin}/api/upload`, fd)
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
        handleCloseModalFile(res) {
            this.files = res;
            this.openModal = false;
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

                    postData.thumbnail = this.thumbnail;
                    postData.desc = this.desc;
                    postData.news_files = this.files;
                    if (this.retrieve) {
                        let retrieve = await JSON.parse(this.retrieve);
                        postData.id = retrieve.id;
                        axios
                            .put(`${this.apiurl}`, postData)
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
                            .post(`${this.apiurl}`, postData)
                            .then(() => {
                                this.form.resetFields();
                                this.loading = false;
                                this.handleClose();
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
