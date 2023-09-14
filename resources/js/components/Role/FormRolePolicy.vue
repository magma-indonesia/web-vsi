<template>
    <a-form :form="form" @submit="handleSubmit" :layout="formLayout">
        <a-form-item :label="`Menu Policy - ${data.description}`" :hasFeedback="false">
            <a-checkbox-group
                v-decorator="[
                    'policies',
                ]"
                style="width: 100%"
            >
                <a-row v-for="(item, index) in policies" :key="index">
                    <a-col>
                        <a-checkbox :value="item.value" @change="handleCheckboxChange">{{ item.label }}</a-checkbox>
                    </a-col>
                </a-row>
            </a-checkbox-group>
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
        "backurl",
        "retrieve",
        "policy",
        "defaultpolicy"
    ],
    data() {
        return {
            formLayout: "vertical",
            form: null,
            loading: false,
            isUpdate: false,
            data: null,
            policies: [],
            valuePolicy: [],
        };
    },
    async created() {
        if (this.policy) {
            this.policies = await JSON.parse(this.policy);
        }
        if (this.defaultpolicy) {
            this.valuePolicy = await JSON.parse(this.defaultpolicy);
        }
        if (this.retrieve) {
            this.data = await JSON.parse(this.retrieve);
            this.isUpdate = true;
        }

        this.form = this.$form.createForm(this, {
            name: "form-role-policy",
            mapPropsToFields: () => {
                return {
                    policies: this.$form.createFormField({
                        ...this.data,
                        value: this.valuePolicy,
                    }),
                };
            },
        });
    },
    methods: {
        handleClose() {
            window.location.href = this.backurl;
        },
        handleCheckboxChange(e) {
            if (e.target.checked) {
                this.valuePolicy.push(e.target.value);
            } else {
                this.valuePolicy.splice(this.valuePolicy.indexOf(e.target.value), 1);
            }
        },
        handleSubmit(e) {
            this.loading = true;
            e.preventDefault();
            this.form.validateFields(async (err, values) => {
                if (!err) {
                    var postData = {
                        ...values,
                    };

                    let retrieve = await JSON.parse(this.retrieve);
                    postData.id = retrieve.id;
                    postData.policy = values.policies;
                    axios
                        .put(`${this.apiurl}/dashboard/api/role/policy`, postData)
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
