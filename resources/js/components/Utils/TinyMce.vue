<template>
    <editor
        v-model="text"
        api-key="a12nujrz7c55qi1otfth9e77qsjmct0ovo3gfoe39gpq8lui"
        :init="config"
    />
</template>

<script>
import Editor from "@tinymce/tinymce-vue";
import axios from "axios";
export default {
    props: ["value", "apiurl"],
    components: {
        editor: Editor,
    },
    data() {
        return {
            text: this.value,
            config: {},
        };
    },
    created() {
        const current = this;
        this.config = {
            path_absolute: "/",
            selector: "#description",
            height: 500,
            image_class_list: [
                {
                    title: "img-responsive",
                    value: "img-responsive",
                },
            ],
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste imagetools",
            ],
            toolbar:
                "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",
            relative_urls: false,
            images_upload_handler: function (blobInfo, success, failure) {
                current.handleUpload(blobInfo, success, failure);
            },
            setup: function(ed) {
                ed.on('keydown', function(event) {
                    if (event.keyCode == 9) { // tab pressed
                        ed.execCommand('mceInsertContent', false, '&emsp;&emsp;'); // inserts tab
                        event.preventDefault();
                        event.stopPropagation();
                        return false;
                    }
                });
            }
        };
    },
    watch: {
        text: function (val) {
            this.$emit("change", val);
        },
        value: function (val) {
            this.text = val;
        },
    },
    methods: {
        handleUpload(blobInfo, success, failure) {
            const fd = new FormData();
            fd.append("file", blobInfo.blob());
            axios
                .post(`${window.location.origin}/image/upload`, fd)
                .then(async (res) => {
                    this.loading = false;
                    if (res) {
                        success(res.data.serve.url);
                    }
                })
                .catch((error) => {
                    failure(
                        "HTTP Error: " + error.response
                            ? `${error.response.data.message}`
                            : "Something wrong with our server, please try again later."
                    );
                });
        },
    },
};
</script>
