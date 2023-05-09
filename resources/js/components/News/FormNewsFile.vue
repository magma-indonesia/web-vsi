<template>
    <a-form :form="form" @submit="handleSubmit" :layout="formLayout">
        <a-form-item label="Label" :hasFeedback="true">
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
            <div style="display: flex; flex-direction: column">
                <a-upload
                    :accept="ext"
                    :file-list="files"
                    :remove="handleRemove"
                    :before-upload="beforeUpload"
                    :multiple="true"
                    @preview="handlePreview"
                >
                    <a-button icon="upload"> Select File </a-button>
                </a-upload>
                <a-modal
                    width="70%"
                    :visible="previewVisible"
                    :footer="null"
                    @cancel="handleCancelPreview"
                >
                    <img
                        v-if="previewType == 'image'"
                        alt="example"
                        style="width: 100%"
                        :src="previewSrc"
                    />
                    <iframe
                        v-else
                        :src="previewSrc"
                        style="width: 100%; height: 460px"
                        frameborder="0"
                        type="video/mp4"
                    ></iframe>
                </a-modal>
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
    props: ["apiurl"],
    data() {
        return {
            formLayout: "vertical",
            form: null,
            loading: false,
            files: [],
            tags: [],
            ext: ".pdf",
            previewVisible: false,
            previewSrc: "",
            previewType: "image",
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
                .get(
                    `${window.location.origin}/dashboard/api/upload-center/tags`
                )
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
            return (
                option.componentOptions.children[0].text
                    .toUpperCase()
                    .indexOf(input.toUpperCase()) >= 0
            );
        },
        handleChange(val) {
            this.ext = val;
        },
        handleTags(val) {
            // console.log(`selected ${val}`);
        },
        getBase64(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => resolve(reader.result);
                reader.onerror = (error) => reject(error);
            });
        },
        async handlePreview(file) {
            if (
                /*file.type == "video/mp4" || */ file.type == "application/pdf"
            ) {
                this.previewType = "iframe";
                this.previewSrc = (await this.getBase64(file)) + "#toolbar=0";
                this.previewVisible = true;
            } else if (file.type.indexOf("image") !== -1) {
                this.previewType = "image";
                this.previewSrc = await this.getBase64(file);
                this.previewVisible = true;
            }
        },
        handleCancelPreview() {
            this.previewVisible = false;
        },
        handleClose(res) {
            this.$emit("close", res);
        },
        handleSubmit(e) {
            this.loading = true;
            e.preventDefault();
            this.form.validateFields(async (err, values) => {
                if (!err) {
                    const postData = new FormData();
                    this.files.forEach((file) => {
                        postData.append("files[]", file);
                    });
                    postData.append("tags", values.tags);
                    axios
                        .post(
                            `${window.location.origin}/dashboard/api/upload-center`,
                            postData
                        )
                        .then((res) => {
                            this.form.resetFields();
                            this.loading = false;
                            this.handleClose(res.data.serve);
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
