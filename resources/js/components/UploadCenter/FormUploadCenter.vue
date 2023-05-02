<template>
    <a-form :form="form" @submit="handleSubmit" :layout="formLayout">
        <a-form-item label="Label" :hasFeedback="true">
            <!-- <a-input
                v-decorator="[
                    'label',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Label wajib diisi!',
                            },
                        ],
                    },
                ]"
            /> -->
            <!-- <a-auto-complete
                :data-source="labelReference"
                placeholder=""
                :filter-option="handleAutocomplete"
                v-decorator="[
                    'label',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Label wajib diisi!',
                            },
                        ],
                    },
                ]"
            /> -->
            <a-select
                mode="tags"
                style="width: 100%"
                placeholder=""
                @change="handleTags"
                v-decorator="[
                    'tags',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Label wajib diisi!',
                            },
                        ],
                    },
                ]"
            >
                <a-select-option v-for="item in tags" :key="item">
                    {{ item }}
                </a-select-option>
            </a-select>
        </a-form-item>
        <a-form-item>
            <div style="display: flex; flex-direction: column;">
                <span>Tipe File</span>
                <a-select
                    style="
                        width: 120px;
                        margin-top: 10px;
                        margin-bottom: 10px;
                    "
                    :value="ext"
                    @change="handleChange"
                >
                    <a-select-option value=".doc, .docx, .xlx, .xlxs, .pdf, .zip, .rar, .7zip, image/*, .shp">All</a-select-option>
                    <a-select-option value=".pdf">PDF</a-select-option>
                    <a-select-option value=".doc, .docx">Word</a-select-option>
                    <a-select-option value=".xlx, .xlxs">Excel</a-select-option>
                    <a-select-option value=".zip, .rar, .7zip">Archive</a-select-option>
                    <a-select-option value="image/*">Image</a-select-option>
                    <a-select-option value=".shp">Shape File</a-select-option>
                </a-select>
                <a-upload
                    :accept="ext"
                    :file-list="files"
                    :remove="handleRemove"
                    :before-upload="beforeUpload"
                    :multiple="true"
                >
                    <a-button icon="upload">
                        Select File
                    </a-button>
                </a-upload>
            </div>
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
    ],
    data() {
        return {
            formLayout: "vertical",
            form: null,
            loading: false,
            files: [],
            tags: [],
            ext: ".doc, .docx, .xlx, .xlxs, .pdf, .zip, .rar, .7zip, image/*, .shp",
        };
    },
    async created() {
        this.form = this.$form.createForm(this, {
            name: "form-upload-center",
        });
    },
    mounted() {
        this.getTags();
    },
    methods: {
        getTags() {
            this.loading = true;
            axios
                .get(`${this.apiurl}/dashboard/api/upload-center/tags`)
                .then(async (data) => {
                    this.loading = false;
                    this.tags = data?.data?.serve;
                })
                .catch(() => {
                    this.loading = false;
                });
        },
        beforeUpload(file) {
            this.files = [...this.files, file];
            return false;
        },
        handleRemove(file) {
            const index = this.files.indexOf(file);
            const newFile = this.files.slice();
            newFile.splice(index, 1);
            this.files = newFile;
        },
        handleAutocomplete(input, option) {
            return option.componentOptions.children[0].text.toUpperCase().indexOf(input.toUpperCase()) >= 0;
        },
        handleChange(val) {
            this.ext = val;
        },
        handleTags(val) {
            console.log(`selected ${val}`);
        },
        handleClose() {
            window.close('','_parent','');
        },
        handleSubmit(e) {
            this.loading = true;
            e.preventDefault();
            this.form.validateFields(async (err, values) => {
                if (!err) {
                    const postData = new FormData();
                    this.files.forEach(file => {
                        postData.append('files[]', file);
                    });
                    postData.append('tags', values.tags);
                    axios
                        .post(`${this.apiurl}/dashboard/api/upload-center`, postData)
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