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
            <tiny-mce
                @change="handleChangeTiny($event)"
                :value.sync="description"
                :apiurl="apiurl"
                :type="'desc'"
            ></tiny-mce>
        </a-form-item>
        <!-- <a-form-item label="Waktu" :hasFeedback="true">
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
        </a-form-item> -->
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
import helper from "../../utils/helper";
import TinyMce from "../Utils/TinyMce.vue";

export default {
    components: { TinyMce },
    props: ["apiurl", "backurl", "retrieve", "category"],
    data() {
        return {
            formLayout: "vertical",
            form: null,
            loading: false,
            description: null,
            thumbnail: null,
        };
    },
    async created() {
        let retrieve = null;
        if (this.retrieve) {
            retrieve = await JSON.parse(this.retrieve);
        }

        this.thumbnail = retrieve?.thumbnail;
        this.description = retrieve?.description;
        this.form = this.$form.createForm(this, {
            name: "form-ground-movement",

            mapPropsToFields: () => {
                return {
                    title: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.title,
                    }),
                };
            },
        });
    },
    methods: {
        handleChangeTiny(e) {
            this.description = e;
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
                    .post(`${this.apiurl}/image/upload`, fd)
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

                    postData.category = this.category;
                    postData.thumbnail = this.thumbnail;
                    postData.description = this.description;
                    if (this.retrieve) {
                        let retrieve = await JSON.parse(this.retrieve);
                        postData.id = retrieve.id;
                        axios
                            .put(
                                `${this.apiurl}/dashboard/api/gerakan-tanah`,
                                postData
                            )
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
                            .post(
                                `${this.apiurl}/dashboard/api/gerakan-tanah`,
                                postData
                            )
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
