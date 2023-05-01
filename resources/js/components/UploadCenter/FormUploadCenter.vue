<template>
    <a-form :form="form" @submit="handleSubmit" :layout="formLayout">
        <a-form-item>
            <a-upload
                accept=".doc, .docx, .xlx, .xlxs, .pdf, .zip, .rar, .7zip"
                :file-list="files"
                :remove="handleRemove"
                :before-upload="beforeUpload"
                :multiple="true"
            >
                <a-button icon="upload">
                    Select File
                </a-button>
            </a-upload>
        </a-form-item>
        <a-form-item label="Label" :hasFeedback="true">
            <a-input
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
            />
            <!-- <a-auto-complete
                :value="label"
                :options="labelReference"
                placeholder="Input here"
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
            labelReference: [
                {
                    value: "Gunung Api"
                },
                {
                    value: "Gerakan Tanah"
                }
            ]
        };
    },
    async created() {
        this.form = this.$form.createForm(this, {
            name: "form-upload-center",
        });
    },
    methods: {
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
            console.log(option);
            return option.value.toUpperCase().indexOf(input.toUpperCase()) >= 0;
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
                    postData.append('label', values.label);
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