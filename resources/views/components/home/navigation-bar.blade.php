<header>
    <!--CITY TOP WRAP START-->
    <div class="city_top_wrap flex items-center" style="justify-content: space-between;padding: 0 25px;">
        <div class="city_top_logo">
            <a href="{{ route('home') }}"><img src="{{ asset('images/pvmbg-logo.svg') }}"
                    alt="Pusat Vulkanologi dan Mitigasi Bencana Geologi" style="width: 400px"></a>
        </div>
        <div class="news-container">
            <div class="title">Berita Terbaru</div>
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
                                <li><a href="{{ route('profile.tentang-pvmbg') }}">Tugas dan Fungsi</a></li>
                                <li><a href="{{ route('profile.struktur-organisasi') }}">Struktur Organisasi</a>
                                </li>
                                <li><a href="{{ route('profile.sejarah') }}">Sejarah</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Gunung Api</a>
                            <ul class="child">
                                <li><a href="{{ route('gunung-api.data-dasar.index') }}">Data Dasar</a></li>
                                <li style="display: none"><a href="{{ config('app.magma') }}" target="_blank">Sebaran Gunung Api</a></li>
                                <li><a href="{{ route('gunung-api.tingkat-aktivitas.index') }}">Tingkat Aktivitas</a></li>
                                <li><a href="{{ config('app.magma') }}/v1/gunung-api/laporan" target="_blank">Laporan Aktivitas</a></li>
                                <li><a href="{{ config('app.magma') }}/v1/gunung-api/informasi-letusan" target="_blank">Informasi Letusan</a></li>
                                <li><a href="{{ config('app.magma') }}/v1/gunung-api/cctv">CCTV Gunung Api</a></li>
                                <li style="display: none"><a href="">Gallery Foto</a></li>
                                <li><a href="{{ config('app.magma') }}">Peta KRB Gunung Api</a></li>
                                <li><a href="{{ config('app.magma') }}/v1/gunung-api/live-seismogram">Live Seismogram</a></li>
                                <li><a href="{{ config('app.magma') }}/vona">VONA</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Gerakan Tanah</a>
                            <ul class="child">
                                <li style="display: none"><a href="{{ route('gerakan-tanah.daftar-kejadian') }}">Daftar Kejadian</a></li>
                                <li><a href="{{ route('gerakan-tanah.tanggapan-kejadian.index') }}">Tanggapan Kejadian</a></li>
                                <!--<li><a href="{{ route('gerakan-tanah.peringatan-dini') }}">Peringatan Dini</a></li>-->
                                <li><a href="{{ config('app.pmbgi') }}">Peringatan Dini</a></li>
                                <li><a href="{{ route('gerakan-tanah.rekapitulasi-kejadian') }}">Rekapitulasi Kejadian</a></li>
                                <li><a href="{{ config('app.pmbgi') }}">Peta ZKGT</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Gempa Bumi dan Tsunami</a>
                            <ul class="child">
                                <li style="display: none"><a href="{{ route('gempa-bumi-tsunami.daftar-kejadian.index') }}">Daftar Kejadian</a></li>
                                <li><a href="{{ route('gempa-bumi-tsunami.kajian-kejadian.index') }}">Kajian Kejadian</a></li>
                                <li><a href="{{ route('gempa-bumi-tsunami.laporan-singkat.index') }}">laporan Singkat dan Rekomendasi Teknis</a></li>
                                <li><a href="{{ route('gempa-bumi-tsunami.publikasi-mitigasi.index') }}">Publikasi Mitigasi Gempa Bumi</a></li>
                                <li><a href="{{ config('app.pmbgi') }}">Katalog Gempa Bumi Merusak</a></li>
                                <li><a href="{{ config('app.pmbgi') }}">Peta KRB Gempa Bumi</a></li>
                                <li><a href="{{ config('app.pmbgi') }}">Peta KRB Tsunami</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Layanan Publik</a>
                            <ul class="child">
                                <li><a href="{{ route('layanan-publik.reformasi-birokrasi') }}">Reformasi
                                        Birokrasi</a></li>
                                <li style="display: none"><a href="#">Diseminasi Informasi</a>
                                    <ul class="child">
                                        <li><a href="{{ route('layanan-publik.diseminasi-informasi.gunung-api') }}">Gunung Api</a></li>
                                        <li><a href="">Gerakan Tanah</a></li>
                                        <li><a href="">Gempa Bumi dan Tsunami</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Kerja Sama</a>
                                    <ul class="child">
                                        <li><a href="{{ route('layanan-publik.kerja-sama.informasi-kerja-sama') }}">Informasi Kerja Sama</a></li>
                                        <li><a href="">Dalam Negeri</a>
                                            <ul class="child">
                                                <!--<li><a href="{{ route('layanan-publik.kerja-sama.dalam-negeri.bilateral') }}">Bilateral</a></li>-->
                                                <!--<li><a href="{{ route('layanan-publik.kerja-sama.dalam-negeri.multilateral') }}">Multilateral</a></li>-->
                                                <li><a href="#">Bilateral</a></li>
                                                <li><a href="#">Multilateral</a></li>
                                            </ul>
                                        </li>
                                        <!--<li><a href="{{ route('layanan-publik.kerja-sama.luar-negeri') }}">Luar Negeri</a></li>-->
                                        <li><a href="#">Luar Negeri</a></li>
                                    </ul>
                                </li>
                                <hr>
                                <navigation-bar-layanan></navigation-bar-layanan>
                                <hr>
                                <li style="display:none;"><a href="{{ route('layanan-publik.kontak') }}">Hubungi Kami</a></li>
                            </ul>
                                
                                {{-- <li><a href="#Permohonan Data dan Informasi" 
                                    onClick="window.scrollTo(0, document.body.scrollHeight);
                                    var event = new Event('scroll');
                                    window.dispatchEvent(event);">
                                    Permohonan Data dan Informasi</a></li>
                                <li><a href="#Permohonan Narasumber" 
                                    onClick="window.scrollTo(0, document.body.scrollHeight);
                                    var event = new Event('scroll');
                                    window.dispatchEvent(event);"
                                    >Permohonan Narasumber</a></li>
                                <li><a href="#Permohonan Integrasi Data" 
                                    onClick="window.scrollTo(0, document.body.scrollHeight);
                                    var event = new Event('scroll');
                                    window.dispatchEvent(event);">
                                    Permohonan Integrasi Data</a></li>
                                <li><a href="#Pelayanan Bimbingan" 
                                    onClick="window.scrollTo(0, document.body.scrollHeight);
                                    var event = new Event('scroll');
                                    window.dispatchEvent(event);">
                                    Pelayanan Bimbingan</a>
                                    <ul class="child">
                                        <li><a href="#" class="request">Praktik Kerja Lapangan</a></li>
                                        <li><a href="#" class="request">Bimbingan Skripsi/Tugas Akhir</a></li>
                                    </ul>
                                </li> --}}
                        </li>
                        <li><a href="{{ route('layanan-publik.kontak') }}">Hubungi Kami</a></li>
                        <li><a href="{{ route('press-release.index') }}">Press Release</a></li>
                        <li style="display: none"><a href="#">Berita</a>
                            <ul class="child">
                                <li><a href="">Artikel</a></li>
                                <li><a href="">Liputan Khusus</a></li>
                                <li><a href="">Webinar</a></li>
                                <li><a href="">Forum Group Discussion</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--DL Menu Start-->
                <div id="kode-responsive-navigation" class="dl-menuwrapper">
                    <button class="dl-trigger">Open Menu</button>
                    <ul class="dl-menu">
                        <li class="menu-item kode-parent-menu"><a href="#">Profile</a>
                            <ul class="dl-submenu">
                                <li><a href="{{ route('profile.tentang-pvmbg') }}">Tentang PVMBG</a></li>
                                <li><a href="{{ route('profile.struktur-organisasi') }}">Struktur Organisasi</a></li>
                                <li><a href="{{ route('profile.sejarah') }}">Sejarah</a></li>
                            </ul>
                        </li>
                        <li class="menu-item kode-parent-menu"><a href="#">Gunung Api</a>
                            <ul class="dl-submenu">
                                <li><a href="{{ route('gunung-api.data-dasar.index') }}">Data Dasar</a></li>
                                <li><a href="{{ route('gunung-api.tingkat-aktivitas.index') }}">Tingkat Aktivitas</a></li>
                                <li><a href="{{ config('app.magma') }}/v1/gunung-api/laporan" target="_blank">Laporan Aktivitas</a></li>
                                <li><a href="{{ config('app.magma') }}/v1/gunung-api/informasi-letusan" target="_blank">Informasi Letusan</a></li>
                                <li><a href="{{ config('ap.magma') }}/v1/gunung-api/cctv">CCTV Gunung Api</a></li>
                                <li style="display: none"><a href="">Gallery Foto</a></li>
                                <li><a href="{{ config('ap.magma') }}">Peta KRB Gunung Api</a></li>
                                <li><a href="{{ config('ap.magma') }}/v1/gunung-api/live-seismogram">Live Seismogram</a></li>
                                <li><a href="{{ config('ap.magma') }}/vona">VONA</a></li>
                            </ul>
                        </li>
                        <li class="menu-item kode-parent-menu"><a href="#">Gerakan Tanah</a>
                            <ul class="dl-submenu">
                                <li style="display: none"><a href="{{ route('gerakan-tanah.daftar-kejadian') }}">Daftar Kejadian</a></li>
                                <li><a href="{{ route('gerakan-tanah.tanggapan-kejadian.index') }}">Tanggapan Kejadian</a></li>
                                <!--<li><a href="{{ route('gerakan-tanah.peringatan-dini') }}">Peringatan Dini</a></li>-->
                                <li><a href="{{ config('app.pmbgi') }}">Peringatan Dini</a></li>
                                <li><a href="{{ route('gerakan-tanah.rekapitulasi-kejadian') }}">Rekapitulasi Kejadian</a></li>
                                <li><a href="{{ config('app.pmbgi') }}">Peta ZKGT</a></li>
                            </ul>
                        </li>
                        <li class="menu-item kode-parent-menu"><a href="#">Gempa Bumi dan Tsunami</a>
                            <ul class="dl-submenu">
                                <li style="display: none"><a href="{{ route('gempa-bumi-tsunami.daftar-kejadian.index') }}">Daftar Kejadian</a></li>
                                <li><a href="{{ route('gempa-bumi-tsunami.kajian-kejadian.index') }}">Kajian Kejadian</a></li>
                                <li><a href="{{ route('gempa-bumi-tsunami.laporan-singkat.index') }}">laporan Singkat dan Rekomendasi Teknis</a></li>
                                <li><a href="{{ route('gempa-bumi-tsunami.publikasi-mitigasi.index') }}">Publikasi Mitigasi Gempa Bumi</a></li>
                                <li><a href="{{ config('app.pmbgi') }}">Katalog Gempa Bumi Merusak</a></li>
                                <li><a href="{{ config('app.pmbgi') }}">Peta KRB Gempa Bumi</a></li>
                                <li><a href="{{ config('ap.mbgi') }}">Peta KRB Tsunami</a></li>
                            </ul>
                        </li>
                        <li class="menu-item kode-parent-menu"><a href="#">Layanan Publik</a>
                            <ul class="dl-submenu">
                                <li><a href="{{ route('layanan-publik.reformasi-birokrasi') }}">Reformasi
                                        Birokrasi</a></li>
                                <li style="display: none"><a href="#">Diseminasi Informasi</a>
                                    <ul class="dl-submenu">
                                        <li><a href="{{ route('layanan-publik.diseminasi-informasi.gunung-api') }}">Gunung Api</a></li>
                                        <li><a href="">Gerakan Tanah</a></li>
                                        <li><a href="">Gempa Bumi dan Tsunami</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Kerja Sama</a>
                                    <ul class="dl-submenu">
                                        <li><a href="{{ route('layanan-publik.kerja-sama.informasi-kerja-sama') }}">Informasi Kerja Sama</a></li>
                                        <li><a href="">Dalam Negeri</a>
                                            <ul class="dl-submenu">
                                                <!--<li><a href="{{ route('layanan-publik.kerja-sama.dalam-negeri.bilateral') }}">Bilateral</a></li>-->
                                                <!--<li><a href="{{ route('layanan-publik.kerja-sama.dalam-negeri.multilateral') }}">Multilateral</a></li>-->
                                                <li><a href="#">Bilateral</a></li>
                                                <li><a href="#">Multilateral</a></li>
                                            </ul>
                                        </li>
                                        <!--<li><a href="{{ route('layanan-publik.kerja-sama.luar-negeri') }}">Luar Negeri</a></li>-->
                                        <li><a href="#">Luar Negeri</a></li>
                                    </ul>
                                </li>
                                <hr>
                                <li><a href="#" class="request">Permohonan Data dan Informasi</a></li>
                                <li><a href="#" class="request">Permohonan Narasumber</a></li>
                                <li><a href="#" class="request">Permohonan Integrasi Data</a></li>
                                <li><a href="#">Pelayanan Bimbingan</a>
                                    <ul class="dl-submenu">
                                        <li><a href="#" class="request">Praktik Kerja Lapangan</a></li>
                                        <li><a href="#" class="request">Bimbingan Skripsi/Tugas Akhir</a></li>
                                    </ul>
                                </li>
                                <hr>
                                <li><a href="">Pengaduan</a></li>
                                <li style="display:none;"><a href="{{ route('layanan-publik.kontak') }}">Hubungi Kami</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('layanan-publik.kontak') }}">Hubungi Kami</a></li>
                        <li><a href="{{ route('press-release.index') }}">Press Release</a></li>
                        <li class="menu-item kode-parent-menu" style="display: none"><a href="#">Berita</a>
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
                        <form method="GET" action="{{route('hasil-pencarian.index')}}" id="search-form">
                            <input type="text" placeholder="Search" name="keyword" id="search"
                            value="{{request()->get('keyword')}}">
                            <a onclick="
                                if (document.getElementById('search').value == '') {
                                    alert('Masukkan kata kunci pencarian');
                                } else {
                                    document.getElementById('search-form').submit();
                                }">
                                <i class="fa fa-search"></i>
                            </a>
                        </form>
                    </div>
                    <a class="top_user" href="{{ route('login.index') }}"><i class="fa fa-user"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!--CITY TOP NAVIGATION END-->
</header>