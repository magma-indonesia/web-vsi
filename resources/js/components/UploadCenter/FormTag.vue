<template>
    <a-form :form="form" @submit="handleSubmit" :layout="formLayout">
        <a-form-item label="Ketik tag" :hasFeedback="true">
            <a-input
                v-decorator="[
                    'tag',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Tag wajib diisi!',
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
                <span v-if="!loading"> Submit </span>
                <span v-else> Mohon tunggu... </span>
            </a-button>
        </a-form-item>
    </a-form>
</template>

<script>
import axios from "axios";
export default {
    props: ["apiurl", "pressrelease"],
    data() {
        return {
            formLayout: "vertical",
            form: this.$form.createForm(this, { name: "coordinated" }),
            loading: false,
        };
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();
            this.loading = true;
            this.form.validateFields((err, values) => {
                if (!err) {
                    axios
                        .post(
                            `${this.apiurl}/dashboard/api/upload-center/tags`,
                            { ...values, is_press_release: this.pressrelease }
                        )
                        .then(() => {
                            this.loading = false;
                            this.form.resetFields();
                            this.$emit("close");
                        })
                        .catch(() => {
                            this.loading = false;
                        });
                }
            });
        },
    },
};
</script>
