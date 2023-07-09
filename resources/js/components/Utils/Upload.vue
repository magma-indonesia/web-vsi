<template>
    <a-tabs default-active-key="1" @change="onChangeTab($event)">
        <a-tab-pane key="1" tab="Pilih Media">
            <div
                v-for="(item, index) in loopMedia"
                :key="index"
                style="margin-bottom: 10px"
            >
                <div class="flex items-center">
                    <a-button
                        type="primary"
                        icon="select"
                        @click="handleSelectFile(index)"
                        >Pilih</a-button
                    >
                    <a-input
                        :value="
                            filesMedia.length > 0
                                ? filesMedia[index]?.notes
                                : ''
                        "
                        @change="handleChangeNotes($event, index)"
                        :disabled="filesMedia.length === 0"
                        placeholder="(Optional) Keterangan file"
                    ></a-input>
                    <a-button
                        type="primary"
                        icon="plus"
                        v-if="index === 0"
                        @click="handleAddUploadMedia(index + 1)"
                    ></a-button>
                    <a-button
                        type="danger"
                        icon="minus"
                        @click="handleRemoveUploadMedia(index)"
                        v-else
                    ></a-button>
                </div>
                <div
                    class="flex items-center gap-10"
                    style="margin-top: 10px"
                    v-if="filesMedia.length > 0 && filesMedia[index]"
                >
                    <div style="font-size: 12px">
                        {{ filesMedia[index]?.name }}
                    </div>
                    <a-button
                        @click="handleDeleteFileMedia(filesMedia[index]?.id)"
                        type="danger"
                        size="small"
                        icon="delete"
                    ></a-button>
                </div>
            </div>
        </a-tab-pane>
        <a-tab-pane key="2" tab="Upload Manual" force-render>
            <div
                v-for="(item, index) in loop"
                :key="index"
                style="margin-bottom: 10px"
            >
                <div class="flex items-center">
                    <a-button
                        type="primary"
                        icon="upload"
                        @click="handleUpload(index)"
                        >Browse</a-button
                    >
                    <a-input
                        :value="
                            files.filter((v) => v.index === index).length > 0
                                ? files.filter((v) => v.index === index)[0]
                                      .notes
                                : ''
                        "
                        @change="handleChangeNotes($event, index)"
                        :disabled="
                            files.filter((v) => v.index === index).length === 0
                        "
                        placeholder="(Optional) Keterangan file"
                    ></a-input>
                    <a-button
                        type="primary"
                        icon="plus"
                        v-if="index === 0"
                        @click="handleAddUpload(index + 1)"
                    ></a-button>
                    <a-button
                        type="danger"
                        icon="minus"
                        @click="handleRemoveUpload(index)"
                        v-else
                    ></a-button>
                </div>
                <div
                    class="flex items-center gap-10"
                    style="margin-top: 10px"
                    v-if="
                        files.length > 0 &&
                        files.filter((v) => v.index === index).length > 0
                    "
                >
                    <div style="font-size: 12px">
                        {{
                            files.filter((v) => v.index === index)[0].file.name
                        }}
                    </div>
                    <a-button
                        @click="handleDeleteFile(index)"
                        type="danger"
                        size="small"
                        icon="delete"
                    ></a-button>
                </div>
            </div>
        </a-tab-pane>
    </a-tabs>
</template>
<script>
/**
 * loop: Array
 * loopMedia: Array
 * files: Array
 * filesMedia: Array
 */
export default {
    props: ["loopMedia", "loop", "filesMedia", "files"],
    methods: {
        onChangeTab(key) {
            this.$emit("changeTab", key);
        },
        handleSelectFile(index) {
            this.$emit("handleSelectFile", index);
        },
        handleChangeNotes(e, i) {
            this.$emit("handleChangeNotes", { e, i });
        },
        handleAddUploadMedia(index) {
            this.$emit("handleAddUploadMedia", index);
        },
        handleRemoveUploadMedia(index) {
            this.$emit("handleRemoveUploadMedia", index);
        },
        handleDeleteFileMedia(id) {
            this.$emit("handleDeleteFileMedia", id);
        },
        handleUpload(index) {
            this.$emit("handleUpload", index);
        },
        handleAddUpload(index) {
            this.$emit("handleAddUpload", index);
        },
        handleRemoveUpload(index) {
            this.$emit("handleRemoveUpload", index);
        },
        handleDeleteFile(index) {
            this.$emit("handleDeleteFile", index);
        },
    },
};
</script>
