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
                            <div
                                class="blob red circle"
                                v-if="item.level === 4"
                            ></div>
                            <div
                                class="blob orange circle"
                                v-if="item.level === 3"
                            ></div>
                            <div
                                class="blob yellow circle"
                                v-if="item.level === 2"
                            ></div>
                            <div
                                class="blob green circle"
                                v-if="item.level === 1"
                            ></div>
                            G. {{ g }}
                            <div style="margin-left: auto">
                                <div
                                    class="blob red boxs"
                                    v-if="item.level === 4"
                                    style="font-size: 10px; font-weight: bold"
                                >
                                    AWAS
                                </div>
                                <div
                                    class="blob orange boxs"
                                    v-if="item.level === 3"
                                    style="font-size: 10px; font-weight: bold"
                                >
                                    SIAGA
                                </div>
                                <div
                                    class="blob yellow boxs"
                                    v-if="item.level === 2"
                                    style="font-size: 10px; font-weight: bold"
                                >
                                    WASPADA
                                </div>
                                <div
                                    class="blob green boxs"
                                    v-if="item.level === 1"
                                    style="font-size: 10px; font-weight: bold"
                                >
                                    NORMAL
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                Keterangan:
                <div style="display: flex; align-items: center; gap: 10px">
                    <div class="blob red circle" />
                    Level IV (AWAS)
                </div>
                <div style="display: flex; align-items: center; gap: 10px">
                    <div class="blob orange circle" />
                    Level III (SIAGA)
                </div>
                <div style="display: flex; align-items: center; gap: 10px">
                    <div class="blob yellow circle" />
                    Level II (WASPADA)
                </div>
                <div style="display: flex; align-items: center; gap: 10px">
                    <div class="blob green circle" />
                    Level I (NORMAL)
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
<style scoped>
.blob {
    background: black;
    box-shadow: 0 0 0 0 rgba(0, 0, 0, 1);
    margin: 10px;
    font-size: 10px;
    color: #fff;
    transform: scale(1);
    animation: pulse-black 2s infinite;
    font-weight: bold;
}
.blob.red {
    background: rgba(255, 82, 82, 1);
    box-shadow: 0 0 0 0 rgba(255, 82, 82, 1);
    animation: pulse-red 2s infinite;
}
.circle {
    padding: 10px;
    border-radius: 50%;
}
.boxs {
    padding: 5px;
    border-radius: 5px;
}
@keyframes pulse-red {
    0% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(255, 82, 82, 0.7);
    }

    70% {
        transform: scale(1);
        box-shadow: 0 0 0 10px rgba(255, 82, 82, 0);
    }

    100% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(255, 82, 82, 0);
    }
}

.blob.orange {
    background: rgba(255, 121, 63, 1);
    box-shadow: 0 0 0 0 rgba(255, 121, 63, 1);
    animation: pulse-orange 2s infinite;
}

@keyframes pulse-orange {
    0% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(255, 121, 63, 0.7);
    }

    70% {
        transform: scale(1);
        box-shadow: 0 0 0 10px rgba(255, 121, 63, 0);
    }

    100% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(255, 121, 63, 0);
    }
}

.blob.yellow {
    background: rgba(255, 177, 66, 1);
    box-shadow: 0 0 0 0 rgba(255, 177, 66, 1);
    animation: pulse-yellow 2s infinite;
}

@keyframes pulse-yellow {
    0% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(255, 177, 66, 0.7);
    }

    70% {
        transform: scale(1);
        box-shadow: 0 0 0 10px rgba(255, 177, 66, 0);
    }

    100% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(255, 177, 66, 0);
    }
}
.blob.green {
    background: rgba(51, 217, 178, 1);
    box-shadow: 0 0 0 0 rgba(51, 217, 178, 1);
    animation: pulse-green 2s infinite;
}

@keyframes pulse-green {
    0% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(51, 217, 178, 0.7);
    }

    70% {
        transform: scale(1);
        box-shadow: 0 0 0 10px rgba(51, 217, 178, 0);
    }

    100% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(51, 217, 178, 0);
    }
}
</style>
