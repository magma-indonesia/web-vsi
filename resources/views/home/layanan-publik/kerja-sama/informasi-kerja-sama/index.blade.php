@extends('template.layanan-publik.layout')

@section('title', 'Informasi Kerja Sama')

@section('body')
<!-- SAB BANNER START-->
<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <h2>Informasi Kerja Sama</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('layanan-publik.kerja-sama.informasi-kerja-sama') }}">Layanan Publik</a></li>
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
                    <p>Kerja sama PVMBG melingkupi kerja sama di bidang bencana geologi yang meliputi kegiatan penyelidikan, pemantauan,
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
                            <li class="active"><a href="#tab1"> Gunung Api</a></li>
                            <li><a href="#tab2">Gerakan Tanah</a></li>
                            <li><a href="#tab3">Gempa Bumi dan Tsunami</a></li>
                        </ul>
                    </div>
                    <!-- CITY SERVICE TABS END-->

                    <!-- CITY SIDE INFO START-->
                    <div class="city_side_info">
                        <span><i class="fa fa-github"></i></span>
                        <h4>Let’s Help You</h4>
                        <h6>908-879-5100 89, <br>Avenue 454 <br> NY, USA</h6>
                    </div>
                    <!-- CITY SIDE INFO END-->

                    <!-- CITY NOTICE START-->
                    <div class="city_notice">
                        <h4>Public Notice</h4>
                        <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis
                            sem nibh id elit</p>
                        <a class="theam_btn" href="#" tabindex="0">Download PDF</a>
                    </div>
                    <!-- CITY NOTICE END-->
                </div>
            </div>
            <div class="col-md-9">
                <!-- TABS START-->
                <div class="tabs">
                    <div class="tab-content">
                        <div id="tab1" class="tab active">
                            <div class="city_service_tabs_list">
                                <figure class="box">
                                    <div class="box-layer layer-1"></div>
                                    <div class="box-layer layer-2"></div>
                                    <div class="box-layer layer-3"></div>
                                    <img src="{{ asset("extra-images/informasi-kerja-sama-gunung-api.png") }}" alt="">
                                </figure>
                                <div class="city_service_tabs_text">
                                    <h3>Gunung Api</h3>

                                    <p>Indonesia memiliki sekitar 127 gunung api aktif. Berdasarkan catatan sejarah, terdapat 42 gunung api di Indonesia yang
                                    aktivitas erupsinya mengakibatkan kematian. Keberadaan 127 gunung api aktif ini dapat dikelompokkan berdasarkan sejarah
                                    aktivitasnya, yaitu Gunung Api Tipe A yang memiliki catatan sejarah letusan sejak tahun 1600 sejumlah 76 gunung api;
                                    Gunung Api Tipe B yang memiliki catatan sejarah letusan sebelum tahun 1600 sejumlah 30 gunung api; dan Gunung Api Tipe C
                                    yang tidak memiliki catatan sejarah letusan tetapi masih memperlihatkan jejak aktivitas vulkanik, seperti solfatara atau
                                    fumarole, sejumlah 21 gunung api. Banyaknya gunung api aktif dengan sifat dan ciri erupsi yang berlainan menyebabkan
                                    diperlukannya antisipasi kemungkinan timbulnya bencana akibat bahaya gunung api tersebut secara komprehensif dalam upaya
                                    pengurangan risiko bencana erupsi gunung api.</p>
                                    <h5>Tugas dan Peran</h5>
                                    <p>Kelompok substansi gunung api memiliki tugas antara lain pengamatan, penetapan status, peringatan dini, rekomendasi
                                    teknis mitigasi bencana gunung api; penyelidikan, pemantauan, pemetaan tematik, pemodelan bahaya, dan penyebaran
                                    informasi gunung api. Kelompok substansi ini merupakan bidang kebencanaan geologi yang menjadi cikal bakal PVMBG, yaitu
                                    sejak tahun 1920. Maka dari itu, kelompok substansi gunung api memiliki sumber data lapangan yang lebih kaya,
                                    perlengkapan dan peralatan yang beragam, serta SDM yang relatif banyak apabila dibandingkan dengan kelompok substansi
                                    lainnya.
                                    </p>

                                    <p>Dari uraian tugas sebelumnya, peran kelompok substansi gunung api dalam mitigasi adalah pembuatan Kawasan Rawan Bencana
                                    (KRB) Gunung Api; Peta Geologi Gunung Api; Press Release (Berita); Rekomendasi Teknis; dan VONA (Volcano Observatory
                                    Notice for Aviation).
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div id="tab2" class="tab">
                            <div class="city_service_tabs_list">
                                <figure class="box">
                                    <div class="box-layer layer-1"></div>
                                    <div class="box-layer layer-2"></div>
                                    <div class="box-layer layer-3"></div>
                                    <img src="extra-images/service-tabs1.jpg" alt="">
                                </figure>
                                <div class="city_service_tabs_text">
                                    <h3>Gerakan Tanah </h3>
                                    <p>Di Indonesia, bencana gerakan tanah disebabkan oleh beberapa faktor seperti morfologi, Kondisi Geologi (batuan dan
                                    pelapukannya, stratigrafi, struktur geologi), pola aliran sungai, dan perubahan penggunaan lahan yang dapat dipicu oleh
                                    curah hujan dan guncangan gempa bumi. Bencana gerakan tanah biasanya merupakan bencana yang terjadi secara lokal dengan
                                    cakupan daerah terdampak yang relatif kecil, namun tetap harus diwaspadai dan dianalisis pada skala yang cukup besar.
                                    Analisis dan pemetaan gerakan tanah diatur dalam SNI 8291-2016 tentang Zonasi Gerakan Tanah dari Skala Detail sampai
                                    Regional. Berdasarkan standar tersebut, peta kerentanan gerakan tanah yang dibuat oleh Badan Geologi menunjukkan empat
                                    zona yang berbeda dari zona dengan gerakan tanah yang tinggi, menengah, rendah, dan sangat rendah.</p>

                                    <h5>Tugas dan Peran</h5>
                                    <p>Tugas pokok Kelompok Substansi Mitigasi Bencana Gerakan Tanah melingkupi penyiapan penyusunan kebijakan teknis, norma,
                                    standar, prosedur, kriteria, rencana, pelaporan, pemetaan, pemodelan bahaya, penyelidikan, pemantauan, dan peringatan
                                    dini potensi gerakan tanah, dan rekomendasi teknis mitigasi gerakan tanah, serta penyebaran informasi gerakan tanah.
                                    Proses kerja kelompok substansi gerakan tanah dari tahun 2016 hingga 2020 berupa, penyelidikan, peringatan dini,
                                    pemantauan, sosialisasi serta kegiatan tanggap darurat dan pasca bencana.
                                    </p>

                                    <p>Cakupan kerja kelompok substansi gerakan tanah
                                    meliputi seluruh wilayah Indonesia. Produk- produk yang dihasilkan kelompok substansi gerakan tanah antara lain Peta
                                    Zona Kerentanan Gerakan Tanah (ZKGT); peta prakiraan potensi terjadinya gerakan tanah dan banjir bandang bulanan yang di
                                    publish setiap bulan; Press Release (Berita); dan Rekomendasi Teknis. Selain itu, kelompok substansi gerakan tanah juga
                                    melakukan pemutakhiran terhadap sistem pemantauan gerakan tanah bersama BPPTKG.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div id="tab3" class="tab">
                            <div class="city_service_tabs_list">
                                <figure class="box">
                                    <div class="box-layer layer-1"></div>
                                    <div class="box-layer layer-2"></div>
                                    <div class="box-layer layer-3"></div>
                                    <img src="{{ asset("extra-images/informasi-kerja-sama-gempa-bumi.png") }}" alt="">
                                </figure>
                                <div class="city_service_tabs_text">
                                    <h3>Gempa Bumi dan Tsunami</h3>
                                    <p>Ancaman geologi lain yaitu bencana gempa bumi. Gempa bumi adalah getaran pada kulit bumi yang disebabkan oleh proses
                                    pelepasan energi secara tiba-tiba dari dalam bumi akibat pertemuan antar lempeng ataupun aktivitas sesar aktif di darat
                                    dan di laut (Permen ESDM No. 15/2011). Dengan melihat kondisi akibat dari gempa bumi, analisis geologi untuk tata ruang
                                    harus dilakukan terhadap dua parameter utama, yaitu menganalisis sumber gempa bumi dan respons permukaan tanah terhadap
                                    efek penguatan gempa bumi (amplifikasi). Untuk mengantisipasi bencana gempa bumi, Indonesia mengeluarkan peta berstandar
                                    SNI yang dapat digunakan dalam penataan ruang di seluruh wilayah Indonesia. Akan tetapi peta ini didasarkan pada
                                    percepatan spektrum, bukan berdasarkan peak ground acceleration (PGA), peak ground velocity (PGV), atau faktor zona.</p>

                                    <p>Tsunami adalah gelombang laut, yang diakibatkan oleh proses geologi bawah laut, baik berupa gempa bumi, letusan gunung
                                    api, maupun longsoran. Analisis bahaya tsunami mengestimasi kawasan pesisir yang rawan. Tsunami dan karakteristik sumber
                                    pembangkit tsunami (tsunamigenic). Zona bahaya tsunami menetapkan potensi dampak tsunami terhadap daerah tertentu dengan
                                    mengkategorikan intensitas yang berbeda, di mana intensitas tersebut bergantung pada ketinggian gelombang dan elevasi
                                    permukaan tanah. Pada bahaya tsunami dari badan geologi menetapkan tiga zona bahaya. Klasifikasi ini didasarkan pada
                                    kejadian historis tsunami, lokasi pantai yang terkait dengan episenter, dan perkiraan tinggi gelombang.</p>

                                    <h5>Tugas dan Peran</h5>
                                    <p>Kelompok Substansi Mitigasi Gempa Bumi dan Tsunami memiliki tugas penyiapan penyusunan kebijakan teknis, norma, standar,
                                    prosedur, kriteria, rencana, pelaporan, pemetaan dan rekomendasi teknis mitigasi gempa bumi dan tsunami, penyelidikan,
                                    pemodelan bahaya serta penyebaran informasi gempa bumi dan tsunami.
                                    </p>

                                    <p>Produk kelompok mitigasi gempa bumi dan tsunami,
                                    seperti Peta KRB Gempa Bumi dan Tsunami untuk menunjang penataan ruang. Selain itu kelompok substansi gempa bumi dan
                                    tsunami juga melakukan penyelidikan tanggap darurat dan perumusan rekomendasi teknis ketika terjadi bencana.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TABS END-->

                <!-- CITY EMERGENCY SLIDER START-->
                <div class="city_emergency_slider">
                    <h3 class="service_title">Emergency Department</h3>
                    <div class="city-emergency-slide">
                        <div>
                            <div class="city_emergency_slide_fig">
                                <figure class="box">
                                    <div class="box-layer layer-1"></div>
                                    <div class="box-layer layer-2"></div>
                                    <div class="box-layer layer-3"></div>
                                    <img src="extra-images/emergency_fig.jpg" alt="">
                                </figure>
                                <div class="city_emergency_slide_text">
                                    <h5><a href="#">Fire Department</a></h5>
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
                                    <img src="extra-images/emergency_fig1.jpg" alt="">
                                </figure>
                                <div class="city_emergency_slide_text">
                                    <h5><a href="#">Disaster Department</a></h5>
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
                                    <img src="extra-images/emergency_fig2.jpg" alt="">
                                </figure>
                                <div class="city_emergency_slide_text">
                                    <h5><a href="#">Police Department</a></h5>
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
                                    <img src="extra-images/emergency_fig1.jpg" alt="">
                                </figure>
                                <div class="city_emergency_slide_text">
                                    <h5><a href="#">Fire Department</a></h5>
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
                    <h3 class="service_title">Emergency Services</h3>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="emergency_service">
                                <div class="emergency_service_item">
                                    <span><i class="fa icon-charity"></i></span>
                                    <h4><a href="#">Servicees 24/7</a></h4>
                                </div>
                                <p>Poin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                                    bibendum auctor vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                                    bibendum auctor</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="emergency_service">
                                <div class="emergency_service_item">
                                    <span><i class="fa  icon-healthcare-and-medical"></i></span>
                                    <h4><a href="#">Fire Safety</a></h4>
                                </div>
                                <p>Poin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                                    bibendum auctor vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                                    bibendum auctor</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="emergency_service margin-0">
                                <div class="emergency_service_item">
                                    <span><i class="fa icon-help"></i></span>
                                    <h4><a href="#">Training</a></h4>
                                </div>
                                <p>Poin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                                    bibendum auctor vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                                    bibendum auctor</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="emergency_service margin-0">
                                <div class="emergency_service_item">
                                    <span><i class="fa icon-guard"></i></span>
                                    <h4><a href="#">Support Servicecs</a></h4>
                                </div>
                                <p>Poin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                                    bibendum auctor vel velit auctor aliquet. Aenean sollicitudin, lorem quis
                                    bibendum auctor</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CITY EMERGENCY SLIDER START-->

                <!-- CITY EMERGENCY CALL START-->
                <div class="city_emergency_info">
                    <div class="city_emergency_call">
                        <h5>Important Telephone Numbers Energency</h5>
                        <ul>
                            <li><a href="#">Emergency</a></li>
                            <li><a href="#">911</a></li>
                            <li><a href="#">Fire Department</a></li>
                            <li><a href="#">(709) 111-2222-333 </a></li>
                            <li><a href="#">Police Department</a></li>
                            <li><a href="#">(709) 111-2222-333 </a></li>
                            <li><a href="#">Environmental Emergency</a></li>
                            <li><a href="#">(709) 111-2222-333</a></li>
                            <li><a href="#">Health Science Centre</a></li>
                            <li><a href="#">(709) 111-2222-333</a></li>
                            <li><a href="#">Children's Health and Rehabilitation Centre</a></li>
                            <li><a href="#">(709) 111-2222-333</a></li>
                        </ul>
                    </div>
                </div>
                <!-- CITY EMERGENCY CALL END-->
            </div>
        </div>
    </div>
</div>
@endsection
