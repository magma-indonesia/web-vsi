@extends('template.layout', ['tingkatAktivitas' => $tingkatAktivitas])

@section('content')
<!--CITY MAIN BANNER START-->
<div class="city_main_banner">
    <div class="main-banner-slider">
        <div>
            <figure class="overlay">
                <img src="extra-images/main-banner-pvmbg.jpg" alt="">
                <div class="banner_text">
                    <div class="small_text animated">Selamat Datang</div>
                    <div class="medium_text animated">di web</div>
                    <div class="banner_btn" style="margin-top: 10px;margin-bottom: 10px;">
                        <a class="theam_btn animated" href="#">MAGMA Indonesia</a>
                        <a class="theam_btn animated" href="#">Portal MGB</a>
                    </div>
                    <div class="banner_search_form">
                        <label>Cari artikel</label>
                        <div class="banner_search_field animated">
                            <input type="text" placeholder="Ketik sesuatu untuk pencarian...">
                            <a href="#"><i class="fa fa-search" style="color: #fff;"></i></a>
                        </div>
                    </div>
                </div>
            </figure>
        </div>

        <div>
            <figure class="overlay">
                <img src="extra-images/main-banner-pvmbg1.jpg" alt="">
                <a href="/images/ikm-pvmbg.png" target="_blank" class="banner_text" style="background: url('/images/ikm-pvmbg.png');background-repeat: no-repeat;background-size: contain;height: 300px;box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%)">
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

        <div>
            <figure class="overlay">
                <img src="extra-images/main-banner-pvmbg2.jpg" alt="">
                <div class="banner_text">
                    <div class="small_text animated">Laporan Aktivitas</div>
                    <div class="medium_text animated">Gunung Api</div>
                    <div class="large_text animated">Jan 2022</div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum modi natus officia repellendus
                        impedit veritatis exercitationem, vitae quidem obcaecati sit adipisci atque tenetur beatae qui
                        dolorem doloribus iste dolorum animi.</p>
                    <a class="theam_btn animated" href="#">Detail</a>
                </div>
            </figure>
        </div>
    </div>
</div>
<!--CITY MAIN BANNER END-->

