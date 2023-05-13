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
                            <div class="blob red" v-if="item.level === 4"></div>
                            <div
                                class="blob orange"
                                v-if="item.level === 3"
                            ></div>
                            <div
                                class="blob yellow"
                                v-if="item.level === 2"
                            ></div>
                            <div
                                class="blob green"
                                v-if="item.level === 1"
                            ></div>

                            G. {{ g }}
                        </div>
                    </div>
                </div>
                <hr />
                Keterangan:
                <div style="display: flex; align-items: center; gap: 10px">
                    <div class="blob red" />
                    Level IV (AWAS)
                </div>
                <div style="display: flex; align-items: center; gap: 10px">
                    <div class="blob orange" />
                    Level III (SIAGA)
                </div>
                <div style="display: flex; align-items: center; gap: 10px">
                    <div class="blob yellow" />
                    Level II (WASPADA)
                </div>
                <div style="display: flex; align-items: center; gap: 10px">
                    <div class="blob green" />
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
    border-radius: 50%;
    box-shadow: 0 0 0 0 rgba(0, 0, 0, 1);
    margin: 10px;
    height: 20px;
    width: 20px;
    transform: scale(1);
    animation: pulse-black 2s infinite;
}
.blob.red {
    background: rgba(255, 82, 82, 1);
    box-shadow: 0 0 0 0 rgba(255, 82, 82, 1);
    animation: pulse-red 2s infinite;
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
