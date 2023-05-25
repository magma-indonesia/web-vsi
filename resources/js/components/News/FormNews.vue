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
            <div v-if="category == '1'">
                <a-button-group>
                    <a-button
                        :type="tabKey == '1' ? 'primary' : 'text'"
                        @click="tabKey = '1'"
                    >
                        Intro
                    </a-button>
                    <a-button
                        :type="tabKey == '2' ? 'primary' : 'text'"
                        @click="tabKey = '2'"
                    >
                        Sejarah Letusan</a-button
                    >
                    <a-button
                        :type="tabKey == '3' ? 'primary' : 'text'"
                        @click="tabKey = '3'"
                    >
                        Geologi
                    </a-button>
                    <a-button
                        :type="tabKey == '4' ? 'primary' : 'text'"
                        @click="tabKey = '4'"
                    >
                        Geofisika
                    </a-button>
                    <a-button
                        :type="tabKey == '5' ? 'primary' : 'text'"
                        @click="tabKey = '5'"
                    >
                        Geokimia
                    </a-button>
                    <a-button
                        :type="tabKey == '6' ? 'primary' : 'text'"
                        @click="tabKey = '6'"
                    >
                        Kawasan Rawan Bencana
                    </a-button>
                    <a-button
                        :type="tabKey == '7' ? 'primary' : 'text'"
                        @click="tabKey = '7'"
                    >
                        Daftar Pustaka
                    </a-button>
                </a-button-group>
                <a-divider />
                <div v-show="tabKey == '1'">
                    <a-form-item label="Konten">
                        <tiny-mce
                            @change="handleChangeTiny($event, 'intro')"
                            :value.sync="intro"
                            :apiurl="apiurl"
                            :type="'intro'"
                            :key="'intro'"
                        ></tiny-mce>
                    </a-form-item>
                </div>
                <div v-show="tabKey == '2'">
                    <a-form-item label="Konten">
                        <tiny-mce
                            @change="handleChangeTiny($event, 'history')"
                            :value.sync="history"
                            :apiurl="apiurl"
                            :type="'history'"
                            :key="'history'"
                        ></tiny-mce>
                    </a-form-item>
                </div>
                <div v-show="tabKey == '3'">
                    <a-form-item label="Konten">
                        <tiny-mce
                            @change="handleChangeTiny($event, 'geology')"
                            :value.sync="geology"
                            :apiurl="apiurl"
                            :type="'geology'"
                            :key="'geology'"
                        ></tiny-mce>
                    </a-form-item>
                </div>
                <div v-show="tabKey == '4'">
                    <a-form-item label="Konten">
                        <tiny-mce
                            @change="handleChangeTiny($event, 'geophysic')"
                            :value.sync="geophysic"
                            :apiurl="apiurl"
                            :type="'geophysic'"
                            :key="'geophysic'"
                        ></tiny-mce>
                    </a-form-item>
                </div>
                <div v-show="tabKey == '5'">
                    <a-form-item label="Konten">
                        <tiny-mce
                            @change="handleChangeTiny($event, 'geochemistry')"
                            :value.sync="geochemistry"
                            :apiurl="apiurl"
                            :type="'geochemistry'"
                            :key="'geochemistry'"
                        ></tiny-mce>
                    </a-form-item>
                </div>
                <div v-show="tabKey == '6'">
                    <a-form-item label="Konten">
                        <tiny-mce
                            @change="handleChangeTiny($event, 'disaster_area')"
                            :value.sync="disaster_area"
                            :apiurl="apiurl"
                            :type="'disaster_area'"
                            :key="'disaster_area'"
                        ></tiny-mce>
                    </a-form-item>
                </div>
                <div v-show="tabKey == '7'">
                    <a-form-item label="Konten">
                        <tiny-mce
                            @change="handleChangeTiny($event, 'reference')"
                            :value.sync="reference"
                            :apiurl="apiurl"
                            :type="'reference'"
                            :key="'reference'"
                        ></tiny-mce>
                    </a-form-item>
                </div>
            </div>
            <a-form-item label="Konten" v-else>
                <tiny-mce
                    @change="handleChangeTiny($event)"
                    :value.sync="desc"
                    :apiurl="apiurl"
                    :type="'desc'"
                    :key="'desc'"
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
                    margin-bottom: 20px;
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

            <a-form-item
                v-if="category == '1'"
                label="Apakah Data Dasar akan dipublikasikan langsung?"
            >
                <a-radio-group v-decorator="['status']">
                    <a-radio value="1">Ya, segera publikasikan</a-radio>
                    <a-radio value="0">Tidak, simpan sebagai draft</a-radio>
                </a-radio-group>
            </a-form-item>

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
            intro: null,
            history: null,
            geology: null,
            geophysic: null,
            geochemistry: null,
            disaster_area: null,
            reference: null,
            openModal: false,
            files: [],
            tabKey: "1",
        };
    },
    async created() {
        let retrieve = null;
        if (this.retrieve) {
            retrieve = await JSON.parse(this.retrieve);
        }

        this.thumbnail = retrieve?.thumbnail;
        if (this.category == "1") {
            this.intro = retrieve?.intro;
            this.history = retrieve?.history;
            this.geology = retrieve?.geology;
            this.geophysic = retrieve?.geophysic;
            this.geochemistry = retrieve?.geochemistry;
            this.disaster_area = retrieve?.disaster_area;
            this.reference = retrieve?.reference;
        } else {
            this.desc = retrieve?.content;
        }

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
                    status: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.status?.toString(),
                    }),
                };
            },
        });
    },
    methods: {
        callback(e) {
            this.tabKey = e;
        },
        handleChangeTiny(e, type) {
            this[type] = e;
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
                    if (this.category == "1") {
                        postData.intro = this.intro;
                        postData.history = this.history;
                        postData.geology = this.geology;
                        postData.geophysic = this.geophysic;
                        postData.geochemistry = this.geochemistry;
                        postData.disaster_area = this.disaster_area;
                        postData.reference = this.reference;
                    } else {
                        postData.desc = this.desc;
                    }
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