<div class="city_banner_services">
    <div class="container-fluid">
        <div class="city_service_list">
            <ul>
                <li>
                    <div class="city_service_text">
                        <span><i class="fa fa-map"></i></span>
                        <h5><a href="#">MAGMA Indonesia</a></h5>
                    </div>
                </li>
                <!-- <li>
                    <div class="city_service_text">
                        <span><i class="fa icon-news"></i></span>
                        <h5><a href="#">Informasi Bencana Geologi</a></h5>
                    </div>
                </li> -->
                <li>
                    <div class="city_service_text">
                        <span><i class="fa fa-download"></i></span>
                        <h5><a href="#">Download Peta KRB</a></h5>
                    </div>
                </li>
                <li>
                    <div class="city_service_text">
                        <span><i class="fa icon-cursor"></i></span>
                        <h5><a href="#">Lapor Bencana</a></h5>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="city_jobs_wrap"
    style="background-image: url('https://magma.vsi.esdm.go.id/img/crs/VEN_LEW20220214142737.png')">
    <div class="city_jobs_fig">
        <div class="city_job_text">
            @if ($lastNews)
            @if ($lastNews->news_category_id == '3')
            <h3>Press Release</h3>
            @elseif ($lastNews->news_category_id == '4')
            <h3>Tanggapan Kejadian</h3>
            @elseif ($lastNews->news_category_id == '5')
            <h3>Kajian Kejadian</h3>
            @endif
            <h2>{{ $lastNews->title }}</h2>
            @if ($lastNews->news_category_id == '3')
            <a class="theam_btn_yellow" href="{{ env('APP_URL').'/press-release/'.$lastNews->route }}" tabindex="0">Get
                In Touch</a>
            @elseif ($lastNews->news_category_id == '4')
            <a class="theam_btn_yellow" href="{{ env('APP_URL').'/tanggapan-kejadian/'.$lastNews->route }}"
                tabindex="0">Selengkapnya</a>
            @elseif ($lastNews->news_category_id == '5')
            <a class="theam_btn_yellow" href="{{ env('APP_URL').'/kajian-kejadian/'.$lastNews->route }}"
                tabindex="0">Selengkapnya</a>
            @endif
            @endif
        </div>
    </div>
    <div class="city_jobs_list">
        <ul>
            @if ($pressRelease)
            <li>
                <div class="city_jobs_item overlay">
                    <span><i class="fa icon-volcano-warning" style="font-family: 'magma' !important;"></i></span>
                    <div class="ciy_jobs_caption">
                        <h2>Press Release Gunung Api</h2>
                        <h5>{{ $pressRelease->title }}</h5>
                        <a href="/press-release">Selengkapnya</a>
                    </div>
                </div>
            </li>
            @endif
            @if ($tanggapanKejadian)
            <li>
                <div class="city_jobs_item pull-right overlay">
                    <div class="ciy_jobs_caption ciy_jobs_caption_dark">
                        <h2>Tanggapan Kejadian Gerakan Tanah</h2>
                        <h5>{{ $tanggapanKejadian->title }}</h5>
                        <a href="/tanggapan-kejadian">Selengkapnya</a>
                    </div>
                    <span><i class="fa icon-landslide" style="font-family: 'magma' !important;"></i></span>
                </div>
            </li>
            @endif
            @if ($kajianKejadian)
            <li>
                <div class="city_jobs_item overlay">
                    <span><i class="fa icon-earthquake" style="font-family: 'magma' !important;"></i></span>
                    <div class="ciy_jobs_caption">
                        <h2>Kajian Kejadian Gempa Bumi & Tsunami</h2>
                        <h5>{{ $kajianKejadian->title }}</h5>
                        <a href="/kajian-kejadian">Selengkapnya</a>
                    </div>
                </div>
            </li>
            @endif
        </ul>
    </div>
</div>

