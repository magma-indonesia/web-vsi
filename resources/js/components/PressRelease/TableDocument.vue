<template>
    <a-table
        :rowKey="'id'"
        style="margin-top: 10px"
        :columns="columns"
        :data-source="data"
        :pagination="false"
        :loading="false"
    >
        <template slot="delete" slot-scope="text, record, index">
            <div
                class="d-flex align-items-center justify-content-center flex-column"
                style="gap: 10px"
            >
                <div
                    class="d-flex align-items-center justify-content-center"
                    style="gap: 10px"
                >
                    <a-checkbox v-model="data[index].is_deleted"> </a-checkbox>
                </div>
            </div>
        </template>
        <template slot="notes" slot-scope="text, record, index">
            <div
                class="d-flex align-items-center justify-content-center flex-column"
                style="gap: 10px"
            >
                <div
                    class="d-flex align-items-center justify-content-center"
                    style="gap: 10px"
                >
                    <a-input style="width: 100%" v-model="data[index].notes" />
                </div>
            </div>
        </template>
        <template slot="name" slot-scope="text, record">
            <a :href="generateDoc(record)" target="_blank">{{ record.name }}</a>
        </template>
    </a-table>
</template>
<script>
export default {
    props: ["documents"],
    data() {
        return {
            deleted: [],
            data: [],
            columns: [
                {
                    title: "Hapus?",
                    dataIndex: "delete",
                    scopedSlots: { customRender: "delete" },
                },
                {
                    title: "Nama Dokumen",
                    dataIndex: "name",
                    scopedSlots: { customRender: "name" },
                },
                {
                    title: "Keterangan",
                    dataIndex: "notes",
                    scopedSlots: { customRender: "notes" },
                },
            ],
        };
    },
    mounted() {
        this.data = this.documents;
    },
    methods: {
        generateDoc(record) {
            return `${window.location.origin}/files/${
                record.id
            }/${encodeURIComponent(record.name)}`;
        },
    },
};
</script>
