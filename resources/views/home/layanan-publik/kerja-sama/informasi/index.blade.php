@extends('template.layout')

@section('title', 'Informasi Kerja Sama')

@push('styles')
    <link href="{{ asset('css/sidebar-widget.css') }}" rel="stylesheet">
    <link href="{{ asset('css/selectric.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- SAB BANNER START-->
    <div class="sab_banner overlay">
        <div class="container">
            <div class="sab_banner_text">
                <h2>Informasi Kerja Sama</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a
                            href="{{ route('layanan-publik.kerja-sama.informasi-kerja-sama') }}">Layanan Publik</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- SAB BANNER END-->

    <!-- WRAP START-->
    <div class="city_health_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="city_health_text">
                        <h2><span>Informasi </span>Kerja Sama</h2>
                        <p>Kerja sama PVMBG melingkupi kerja sama di bidang bencana geologi yang meliputi kegiatan
                            peningkatan kapasitas sdm, penyelidikan, pemantauan,
                            instalasi peralatan, dan optimalisasi sistem mitigasi bencana geologi. </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="city_health_fig">
                        <figure class="box">
                            <div class="box-layer layer-1"></div>
                            <div class="box-layer layer-2"></div>
                            <div class="box-layer layer-3"></div>
                            <img src="{{ asset("extra-images/informasi-kerja-sama.png") }}" alt="Informasi Kerja Sama">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- WRAP END-->

    <!-- WRAP START-->
    <div class="city_service_detail_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar_widget">
                        <!-- CITY SERVICE TABS START-->
                        <div class="city_service_tabs tabs">
                            <ul class="tab-links">
                                <li class="active"><a href="#gunung-api">Gunung Api</a></li>
                                <li><a href="#gerakan-tanah">Gerakan Tanah</a></li>
                                <li><a href="#gempa-bumi">Gempa Bumi dan Tsunami</a></li>
                                <li><a href="#pengajuan">Pengajuan Kerja Sama</a></li>
                            </ul>
                        </div>
                        <!-- CITY SERVICE TABS END-->

                        <!-- CITY NOTICE START-->
                        <div class="city_notice" style="display: none">
                            <h4>Infografis Kerjasama</h4>
                            <p>Download Infografis untuk mengetahui alur kerjasama lebih detil</p>
                            <a class="theam_btn" href="#" tabindex="0">Download PDF</a>
                        </div>
                        <!-- CITY NOTICE END-->
                    </div>
                </div>
                <div class="col-md-9">
                    <!-- TABS START-->
                    <div class="tabs">
                        <div class="tab-content">
                            <div id="gunung-api" class="tab active">
                                <div class="city_service_tabs_list">
                                    <figure class="box">
                                        <div class="box-layer layer-1"></div>
                                        <div class="box-layer layer-2"></div>
                                        <div class="box-layer layer-3"></div>
                                        <img src="{{ asset('extra-images/informasi-kerja-sama-gunung-api.png') }}"
                                             alt="">
                                    </figure>
                                    <div class="city_service_tabs_text">
                                        <h3>Gunung Api</h3>

                                        <p>Indonesia memiliki sekitar 127 gunung api aktif. Berdasarkan catatan sejarah,
                                            terdapat 42 gunung api di Indonesia yang
                                            aktivitas erupsinya mengakibatkan kematian. Keberadaan 127 gunung api aktif
                                            ini dapat dikelompokkan berdasarkan sejarah
                                            aktivitasnya, yaitu Gunung Api Tipe A yang memiliki catatan sejarah letusan
                                            sejak tahun 1600 sejumlah 76 gunung api;
                                            Gunung Api Tipe B yang memiliki catatan sejarah letusan sebelum tahun 1600
                                            sejumlah 30 gunung api; dan Gunung Api Tipe C
                                            yang tidak memiliki catatan sejarah letusan tetapi masih memperlihatkan
                                            jejak aktivitas vulkanik, seperti solfatara atau
                                            fumarole, sejumlah 21 gunung api. Banyaknya gunung api aktif dengan sifat
                                            dan ciri erupsi yang berlainan menyebabkan
                                            diperlukannya antisipasi kemungkinan timbulnya bencana akibat bahaya gunung
                                            api tersebut secara komprehensif dalam upaya
                                            pengurangan risiko bencana erupsi gunung api.</p>
                                        <h5>Tugas dan Fungsi</h5>
                                        <p>Kelompok substansi gunung api memiliki tugas antara lain pengamatan,
                                            penetapan status, peringatan dini, rekomendasi
                                            teknis mitigasi bencana gunung api; penyelidikan, pemantauan, pemetaan
                                            tematik, pemodelan bahaya, dan penyebaran
                                            informasi gunung api. Kelompok substansi ini merupakan bidang kebencanaan
                                            geologi yang menjadi cikal bakal PVMBG, yaitu
                                            sejak tahun 1920. Maka dari itu, kelompok substansi gunung api memiliki
                                            sumber data lapangan yang lebih kaya,
                                            perlengkapan dan peralatan yang beragam, serta SDM yang relatif banyak
                                            apabila dibandingkan dengan kelompok substansi
                                            lainnya.
                                        </p>

                                        <p>Dari uraian tugas sebelumnya, peran kelompok substansi gunung api dalam
                                            mitigasi adalah pembuatan Kawasan Rawan Bencana
                                            (KRB) Gunung Api; Peta Geologi Gunung Api; Press Release (Berita);
                                            Rekomendasi Teknis; dan VONA (Volcano Observatory
                                            Notice for Aviation).
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div id="gerakan-tanah" class="tab">
                                <div class="city_service_tabs_list">
                                    <figure class="box">
                                        <div class="box-layer layer-1"></div>
                                        <div class="box-layer layer-2"></div>
                                        <div class="box-layer layer-3"></div>
                                        <img src="{{ asset('extra-images/informasi-kerja-sama-gempa-bumi.png') }}"
                                             alt="">
                                    </figure>
                                    <div class="city_service_tabs_text">
                                        <h3>Gerakan Tanah </h3>
                                        <p>Di Indonesia, bencana gerakan tanah disebabkan oleh beberapa faktor seperti
                                            morfologi, Kondisi Geologi (batuan dan
                                            pelapukannya, stratigrafi, struktur geologi), pola aliran sungai, dan
                                            perubahan penggunaan lahan yang dapat dipicu oleh
                                            curah hujan dan guncangan gempa bumi. Bencana gerakan tanah biasanya
                                            merupakan bencana yang terjadi secara lokal dengan
                                            cakupan daerah terdampak yang relatif kecil, namun tetap harus diwaspadai
                                            dan dianalisis pada skala yang cukup besar.
                                            Analisis dan pemetaan gerakan tanah diatur dalam SNI 8291-2016 tentang
                                            Zonasi Gerakan Tanah dari Skala Detail sampai
                                            Regional. Berdasarkan standar tersebut, peta kerentanan gerakan tanah yang
                                            dibuat oleh Badan Geologi menunjukkan empat
                                            zona yang berbeda dari zona dengan gerakan tanah yang tinggi, menengah,
                                            rendah, dan sangat rendah.</p>

                                        <h5>Tugas dan Fungsi</h5>
                                        <p>Tugas pokok Kelompok Substansi Mitigasi Bencana Gerakan Tanah melingkupi
                                            penyiapan penyusunan kebijakan teknis, norma,
                                            standar, prosedur, kriteria, rencana, pelaporan, pemetaan, pemodelan bahaya,
                                            penyelidikan, pemantauan, dan peringatan
                                            dini potensi gerakan tanah, dan rekomendasi teknis mitigasi gerakan tanah,
                                            serta penyebaran informasi gerakan tanah.
                                            Proses kerja kelompok substansi gerakan tanah dari tahun 2016 hingga 2020
                                            berupa, penyelidikan, peringatan dini,
                                            pemantauan, sosialisasi serta kegiatan tanggap darurat dan pasca bencana.
                                        </p>

                                        <p>Cakupan kerja kelompok substansi gerakan tanah
                                            meliputi seluruh wilayah Indonesia. Produk- produk yang dihasilkan kelompok
                                            substansi gerakan tanah antara lain Peta
                                            Zona Kerentanan Gerakan Tanah (ZKGT); peta prakiraan potensi terjadinya
                                            gerakan tanah dan banjir bandang bulanan yang di
                                            publish setiap bulan; Press Release (Berita); dan Rekomendasi Teknis. Selain
                                            itu, kelompok substansi gerakan tanah juga
                                            melakukan pemutakhiran terhadap sistem pemantauan gerakan tanah bersama
                                            BPPTKG.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div id="gempa-bumi" class="tab">
                                <div class="city_service_tabs_list">
                                    <figure class="box">
                                        <div class="box-layer layer-1"></div>
                                        <div class="box-layer layer-2"></div>
                                        <div class="box-layer layer-3"></div>
                                        <img src="{{ asset('extra-images/informasi-kerja-sama-gempa-bumi.png') }}"
                                             alt="">
                                    </figure>
                                    <div class="city_service_tabs_text">
                                        <h3>Gempa Bumi dan Tsunami</h3>
                                        <p>Ancaman geologi lain yaitu bencana gempa bumi. Gempa bumi adalah getaran pada
                                            kulit bumi yang disebabkan oleh proses
                                            pelepasan energi secara tiba-tiba dari dalam bumi akibat pertemuan antar
                                            lempeng ataupun aktivitas sesar aktif di darat
                                            dan di laut (Permen ESDM No. 15/2011). Dengan melihat kondisi akibat dari
                                            gempa bumi, analisis geologi untuk tata ruang
                                            harus dilakukan terhadap dua parameter utama, yaitu menganalisis sumber
                                            gempa bumi dan respons permukaan tanah terhadap
                                            efek penguatan gempa bumi (amplifikasi). Untuk mengantisipasi bencana gempa
                                            bumi, Indonesia mengeluarkan peta berstandar
                                            SNI yang dapat digunakan dalam penataan ruang di seluruh wilayah Indonesia.
                                            Akan tetapi peta ini didasarkan pada
                                            percepatan spektrum, bukan berdasarkan peak ground acceleration (PGA), peak
                                            ground velocity (PGV), atau faktor zona.</p>

                                        <p>Tsunami adalah gelombang laut, yang diakibatkan oleh proses geologi bawah
                                            laut, baik berupa gempa bumi, letusan gunung
                                            api, maupun longsoran. Analisis bahaya tsunami mengestimasi kawasan pesisir
                                            yang rawan. Tsunami dan karakteristik sumber
                                            pembangkit tsunami (tsunamigenic). Zona bahaya tsunami menetapkan potensi
                                            dampak tsunami terhadap daerah tertentu dengan
                                            mengkategorikan intensitas yang berbeda, di mana intensitas tersebut
                                            bergantung pada ketinggian gelombang dan elevasi
                                            permukaan tanah. Pada bahaya tsunami dari badan geologi menetapkan tiga zona
                                            bahaya. Klasifikasi ini didasarkan pada
                                            kejadian historis tsunami, lokasi pantai yang terkait dengan episenter, dan
                                            perkiraan tinggi gelombang.</p>

                                        <h5>Tugas dan Fungsi</h5>
                                        <p>Kelompok Substansi Mitigasi Gempa Bumi dan Tsunami memiliki tugas penyiapan
                                            penyusunan kebijakan teknis, norma, standar,
                                            prosedur, kriteria, rencana, pelaporan, pemetaan dan rekomendasi teknis
                                            mitigasi gempa bumi dan tsunami, penyelidikan,
                                            pemodelan bahaya serta penyebaran informasi gempa bumi dan tsunami.
                                        </p>

                                        <p>Produk kelompok mitigasi gempa bumi dan tsunami,
                                            seperti Peta KRB Gempa Bumi dan Tsunami untuk menunjang penataan ruang.
                                            Selain itu kelompok substansi gempa bumi dan
                                            tsunami juga melakukan penyelidikan tanggap darurat dan perumusan
                                            rekomendasi teknis ketika terjadi bencana.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div id="pengajuan" class="tab">
                                <div class="city_service_tabs_list">
                                    <figure class="box">
                                        <div class="box-layer layer-1"></div>
                                        <div class="box-layer layer-2"></div>
                                        <div class="box-layer layer-3"></div>
                                        <img src="{{ asset('extra-images/permohonan-kerja-sama.png') }}" alt="">
                                    </figure>
                                    <div class="city_service_tabs_text">
                                        <!-- CITY EMERGENCY CALL START-->
                                        <div class="city_emergency_info">
                                            <div class="city_emergency_call">
                                                <h5>Dokumen yang Dibutuhkan</h5>
                                                <ul>
                                                    <li><a>Profile Institusi</a></li>
                                                    <li><a>Dokumen (.docx atau PDF)</a></li>
                                                    <li><a>MoU jika ada</a></li>
                                                    <li><a>Dokumen (.docx atau PDF)</a></li>
                                                    <li><a>Proposal Kerja Sama</a></li>
                                                    <li><a>Dokumen (.docx atau PDF) </a></li>
                                                    <li><a>Rencana Anggaran Biaya (optional)</a></li>
                                                    <li><a>Dokumen (.docx atau PDF)</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- CITY EMERGENCY CALL END-->

                                        <h3>Form Pengajuan Kerja Sama</h3>

                                        <p>Ajukan permohonan kerja sama di bidang kebencanaan geologi melalui halaman
                                            ini. Persiapkan dokumen dan data dukung yang dibutuhkan. Pengajuan kerja
                                            sama setiap kebencanaan geologi berbeda-beda, namun tidak menutup
                                            kemungkinan kerja sama dilakukan untuk semua matra bencana geologi.
                                        </p>

                                        <form action="" method="" enctype="multipart/form-data">
                                            @csrf
                                            <div class="event_booking_form">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="event_booking_area">
                                                            <label>Judul Kerjasama</label>
                                                            <textarea style="height: auto" rows="2"
                                                                      placeholder="Dalam Judul, wajib menyertakan nama-nama organisasi yang terlibat"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="event_booking_area">
                                                            <label>Maksud dan Tujuan</label>
                                                            <textarea
                                                                placeholder="Deskripsi atau dalam bentuk daftar tujuan yang ingin dicapai secara umum"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="event_booking_area">
                                                            <label>Target Kerjasama</label>
                                                            <textarea
                                                                placeholder="Target dari kerja sama selama durasi yang diajukan. Bukan berupa produk luaran"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label>Narahubung</label>
                                                    </div>
                                                    <div class="dynamic-pic-wrapper">
                                                        <div class="dynamic-pic">
                                                            <div class="col-md-2">
                                                                <div class="event_booking_field">
                                                                    <select class="small">
                                                                        <option>Mr.</option>
                                                                        <option>Ms.</option>
                                                                        <option>Mrs.</option>
                                                                        <option>Dr.</option>
                                                                        <option>Prof.</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="event_booking_field">
                                                                    <input name="f_name" type="text"
                                                                           placeholder="Nama Depan">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="event_booking_field">
                                                                    <input name="m_email" type="text"
                                                                           placeholder="Nama Tengah">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="event_booking_field">
                                                                    <input name="l_email" type="text"
                                                                           placeholder="Nama Belakang">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="event_booking_field">
                                                                    <button class="button btn-info btn-lg add_button"
                                                                            type="button"><i class="fa fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="event_booking_field">
                                                                    <input name="email" type="email"
                                                                           placeholder="Email">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="event_booking_field">
                                                                    <input name="organisasi" type="text"
                                                                           placeholder="Institusi">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label>Asal Negara</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="event_booking_field">
                                                            <select name="kategori" class="small">
                                                                @foreach($countries as $k => $v)
                                                                <option value="{{ $v['code'] }}" {{ $v['code'] == 'IDN' ? 'selected' : '' }}>{{ $v['native'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label>Jenis Lembaga</label>
                                                        <div class="event_booking_field">
                                                            <select name="gov-type" id="gov-type" class="small">
                                                                <option value="gov">Pemerintah</option>
                                                                <option value="uni">Univeristy</option>
                                                                <option value="ngo">NGO</option>
                                                                <option value="others">Lainnya</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12" id="org-under" style="display: none">
                                                        <label>Lembaga Pemerintah yang Menaungi</label>
                                                        <div class="event_booking_field">
                                                            <input name="org-under" type="text" placeholder="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="event_booking_area">
                                                            <label>Tugas Pokok dan Fungsi Organisasi</label>
                                                            <textarea placeholder=""></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="event_booking_area">
                                                            <label>Penjelasan Singkat Terkait Organisasi</label>
                                                            <textarea placeholder=""></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label>Personnel</label>
                                                    </div>
                                                    <div class="dynamic-involved-wrapper">
                                                        <div class="dynamic-involved">
                                                            <div class="col-md-2">
                                                                <div class="event_booking_field">
                                                                    <select class="small">
                                                                        <option>Mr.</option>
                                                                        <option>Ms.</option>
                                                                        <option>Mrs.</option>
                                                                        <option>Dr.</option>
                                                                        <option>Prof.</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="event_booking_field">
                                                                    <input name="f_name" type="text"
                                                                           placeholder="Nama Depan">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="event_booking_field">
                                                                    <input name="m_email" type="text"
                                                                           placeholder="Nama Tengah">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="event_booking_field">
                                                                    <input name="l_email" type="text"
                                                                           placeholder="Nama Belakang">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="event_booking_field">
                                                                    <button
                                                                        class="button btn-info btn-lg add_button_involved"
                                                                        type="button"><i class="fa fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="event_booking_field">
                                                                    <input name="email" type="email"
                                                                           placeholder="Email">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="event_booking_field">
                                                                    <input name="organisasi" type="text"
                                                                           placeholder="Institusi">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label>Ruang Lingkup Kerjasama</label>
                                                        <div class="event_booking_field">
                                                            <select name="kategori" id="kategori" class="small">
                                                                <option value="1">Gunung Api - Pemenuhan Kebutuhan
                                                                    Peralatan Ppemantauan Kimia Gunung Api
                                                                </option>
                                                                <option value="2">Gunung Api - Penyelidikan Geologi,
                                                                    Geokimia, dan Geofisika
                                                                </option>
                                                                <option value="3">Gunung Api - Modeling Potensi Bahaya
                                                                    Gunung Api
                                                                </option>
                                                                <option value="4">Gunung Api - Instalasi Instrumen
                                                                    Monitoring Gunung api
                                                                </option>

                                                                <option value="5">Gerakan Tanah - Penginderaan Jauh
                                                                    untuk Gerakan Tanah
                                                                </option>
                                                                <option value="6">Gerakan Tanah - Pemetaan Gerakan
                                                                    Tanah
                                                                </option>
                                                                <option value="7">Gerakan Tanah - Teknologi dan Sistem
                                                                    Peringatan Dini Gerakan Tanah
                                                                </option>
                                                                <option value="8">Gerakan Tanah - Penyelidikan,
                                                                    Pemantauan dan Pemodelan Debris Flow
                                                                </option>

                                                                <option value="9">Gempa Bumi dan Tsunami - Pemantauan
                                                                    Sesar Lembang
                                                                </option>
                                                                <option value="10">Gempa Bumi dan Tsunami - Pemantauan
                                                                    Sesar Opak
                                                                </option>
                                                                <option value="11">Gempa Bumi dan Tsunami - Pemetaan KRB
                                                                    Gempa Bumi Skala Detail
                                                                </option>
                                                                <option value="12">Gempa Bumi dan Tsunami - Pemetaan KRB
                                                                    Tsunami Skala Detail
                                                                </option>
                                                                <option value="13">Gempa Bumi dan Tsunami - Data
                                                                    Karakteristik Sumber Pembangkit Tsunami Non Tektonik
                                                                </option>
                                                                <option value="14">Lainnya</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12" id="scope-other" style="display: none">
                                                        <div class="event_booking_field">
                                                            <textarea name="scope-other"
                                                                      placeholder="Ruang Lingkup Kerjasama"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label>Mekanisme Pendanaan</label>
                                                        <div class="event_booking_field">
                                                            <textarea name="funding" placeholder=""></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <label>Durasi Kerjasama</label>
                                                        <div class="event_booking_field">
                                                            <select name="duration" id="duration" class="small">
                                                                <option value="1">1 Tahun</option>
                                                                <option value="2">2 Tahun</option>
                                                                <option value="3">3 Tahun</option>
                                                                <option value="4">4 Tahun</option>
                                                                <option value="5">5 Tahun</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <div class="event_booking_field">
                                                            <label for="exampleFormControlFile1">Proposal Kerja
                                                                Sama</label>
                                                            <input name="file_pks" type="file" class="form-control-file"
                                                                   id="exampleFormControlFile1">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="event_booking_field">
                                                            <label for="exampleFormControlFile1">Kirim Pengajuan</label>
                                                            {{--<button class="button btn btn-info theam_btn" type="button">Submit</button>--}}
                                                            <a class="theam_btn" href="#" type="button">Submit</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- TABS END-->

                    <!-- CITY EMERGENCY SLIDER START-->
                    <div class="city_emergency_slider" style="display: none">
                        <h3 class="service_title">Kebencanaan Geologi</h3>
                        <div class="city-emergency-slide">
                            <div>
                                <div class="city_emergency_slide_fig">
                                    <figure class="box">
                                        <div class="box-layer layer-1"></div>
                                        <div class="box-layer layer-2"></div>
                                        <div class="box-layer layer-3"></div>
                                        {{--<img src="extra-images/emergency_fig.jpg" alt="">--}}
                                    </figure>
                                    <div class="city_emergency_slide_text">
                                        <h5><a href="#">Gunung Api</a></h5>
                                        <p>Poin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                                            bibendum auctor</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="city_emergency_slide_fig">
                                    <figure class="box">
                                        <div class="box-layer layer-1"></div>
                                        <div class="box-layer layer-2"></div>
                                        <div class="box-layer layer-3"></div>
                                        {{--<img src="extra-images/emergency_fig1.jpg" alt="">--}}
                                    </figure>
                                    <div class="city_emergency_slide_text">
                                        <h5><a href="#">Gerakan Tanah</a></h5>
                                        <p>Poin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                                            bibendum auctor</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="city_emergency_slide_fig">
                                    <figure class="box">
                                        <div class="box-layer layer-1"></div>
                                        <div class="box-layer layer-2"></div>
                                        <div class="box-layer layer-3"></div>
                                        {{--<img src="extra-images/emergency_fig2.jpg" alt="">--}}
                                    </figure>
                                    <div class="city_emergency_slide_text">
                                        <h5><a href="#">Gempa Bumi</a></h5>
                                        <p>Poin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                                            bibendum auctor</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="city_emergency_slide_fig">
                                    <figure class="box">
                                        <div class="box-layer layer-1"></div>
                                        <div class="box-layer layer-2"></div>
                                        <div class="box-layer layer-3"></div>
                                        {{--<img src="extra-images/emergency_fig1.jpg" alt="">--}}
                                    </figure>
                                    <div class="city_emergency_slide_text">
                                        <h5><a href="#">Tsunami</a></h5>
                                        <p>Poin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                                            bibendum auctor</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CITY EMERGENCY SLIDER END-->

                    <!-- CITY EMERGENCY SLIDER START-->
                    <div class="city_emergency_slider">
                        <h3 class="service_title">Bentuk Kerja Sama</h3>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="emergency_service">
                                    <div class="emergency_service_item">
                                        <span><i class="fa  icon-healthcare-and-medical"></i></span>
                                        <h4><a href="#">Penyelidikan</a></h4>
                                    </div>
                                    <p>Penyelidikan Kebencanaan Geologi di Indonesia berfokus pada pemahaman dan pencegahan bencana alam.
                                        Melalui penggunaan teknologi dan pengetahuan geologi, tim penyelidik bekerja untuk mempelajari pola seismik,
                                        pergerakan lempeng tektonik, dan fenomena geologis lainnya guna memberikan solusi pencegahan dan peringatan dini yang efektif.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="emergency_service">
                                    <div class="emergency_service_item">
                                        <span><i class="fa icon-help"></i></span>
                                        <h4><a href="#">Pemetaan</a></h4>
                                    </div>
                                    <p>Pemetaan geografis mendukung mitigasi kebencanaan geologi di Indonesia.
                                        Dengan teknologi canggih, ahli geologi dapat mengidentifikasi daerah rawan bencana seperti gempa, gunung berapi, dan longsor,
                                        serta memetakan pergerakan lempeng tektonik.
                                        Informasi ini memungkinkan pemerintah dan masyarakat mengambil langkah-langkah mitigasi yang tepat,
                                        termasuk infrastruktur tahan gempa, pengaturan penggunaan lahan, dan rencana evakuasi yang efektif.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="emergency_service margin-0">
                                    <div class="emergency_service_item">
                                        <span><i class="fa icon-guard"></i></span>
                                        <h4><a href="#">Peningkatan Kapasitas SDM</a></h4>
                                    </div>
                                    <p>Peningkatan kapasitas SDM mendukung mitigasi kebencanaan geologi di Indonesia.
                                        Melalui pelatihan dan pendidikan, para ahli geologi menjadi lebih terampil dalam memahami bencana alam
                                        dan menerapkan teknik mitigasi yang efektif. SDM yang terlatih memungkinkan pengembangan rencana respons bencana,
                                        pemantauan yang akurat, peringatan dini yang handal, dan bimbingan yang tepat kepada masyarakat.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="emergency_service">
                                    <div class="emergency_service_item margin-0">
                                        <span><i class="fa icon-charity"></i></span>
                                        <h4><a href="#">Sistem Pemantauan Kebencanaan Geologi</a></h4>
                                    </div>
                                    <p>Sistem Pemantauan Kebencanaan Geologi di Indonesia adalah jaringan terintegrasi yang menggunakan teknologi
                                        canggih untuk mendeteksi dan memprediksi bencana alam seperti gempa, erupsi vulkanik, dan longsor.
                                        Dengan bantuan seismometer, GPS, dan sensor lainnya, sistem ini memberikan data akurat tentang aktivitas geologi
                                        dan memberikan peringatan dini kepada masyarakat. Dengan demikian, sistem ini memungkinkan langkah mitigasi yang lebih efektif
                                        dalam melindungi nyawa dan harta benda dari bencana geologi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CITY EMERGENCY SLIDER START-->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery-filterable.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/web/collab/index.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            var collabHandle = CollabHandler.construct({
                o: $, maxPicField: 2,
                maxInvolvedField: 5
            });
            collabHandle.init();
        });
    </script>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
@endpush