<div class="city_news_wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!--SECTION HEADING START-->
                <div class="section_heading margin-bottom">
                    <span>Informasi</span>
                    <h2>News Releases</h2>
                </div>
                @if ($lastNews)
                <!--SECTION HEADING START-->
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="city_news_fig">
                            <figure class="box">
                                <div class="box-layer layer-1"></div>
                                <div class="box-layer layer-2"></div>
                                <div class="box-layer layer-3"></div>
                                <img src="{{ $lastNews->thumbnail }}" alt="">
                            </figure>
                            <div class="city_news_text">
                                <h2>{{ $lastNews->title }}</h2>
                                <ul class="city_news_meta">
                                    <li><a href="#">{{ date('d F Y', strtotime($lastNews->created_at))}}</a></li>
                                    <li><a href="#">{{ $lastNews->created_by }}</a></li>
                                </ul>
                                @if ($lastNews->news_category_id == '3')
                                <a class="theam_btn border-color color"
                                    href="{{ env('APP_URL').'/press-release/'.$lastNews->route }}" tabindex="0">Read
                                    more</a>
                                @elseif ($lastNews->news_category_id == '4')
                                <a class="theam_btn border-color color"
                                    href="{{ env('APP_URL').'/tanggapan-kejadian/'.$lastNews->route }}"
                                    tabindex="0">Read more</a>
                                @elseif ($lastNews->news_category_id == '5')
                                <a class="theam_btn border-color color"
                                    href="{{ env('APP_URL').'/kajian-kejadian/'.$lastNews->route }}" tabindex="0">Read
                                    more</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="city_news_row">
                            <ul>
                                <li>
                                    <div class="city_news_list">
                                        <figure class="box">
                                            <div class="box-layer layer-1"></div>
                                            <div class="box-layer layer-2"></div>
                                            <div class="box-layer layer-3"></div>
                                            <img src="extra-images/news-fig1.jpg" alt="">
                                        </figure>
                                        <div class="city_news_list_text">
                                            <h5>Lorem Ipsum Proin gravida nibh </h5>
                                            <ul class="city_news_meta">
                                                <li><a href="#">May 22, 2018</a></li>
                                                <li><a href="#">Public Notices</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="city_news_list">
                                        <figure class="box">
                                            <div class="box-layer layer-1"></div>
                                            <div class="box-layer layer-2"></div>
                                            <div class="box-layer layer-3"></div>
                                            <img src="extra-images/news-fig2.jpg" alt="">
                                        </figure>
                                        <div class="city_news_list_text">
                                            <h5>Lorem Ipsum Proin gravida nibh </h5>
                                            <ul class="city_news_meta">
                                                <li><a href="#">May 22, 2018</a></li>
                                                <li><a href="#">Public Notices</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="city_news_list">
                                        <figure class="box">
                                            <div class="box-layer layer-1"></div>
                                            <div class="box-layer layer-2"></div>
                                            <div class="box-layer layer-3"></div>
                                            <img src="extra-images/news-fig3.jpg" alt="">
                                        </figure>
                                        <div class="city_news_list_text">
                                            <h5>Lorem Ipsum Proin gravida nibh </h5>
                                            <ul class="city_news_meta">
                                                <li><a href="#">May 22, 2018</a></li>
                                                <li><a href="#">Public Notices</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="city_news_list">
                                        <figure class="box">
                                            <div class="box-layer layer-1"></div>
                                            <div class="box-layer layer-2"></div>
                                            <div class="box-layer layer-3"></div>
                                            <img src="extra-images/news-fig4.jpg" alt="">
                                        </figure>
                                        <div class="city_news_list_text">
                                            <h5>Lorem Ipsum Proin gravida nibh </h5>
                                            <ul class="city_news_meta">
                                                <li><a href="#">May 22, 2018</a></li>
                                                <li><a href="#">Public Notices</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="city_news_list">
                                        <figure class="box">
                                            <div class="box-layer layer-1"></div>
                                            <div class="box-layer layer-2"></div>
                                            <div class="box-layer layer-3"></div>
                                            <img src="extra-images/news-fig5.jpg" alt="">
                                        </figure>
                                        <div class="city_news_list_text">
                                            <h5>Lorem Ipsum Proin gravida nibh </h5>
                                            <ul class="city_news_meta">
                                                <li><a href="#">May 22, 2018</a></li>
                                                <li><a href="#">Public Notices</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="city_news_form">
                    <div class="city_news_feild">
                        <span>Signup</span>
                        <h4>Newsletter</h4>
                        <p>This is Photoshop's version of Lorem Ipsum. Proin gravida </p>
                        <div class="city_news_search">
                            <input type="text" name="text" placeholder="Enter Your Email Adress Here" required="">
                            <button class="theam_btn border-color color">Subcribe Now</button>
                        </div>
                    </div>
                    <div class="city_news_feild feild2">
                        <span>Recent</span>
                        <h4>Documents</h4>
                        <p>This is Photoshop's version of Lorem Ipsum. Proin gravida </p>
                        <div class="city_document_list">
                            <ul>
                                <li><a href="#"><i class="fa icon-document"></i>Council Agenda April 24, 2015 (27
                                        kB)</a></li>
                                <li><a href="#"><i class="fa icon-document"></i>Council Agenda April 24, 2015 (27
                                        kB)</a></li>
                                <li><a href="#"><i class="fa icon-document"></i>Council Agenda April 24, 2015 (27
                                        kB)</a></li>
                                <li><a href="#"><i class="fa icon-document"></i>Council Agenda April 24, 2015 (27
                                        kB)</a></li>
                                <li><a href="#"><i class="fa icon-document"></i>Council Agenda April 24, 2015 (27
                                        kB)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
