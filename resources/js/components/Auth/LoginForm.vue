<template>
    <a-form :form="form" @submit="handleSubmit" :layout="formLayout">
        <a-form-item label="Username" :hasFeedback="true">
            <a-input
                v-decorator="[
                    'username',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Username wajib diisi!',
                            },
                        ],
                    },
                ]"
            />
        </a-form-item>
        <a-form-item label="Password" :hasFeedback="true">
            <a-input-password
                v-decorator="[
                    'password',
                    {
                        rules: [
                            {
                                required: true,
                                message: 'Password wajib diisi!',
                            },
                        ],
                    },
                ]"
            />
        </a-form-item>
        <a-form-item>
            <a-button
                size="small"
                type="link"
                :href="routeforget"
                style="float: right"
            >
                Lupa password?
            </a-button>
        </a-form-item>
        <a-form-item>
            <a-button
                type="primary"
                html-type="submit"
                :block="true"
                :disabled="loading"
            >
                <span v-if="!loading"> Login </span>
                <span v-else> Mohon tunggu... </span>
            </a-button>
        </a-form-item>
    </a-form>
</template>

<script>
import axios from "axios";
export default {
    props: ["url", "csrf", "routeforget"],
    data() {
        return {
            formLayout: "vertical",
            form: this.$form.createForm(this, { name: "coordinated" }),
            loading: false,
            token: this.csrf,
        };
    },
    methods: {
        handleSubmit(e) {
            this.loading = true;
            e.preventDefault();
            this.form.validateFields((err, values) => {
                if (!err) {
                    var postData = {
                        ...values,
                        _token: this.token,
                    };

                    axios
                        .post(this.url, postData)
                        .then(() => {
                            this.loading = false;
                            window.location.reload(true);
                        })
                        .catch((error) => {
                            if (error.response.data.csrf) {
                                this.token = error.response.data.csrf;
                                this.loading = false;
                            } else {
                                window.location.reload(true);
                            }
                        });
                }
            });
        },
    },
};
</script>
