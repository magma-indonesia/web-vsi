<footer>
    <div class="widget_wrap overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="widget_list">
                        <h4 class="widget_title">Alamat</h4>
                        <div class="widget_text">
                            <ul>
                                <li><a target="_blank" href="https://goo.gl/maps/xQdpQmnuM629jo3S7">Jl. Diponegoro no.
                                        57</a></li>
                                <li><a target="_blank" href="https://goo.gl/maps/xQdpQmnuM629jo3S7">Bandung - 40122</a>
                                </li>
                                <li><a target="_blank" href="https://goo.gl/maps/xQdpQmnuM629jo3S7">Jawa Barat,
                                        Indonesia</a></li>
                            </ul>
                            <ul>
                                <li><a href="tel:+62227272606">Phone: +62-22-727-2606</a></li>
                                <li><a href="fax:+62227202761">Fax: +62-22-720-2761</a></li>
                                <li><a href="mailto:pvmbg@esdm.go.id">E-mail: pvmbg@esdm.go.id</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <!-- <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="widget_list">
                                <h4 class="widget_title">Layanan</h4>
                                <div class="widget_service">
                                    <ul>
                                        <li><a href="#">Gunung Api</a></li>
                                        <li><a href="#">Gerakan Tanah</a></li>
                                        <li><a href="#">Gempa Bumi dan Tsunami</a></li>
                                        <li><a href="#">Permohonan Data</a></li>
                                        <li><a href="#">Informasi Kerja Sama</a></li>
                                        <li><a href="#">Reformasi Birokrasi</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="widget_list">
                                <h4 class="widget_title">Organisasi</h4>
                                <div class="widget_service">
                                    <ul>
                                        <li><a target="_blank" href="#">Kementerian ESDM</a></li>
                                        <li><a target="_blank" href="#">Badan Geologi</a></li>
                                        <li><a target="_blank" href="#">BPPTKG - Yogyakarta</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="widget_list">
                        <h4 class="widget_title">Organisasi</h4>
                        <div class="widget_service">
                            <ul>
                                <li><a target="_blank" href="#">Kementerian ESDM</a></li>
                                <li><a target="_blank" href="#">Badan Geologi</a></li>
                                <li><a target="_blank" href="#">BPPTKG - Yogyakarta</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <!-- <div class="col-md-3 col-sm-6">
                    <div class="widget_list">
                        <h4 class="widget_title">Jam Layanan</h4>
                        <div class="widget_text text2">
                            <ul>
                                <li><a href="#">Senin<span>08.00 - 16.00 WIB</span></a></li>
                                <li><a href="#">Selasa <span>08.00 - 16.00 WIB</span></a></li>
                                <li><a href="#">Rabu<span>08.00 - 16.00 WIB</span></a></li>
                                <li><a href="#">Kamis<span>08.00 - 16.00 WIB</span></a></li>
                                <li><a href="#">Jumat <span>08.00 - 16.30 WIB</span></a></li>
                                <li><a href="#">Sabtu - Minggu<span>Tutup</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div> -->

                <div class="col-md-4 col-sm-6" id="footer">
                    <div class="widget_list">
                        <h4 class="widget_title">Hubungi Kami</h4>
                        <div class="widget_text text2" id="container-contact-form">
                            <contact-form csrf="{{ csrf_token() }}" apiurl="{{ env('APP_URL') }}"
                                geetestid="{{ env('GEETEST_EVENT_ID') }}"></contact-form>
                        </div>
                    </div>
                </div>

                <div class="widget_copyright">
                    <div class="col-md-3 col-sm-6">
                        <div class="widget_logo">
                            <a href="{{ route('home') }}"><img src="images/pvmbg-logo-white.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="copyright_text">
                            <p><span>Copyright ©{{ now()->year }} Pusat Vulkanologi dan Mitigasi Bencana Geologi</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="city_top_social">
                            <ul>
                                <li><a href="https://www.facebook.com/PVMBG/?locale=id_ID"><i
                                            class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/PVMBG_"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/pvmbg_/?hl=en"><i
                                            class="fa fa-instagram"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCl6iW8jAJ9X-Fv68GIkCG_Q"><i
                                            class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
