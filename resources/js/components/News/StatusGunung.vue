<template>
    <div>
        <a-card>
            <div v-if="!data">
                <a-empty>
                    <div style="font-size: 12px" slot="description">
                        <b>Oops data kosong</b> <br />
                        <span style="color: #8c8c8c">
                            Data tidak ditemukan.
                        </span>
                    </div>
                </a-empty>
            </div>
            <div v-else>
                <div v-for="(item, index) in JSON.parse(data)" :key="index">
                    <div
                        v-if="
                            item.daftar_gunungapi.length > 0 && item.level > 1
                        "
                    >
                        <div
                            v-for="(g, i) in item.daftar_gunungapi"
                            :key="i"
                            style="
                                margin-bottom: 5px;
                                display: flex;
                                align-items: center;
                                gap: 10px;
                            "
                        >
                            <a-badge status="error" v-if="item.level === 4" />
                            <a-badge status="warning" v-if="item.level === 3" />
                            <a-badge
                                status="processing"
                                v-if="item.level === 2"
                            />
                            <a-badge status="success" v-if="item.level === 1" />
                            G. {{ g }}
                        </div>
                    </div>
                </div>
                <hr />
                Keterangan:
                <div style="display: flex; align-items: center; gap: 10px">
                    <a-badge status="error" /> Level IV (AWAS)
                </div>
                <div style="display: flex; align-items: center; gap: 10px">
                    <a-badge status="warning" /> Level III (SIAGA)
                </div>
                <div style="display: flex; align-items: center; gap: 10px">
                    <a-badge status="processing" /> Level II (WASPADA)
                </div>
                <div style="display: flex; align-items: center; gap: 10px">
                    <a-badge status="success" /> Level I (NORMAL)
                </div>
            </div>
        </a-card>
    </div>
</template>
<script>
export default {
    props: ["data"],
};
</script>
