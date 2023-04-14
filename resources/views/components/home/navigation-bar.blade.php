<header>
    <!--CITY TOP WRAP START-->
    <div class="city_top_wrap">
        <div class="container-fluid">
            <div class="city_top_logo">
                <figure>
                    <h1><a href="{{ route('home') }}"><img src="{{ asset('images/pvmbg-logo.svg') }}" alt="Pusat Vulkanologi dan Mitigasi Bencana Geologi"
                                style="width: 400px"></a></h1>
                </figure>
            </div>
            <div class="city_top_news">
                <span>Tingkat Aktivitas Gunung Api</span>
                <div class="city-news-slider">
                    <div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry <i
                                class="fa fa-star"></i></p>
                    </div>
                    <div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry <i
                                class="fa fa-star"></i></p>
                    </div>
                    <div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry <i
                                class="fa fa-star"></i></p>
                    </div>
                </div>
            </div>

            <x-home.media-sosial/>

        </div>
    </div>
    <!--CITY TOP WRAP END-->

    <!--CITY TOP NAVIGATION START-->
    <div class="city_top_navigation">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="navigation">
                        <ul>
                            <li><a href="#">Profile</a>
                                <ul class="child">
                                    <li><a href="{{ route('profile.tentang-pvmbg') }}">Tentang PVMBG</a></li>
                                    <li><a href="{{ route('profile.struktur-organisasi') }}">Struktur Organisasi</a>
                                    </li>
                                    <li><a href="{{ route('profile.sejarah') }}">Sejarah</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Gunung Api</a>
                                <ul class="child">
                                    <li><a href="">Data Dasar</a></li>
                                    <li><a href="">Tingkat Aktivitas</a></li>
                                    <li><a href="">Laporan Aktivitas</a></li>
                                    <li><a href="">Informasi Letusan</a></li>
                                    <li><a href="">CCTV Gunung Api</a></li>
                                    <li><a href="">Gallery Foto</a></li>
                                    <li><a href="">Peta KRB Gunung Api</a></li>
                                    <li><a href="">Live Seismogram</a></li>
                                    <hr>
                                    <li><a href="">VONA</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Gerakan Tanah</a>
                                <ul class="child">
                                    <li><a href="">Daftar Kejadian</a></li>
                                    <li><a href="">Peringatan Dini</a></li>
                                    <li><a href="">Rekapitulasi Kejadian</a></li>
                                    <li><a href="">Peta ZKGT</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Gempa Bumi dan Tsunami</a>
                                <ul class="child">
                                    <li><a href="">Daftar Kejadian</a></li>
                                    <li><a href="">laporan Singkat dan Rekomendasi Teknis</a></li>
                                    <li><a href="">Publikasi Mitigasi Gempa Bumi</a></li>
                                    <li><a href="">Katalog Gempa Bumi Merusak</a></li>
                                    <li><a href="">Peta KRB Gempa Bumi</a></li>
                                    <li><a href="">Peta KRB Tsunami</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Layanan Publik</a>
                                <ul class="child">
                                    <li><a href="{{ route('layanan-publik.reformasi-birokrasi') }}">Reformasi
                                            Birokrasi</a></li>
                                    <li><a href="#">Diseminasi Informasi</a>
                                        <ul class="child">
                                            <li><a href="{{ route('layanan-publik.diseminasi-informasi.gunung-api') }}">Gunung
                                                    Api</a></li>
                                            <li><a href="">Gerakan Tanah</a></li>
                                            <li><a href="">Gempa Bumi dan Tsunami</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Kerja Sama</a>
                                        <ul class="child">
                                            <li><a href="{{ route('layanan-publik.kerja-sama.informasi-kerja-sama') }}">Informasi
                                                    Kerja Sama</a></li>
                                            <li><a href="">Dalam Negeri</a>
                                                <ul class="child">
                                                    <li><a
                                                            href="{{ route('layanan-publik.kerja-sama.dalam-negeri.bilateral') }}">Bilateral</a>
                                                    </li>
                                                    <li><a
                                                            href="{{ route('layanan-publik.kerja-sama.dalam-negeri.multilateral') }}">Multilateral</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('layanan-publik.kerja-sama.luar-negeri') }}">Luar
                                                    Negeri</a></li>
                                        </ul>
                                    </li>
                                    <hr>
                                    <li><a href="">Permohonan Data</a></li>
                                    <li><a href="">Permohonan API Service MAGMA</a></li>
                                    <li><a href="">Praktik Kerja Lapangan</a></li>
                                    <li><a href="">Bimbingan Tugas Akhir</a></li>
                                    <hr>
                                    <li><a href="">Pengaduan</a></li>
                                    <li><a href="{{ route('layanan-publik.kontak') }}">Hubungi Kami</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('layanan-publik.kontak') }}">Hubungi Kami</a></li>
                            <!-- <li><a href="#">Berita</a>
                                <ul class="child">
                                    <li><a href="">Artikel</a></li>
                                    <li><a href="">Liputan Khusus</a></li>
                                    <li><a href="">Webinar</a></li>
                                    <li><a href="">Forum Group Discussion</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </div>
                    <!--DL Menu Start-->
                    <div id="kode-responsive-navigation" class="dl-menuwrapper">
                        <button class="dl-trigger">Open Menu</button>
                        <ul class="dl-menu">
                            <li class="menu-item kode-parent-menu"><a href="#">Profile</a>
                                <ul class="dl-submenu">
                                    <li><a href="{{ route('profile.tentang-pvmbg') }}">Tentang PVMBG</a></li>
                                    <li><a href="{{ route('profile.struktur-organisasi') }}">Struktur Organisasi</a>
                                    </li>
                                    <li><a href="{{ route('profile.sejarah') }}">Sejarah</a></li>
                                </ul>
                            </li>
                            <li class="menu-item kode-parent-menu"><a href="#">Gunung Api</a>
                                <ul class="dl-submenu">
                                    <li><a href="">Data Dasar</a></li>
                                    <li><a href="">Tingkat Aktivitas</a></li>
                                    <li><a href="">Laporan Aktivitas</a></li>
                                    <li><a href="">Informasi Letusan</a></li>
                                    <li><a href="">CCTV Gunung Api</a></li>
                                    <li><a href="">Gallery Foto</a></li>
                                    <li><a href="">Peta KRB Gunung Api</a></li>
                                    <li><a href="">Live Seismogram</a></li>
                                    <li><a href="">VONA</a></li>
                                </ul>
                            </li>
                            <li class="menu-item kode-parent-menu"><a href="#">Gerakan Tanah</a>
                                <ul class="dl-submenu">
                                    <li><a href="">Daftar Kejadian</a></li>
                                    <li><a href="">Peringatan Dini</a></li>
                                    <li><a href="">Rekapitulasi Kejadian</a></li>
                                    <li><a href="">Peta ZKGT</a></li>
                                </ul>
                            </li>
                            <li class="menu-item kode-parent-menu"><a href="#">Gempa Bumi dan Tsunami</a>
                                <ul class="dl-submenu">
                                    <li><a href="">Daftar Kejadian</a></li>
                                    <li><a href="">laporan Singkat dan Rekomendasi Teknis</a></li>
                                    <li><a href="">Publikasi Mitigasi Gempa Bumi</a></li>
                                    <li><a href="">Katalog Gempa Bumi Merusak</a></li>
                                    <li><a href="">Peta KRB Gempa Bumi</a></li>
                                    <li><a href="">Peta KRB Tsunami</a></li>
                                </ul>
                            </li>
                            <li class="menu-item kode-parent-menu"><a href="#">Layanan Publik</a>
                                <ul class="dl-submenu">
                                    <li><a href="{{ route('layanan-publik.reformasi-birokrasi') }}">Reformasi
                                            Birokrasi</a></li>
                                    <li><a href="#">Diseminasi Informasi</a>
                                        <ul class="dl-submenu">
                                            <li><a href="{{ route('layanan-publik.diseminasi-informasi.gunung-api') }}">Gunung
                                                    Api</a></li>
                                            <li><a href="">Gerakan Tanah</a></li>
                                            <li><a href="">Gempa Bumi dan Tsunami</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Kerja Sama</a>
                                        <ul class="dl-submenu">
                                            <li><a href="{{ route('layanan-publik.kerja-sama.informasi-kerja-sama') }}">Informasi
                                                    Kerja Sama</a></li>
                                            <li><a href="#">Dalam Negeri</a>
                                                <ul class="dl-submenu">
                                                    <li><a
                                                            href="{{ route('layanan-publik.kerja-sama.dalam-negeri.bilateral') }}">Bilateral</a>
                                                    </li>
                                                    <li><a
                                                            href="{{ route('layanan-publik.kerja-sama.dalam-negeri.multilateral') }}">Multilateral</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('layanan-publik.kerja-sama.luar-negeri') }}">Luar
                                                    Negeri</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('layanan-publik.kontak') }}">Hubungi Kami</a></li>
                                </ul>
                            </li>
                            <li class="menu-item kode-parent-menu"><a href="#">Berita</a>
                                <ul class="dl-submenu">
                                    <li><a href="">Artikel</a></li>
                                    <li><a href="">Liputan Khusus</a></li>
                                    <li><a href="">Webinar</a></li>
                                    <li><a href="">Forum Group Discussion</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--DL Menu END-->
                </div>
                <div class="col-md-2">
                    <div class="city_top_form">
                        <div class="city_top_search">
                            <input type="text" placeholder="Search">
                            <a href="#"><i class="fa fa-search"></i></a>
                        </div>
                        <a class="top_user" href="{{ route('login.index') }}"><i class="fa fa-user"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--CITY TOP NAVIGATION END-->
</header>
