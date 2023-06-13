<template>
    <div class="city_main_banner" :style="{ height: `${heightBanner}px` }">
        <div class="main-banner-slider" style="height: 100%">
            <div>
                <figure class="overlay">
                    <img src="extra-images/main-banner-pvmbg.jpg" alt="" />
                    <div class="banner_text" style="padding: 20px 30px">
                        <div class="small_text animated">Selamat Datang</div>
                        <div class="medium_text animated">di web</div>
                        <div
                            class="banner_btn"
                            style="margin-top: 10px; margin-bottom: 10px"
                        >
                            <a
                                class="theam_btn animated"
                                style="background: #293d50; color: #fff"
                                href="https://magma.vsi.esdm.go.id"
                                >MAGMA Indonesia</a
                            >
                            <a
                                class="theam_btn animated"
                                style="background: #293d50; color: #fff"
                                href=""
                                >Portal MGB</a
                            >
                        </div>
                        <div class="banner_search_form">
                            <label>Cari artikel</label>
                            <div class="banner_search_field animated">
                                <input
                                    type="text"
                                    name="keyword"
                                    placeholder="Ketik sesuatu untuk pencarian..."
                                    @change="updateKeyword"
                                />
                                <a :href="urlpencarian+'?keyword='+keyword"><i
                                        class="fa fa-search"
                                        style="color: #fff"
                                    ></i
                                ></a>
                            </div>
                        </div>
                    </div>
                </figure>
            </div>

            <div>
                <figure class="overlay">
                    <img src="extra-images/main-banner-pvmbg1.jpg" alt="" />
                    <a
                        href="/images/ikm-pvmbg.png"
                        target="_blank"
                        class="banner_text"
                        style="
                            background: url('/images/ikm-pvmbg.png');
                            background-repeat: no-repeat;
                            background-size: contain;
                            height: 300px;
                            box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);
                        "
                    >
                        <!-- <div class="small_text animated">Indeks Kepuasan Masyarakat,</div> -->
                        <!-- <div class="medium_text animated">Gerakan Tanah</div> -->
                        <!-- <div class="large_text animated">Nov 2021</div> -->
                        <!-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum modi natus officia repellendus
                        impedit veritatis exercitationem, vitae quidem obcaecati sit adipisci atque tenetur beatae qui
                        dolorem doloribus iste dolorum animi.</p>
                    <a class="theam_btn animated" href="#">Detail</a> -->
                    </a>
                </figure>
            </div>
            <div v-if="pengumuman">
                <figure class="overlay">
                    <img src="extra-images/main-banner-pvmbg2.jpg" alt="" />
                    <div class="banner_text" style="padding: 20px 30px">
                        <div class="small_text animated">
                            {{ JSON.parse(pengumuman).title }}
                        </div>
                        <div v-html="JSON.parse(pengumuman).content" />
                    </div>
                </figure>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["pengumuman", "urlpencarian"],
    data() {
        return {
            keyword: ""            
        };
    },
    computed: {
        heightBanner() {
            return window.innerHeight - 245;
        },
    },
    methods: {
        updateKeyword(e) {
            this.keyword = e.target.value;
        },
    },
};
</script>
<style>
.slick-list {
    height: 100%;
}
</style>
