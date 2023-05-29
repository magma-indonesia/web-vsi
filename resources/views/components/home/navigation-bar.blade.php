<header>
    <!--CITY TOP WRAP START-->
    <div class="city_top_wrap flex items-center" style="justify-content: space-between;padding: 0 25px;">
        <div class="city_top_logo">
            <a href="{{ route('home') }}"><img src="{{ asset('images/pvmbg-logo.svg') }}"
                    alt="Pusat Vulkanologi dan Mitigasi Bencana Geologi" style="width: 400px"></a>
        </div>
        <div class="news-container">
            <div class="title">
                Tingkat Aktivitas Gunung Api
            </div>
            <marquee class="news-marquee">
                @inject('activityLevels', 'App\Services\ActivityLevelService')

                @php
                $activityLevels = $activityLevels->get();
                @endphp

                @if (isset($activityLevels) && count($activityLevels) > 0)
                @foreach($activityLevels as $row)
                <a href="{{ $row->link }}">{{ $row->title }}</a>
                @endforeach
                @else
                <p>Belum ada informasi terbaru</p>
                @endif
            </marquee>
        </div>

        <div class="city_top_social">
            <ul>
                <li><a href="https://www.facebook.com/PVMBG/?locale=id_ID"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://twitter.com/PVMBG_"><i class="fa fa-twitter"></i></a></li>
                <li><a href="https://www.instagram.com/pvmbg_/?hl=en"><i class="fa fa-instagram"></i></a></li>
                <li><a href="https://www.youtube.com/channel/UCl6iW8jAJ9X-Fv68GIkCG_Q"><i class="fa fa-youtube"></i></a></li>
            </ul>
        </div>
    </div>
    <!--CITY TOP WRAP END-->

    <!--CITY TOP NAVIGATION START-->
    <div class="city_top_navigation">
            <div class="row">
                <div class="col-md-10">
                    <div class="navigation">
                        <ul style="margin-bottom: 0;">
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
                                    <li><a href="{{ route('gunung-api.data-dasar.index') }}">Data Dasar</a></li>
                                    <li><a href="https://magma.esdm.go.id" target="_blank">Sebaran Gunung Api</a></li>
                                    <li><a href="{{ route('gunung-api.tingkat-aktivitas.index') }}">Tingkat Aktivitas</a></li>
                                    <li><a href="https://magma.esdm.go.id/v1/gunung-api/laporan" target="_blank">Laporan Aktivitas</a></li>
                                    <li><a href="https://magma.esdm.go.id/v1/gunung-api/informasi-letusan" target="_blank">Informasi Letusan</a></li>
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
                                    <li><a href="{{ route('gerakan-tanah.daftar-kejadian') }}">Daftar Kejadian</a></li>
                                    <li><a href="{{ route('gerakan-tanah.tanggapan-kejadian.index') }}">Tanggapan Kejadian</a>
                                    </li>
                                    <li><a href="{{ route('gerakan-tanah.peringatan-dini') }}">Peringatan Dini</a></li>
                                    <li><a href="{{ route('gerakan-tanah.rekapitulasi-kejadian') }}">Rekapitulasi
                                            Kejadian</a></li>
                                    <li><a href="">Peta ZKGT</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Gempa Bumi dan Tsunami</a>
                                <ul class="child">
                                    <li><a href="{{ route('gempa-bumi-tsunami.daftar-kejadian.index') }}">Daftar
                                            Kejadian</a></li>
                                    <li><a href="{{ route('gempa-bumi-tsunami.kajian-kejadian.index') }}">Kajian Kejadian</a>
                                    </li>
                                    <li><a href="{{ route('gempa-bumi-tsunami.laporan-singkat.index') }}">laporan Singkat dan
                                            Rekomendasi Teknis</a></li>
                                    <li><a href="{{ route('gempa-bumi-tsunami.publikasi-mitigasi.index') }}">Publikasi
                                            Mitigasi Gempa Bumi</a></li>
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
                                    <!-- <li><a href="{{ route('layanan-publik.kontak') }}">Hubungi Kami</a></li> -->
                                </ul>
                            </li>
                            <li><a href="{{ route('layanan-publik.kontak') }}">Hubungi Kami</a></li>
                            <li><a href="{{ route('press-release.index') }}">Press Release</a></li>
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
                                    <li><a href="https://magma.esdm.go.id/v1/gunung-api/laporan" target="_blank">Laporan Aktivitas</a></li>
                                    <li><a href="https://magma.esdm.go.id/v1/gunung-api/informasi-letusan" target="_blank">Informasi Letusan</a></li>
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
                    <div class="city_top_form" style="display: flex; gap: 10px;">
                        <div class="city_top_search">
                            <input type="text" placeholder="Search">
                            <a href="#"><i class="fa fa-search"></i></a>
                        </div>
                        <a class="top_user" href="{{ route('login.index') }}"><i class="fa fa-user"></i></a>
                    </div>
                </div>
            </div>
    </div>
    <!--CITY TOP NAVIGATION END-->
</header>
