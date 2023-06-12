<template>
    <a-form :form="form" @submit="handleSubmit" :layout="formLayout">
        <a-form-item label="Bagian" :hasFeedback="true">
            <a-select
                v-decorator="[
                    'segment_id',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Bagian wajib diisi!',
                            },
                        ],
                    },
                ]"
            >
                <a-select-option v-for="item in segments" :key="item.id" :value="item.id">{{item.pronounce}}</a-select-option>
            </a-select>
        </a-form-item>
        <a-form-item label="NIP" :hasFeedback="true">
            <a-input
                v-decorator="[
                    'nip',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'NIP wajib diisi!',
                            },
                        ],
                    },
                ]"
            />
        </a-form-item>
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
        <a-form-item label="Jabatan" :hasFeedback="true">
            <a-input
                v-decorator="[
                    'position',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Jabatan wajib diisi!',
                            },
                        ],
                    },
                ]"
            />
        </a-form-item>
        <a-form-item label="Golongan" :hasFeedback="true">
            <a-select
                v-decorator="[
                    'group_class',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Golongan wajib diisi!',
                            },
                        ],
                    },
                ]"
            >
                <a-select-option v-for="item in groupclasses" :key="item.id" :value="item.id">{{item.name}}</a-select-option>
            </a-select>
        </a-form-item>
        <a-form-item label="Password" :hasFeedback="true">
            <a-input-password
                v-decorator="[
                    'password',
                    {
                        rules: [
                            {
                                pattern: new RegExp(
                                    '^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,}$'
                                ),
                                message:
                                    'Password harus mengandung setidaknya satu huruf kecil, huruf besar, angka, dan karakter khusus',
                            },
                        ],
                    },
                ]"
            />
        </a-form-item>
        <a-form-item label="Role" :hasFeedback="true">
            <a-select
                v-decorator="[
                    'role_id',
                ]"
            >
                <a-select-option v-for="item in roles" :key="item.id" :value="item.id">{{item.name}}</a-select-option>
            </a-select>
        </a-form-item>
        <a-form-item v-if="isUpdate" label="Status" :hasFeedback="true">
            <a-select
                v-decorator="[
                    'is_active',
                ]"
            >
                <a-select-option value="1">Aktif</a-select-option>
                <a-select-option value="0">Tidak Aktif</a-select-option>
            </a-select>
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

export default {
    props: [
        "apiurl",
        "backurl",
        "retrieve",
        "segments",
        "roles",
        "groupclasses"
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
        if (this.segments) {
            this.segments = await JSON.parse(this.segments);
        }
        if (this.roles) {
            this.roles = await JSON.parse(this.roles);
        }
        if (this.groupclasses) {
            this.groupclasses = await JSON.parse(this.groupclasses);
        }

        let retrieve = null;
        if (this.retrieve) {
            retrieve = await JSON.parse(this.retrieve);
            this.isUpdate = true;
        }

        this.form = this.$form.createForm(this, {
            name: "form-user",

            mapPropsToFields: () => {
                return {
                    segment_id: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.id_segment,
                    }),
                    nip: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.nip,
                    }),
                    name: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.name,
                    }),
                    position: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.position,
                    }),
                    group_class: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.group_class,
                    }),
                    role_id: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.role_id,
                    }),
                    is_active: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.is_active ? '1' : '0',
                    }),
                };
            },
        });
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

                    if (this.retrieve) {
                        let retrieve = await JSON.parse(this.retrieve);
                        postData.id = retrieve.id;
                        axios
                            .put(`${this.apiurl}/dashboard/api/pegawai`, postData)
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
                            .post(`${this.apiurl}/dashboard/api/pegawai`, postData)
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
