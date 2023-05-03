<template>
    <a-form :form="form" @submit="handleSubmit" :layout="formLayout">
        <div v-if="uploadPercentage==0">
            <a-form-item>
                <!-- <div style="display: flex; flex-direction: column;"> -->
                    <span>Tipe File</span>
                    <a-select
                        style="
                            width: 120px;
                            margin-left: 10px;
                            margin-right: 10px;
                        "
                        :value="ext"
                        @change="handleChange"
                    >
                        <a-select-option value=".doc, .docx, .xlx, .xlxs, .pdf, .zip, .rar, .7zip, image/*, video/mp4, .shp">All</a-select-option>
                        <a-select-option value=".pdf">PDF</a-select-option>
                        <a-select-option value=".doc, .docx">Word</a-select-option>
                        <a-select-option value=".xlx, .xlxs">Excel</a-select-option>
                        <a-select-option value=".zip, .rar, .7zip">Archive</a-select-option>
                        <a-select-option value="image/*">Image</a-select-option>
                        <a-select-option value="video/mp4">Video</a-select-option>
                        <a-select-option value=".shp">Shape File</a-select-option>
                    </a-select>
                    <a-upload
                        :accept="ext"
                        :file-list="files"
                        :remove="handleRemove"
                        :before-upload="beforeUpload"
                        :multiple="true"
                        @preview="handlePreview"
                    >
                        <a-button icon="upload">
                            Select File
                        </a-button>
                    </a-upload>
                    <a-modal
                        width="70%"
                        :visible="previewVisible"
                        :footer="null"
                        @cancel="handleCancelPreview"
                    >
                        <img v-if="previewType == 'image'" alt="example" style="width: 100%" :src="previewSrc" />
                        <iframe v-else :src="previewSrc" style="width: 100%; height: 460px;" frameborder="0" type="video/mp4"></iframe>
                    </a-modal>
                <!-- </div> -->
            </a-form-item>
            
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
                <div style="display: flex; gap: 10px; align-items: center">
                    <a-button
                        type="danger"
                        ghost
                        :block="true"
                        @click="handleClose"
                    >
                        Tutup
                    </a-button>
                    <a-button
                        type="primary"
                        html-type="submit"
                        :block="true"
                        :disabled="loading"
                    >
                        <span v-if="!loading"> Simpan </span>
                        <span v-else> Mohon tunggu... </span>
                    </a-button>
                </div>
            </a-form-item>
        </div>
        <div v-else>
            <a-progress :percent="uploadPercentage" status="active" />
            <a-button
                style="margin-top: 10px"
                type="danger"
                :block="true"
                @click="handleCancel"
            >
                Batal
            </a-button>
        </div>
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
            ext: ".doc, .docx, .xlx, .xlxs, .pdf, .zip, .rar, .7zip, image/*, video/mp4, .shp",
            previewVisible: false,
            previewSrc: '',
            previewType: 'image',
            uploadPercentage: 0,
            onLine: navigator.onLine,
            controller: new AbortController(),
            isCancel: false,
        };
    },
    async created() {
        this.form = this.$form.createForm(this, {
            name: "form-upload-center",
        });
    },
    mounted() {
        this.getTags();
        window.addEventListener('online', this.updateOnlineStatus)
        window.addEventListener('offline', this.updateOnlineStatus)
    },
    beforeDestroy() {
        window.removeEventListener('online', this.updateOnlineStatus)
        window.removeEventListener('offline', this.updateOnlineStatus)
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
            // console.log(`selected ${val}`);
        },
        getBase64(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => resolve(reader.result);
                reader.onerror = error => reject(error);
            });
        },
        async handlePreview(file) {
            if (/*file.type == "video/mp4" || */file.type == "application/pdf") {
                this.previewType = "iframe";
                this.previewSrc = await this.getBase64(file) + "#toolbar=0";
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
        updateOnlineStatus(e) {
            const { type } = e
            this.onLine = type === 'online'
            if (type !== 'online') {
                this.controller.abort();
                this.$notification.error({
                    message: 'Maaf, koneksi terputus!',
                    placement: "bottomRight",
                    duration: 0,
                });
            }
        },
        handleCancel() {
            this.isCancel = true;
            this.loading = false;
            this.uploadPercentage = 0;
            this.controller.abort();
        },
        handleClose() {
            window.close('','_parent','');
        },
        handleSubmit(e) {
            this.loading = true;
            this.isCancel = false;
            this.controller = new AbortController();
            e.preventDefault();
            this.form.validateFields(async (err, values) => {
                if (!err) {
                    const postData = new FormData();
                    this.files.forEach(file => {
                        postData.append('files[]', file);
                    });
                    postData.append('tags', values.tags);
                    axios
                        .post(`${this.apiurl}/dashboard/api/upload-center`, postData,
                            {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                },
                                onUploadProgress: function( progressEvent ) {
                                    this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ) );
                                }.bind(this),
                                signal: this.controller.signal
                            }
                        )
                        .then(() => {
                            this.form.resetFields();
                            this.loading = false;
                            this.handleClose();
                        })
                        .catch((error) => {
                            if (!error.response && !this.isCancel) {
                                this.controller.abort();
                                this.$notification.error({
                                    message: 'Maaf, koneksi terputus!',
                                    placement: "bottomRight",
                                    duration: 0,
                                });
                            }
                            this.loading = false;
                            this.uploadPercentage = 0;
                        });
                } else {
                    this.loading = false;
                }
            });
        },
    },
};
</script>