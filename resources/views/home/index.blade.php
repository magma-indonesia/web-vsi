@extends('template.layout')

@section('content')
<!--CITY MAIN BANNER START-->
<div class="city_main_banner">
    <div class="main-banner-slider">
        <div>
            <figure class="overlay">
                <img src="extra-images/main-banner-pvmbg.jpg" alt="">
                <div class="banner_text" style="padding: 20px 30px">
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
                <a href="/images/ikm-pvmbg.png" target="_blank" class="banner_text"
                    style="background: url('/images/ikm-pvmbg.png');background-repeat: no-repeat;background-size: contain;height: 300px;box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%)">
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
        @if ($pengumuman)
        <div>
            <figure class="overlay">
                <img src="extra-images/main-banner-pvmbg2.jpg" alt="">
                <div class="banner_text" style="padding: 20px 30px">
                    <div class="small_text animated">{{ $pengumuman->title }}</div>
                    <p>{!! $pengumuman->content !!}</p>
                </div>
            </figure>
        </div>
        @endif
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

@if (isset($news) && count($news) > 0)
<div class="city_jobs_wrap" style="background-image: url('{{ $news[0]->thumbnail }}'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
    ">
    @else
    <div class="city_jobs_wrap" style="background-image: url('https://magma.vsi.esdm.go.id/img/crs/VEN_LEW20220214142737.png'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
    ">
        @endif
        <div class="city_jobs_fig">
            <div class="city_job_text">
                @if (isset($news) && count($news) > 0)
                <h3>{{ $news[0]->type }}</h3>
                <h2>{{ (strlen($news[0]->title) > 25) ? substr($news[0]->title,0,25).'...' : $news[0]->title  }}</h2>
                <a class="theam_btn_yellow" href="{{ $news[0]->link }}" tabindex="0">Selengkapnya</a>
                @else
                <h3>Belum ada data</h3>
                <h2>------------------</h2>
                @endif
            </div>
        </div>
        <div class="city_jobs_list">
            <ul style="margin-bottom: 0;">
                <li>
                    <div class="city_jobs_item overlay">
                        <span><i class="fa icon-volcano-warning" style="font-family: 'magma' !important;"></i></span>
                        <div class="ciy_jobs_caption">
                            <h2>Press Release Gunung Api</h2>
                            @if ($pressRelease)
                            <h5>{{ (strlen($pressRelease->title) > 25) ? substr($pressRelease->title,0,25).'...' : $pressRelease->title  }}
                            </h5>
                            <a href="/press-release">Selengkapnya</a>
                            @else
                            <h5>Belum ada data</h5>
                            @endif
                        </div>
                    </div>
                </li>
                <li>
                    @if ($tanggapanKejadian)
                    <div class="city_jobs_item pull-right overlay" style="background-image: url('{{ $tanggapanKejadian->thumbnail }}'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
    ">
                        @else
                        <div class="city_jobs_item pull-right overlay" style="background-image: url('/images/gertan.jpeg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
    ">
                            @endif
                            <div class="ciy_jobs_caption ciy_jobs_caption_dark">
                                <h2>Tanggapan Kejadian Gerakan Tanah</h2>
                                @if ($tanggapanKejadian)
                                <h5 style="color: #fff">
                                    {{ (strlen($tanggapanKejadian->title) > 25) ? substr($tanggapanKejadian->title,0,25).'...' : $tanggapanKejadian->title  }}
                                </h5>
                                <a href="/tanggapan-kejadian">Selengkapnya</a>
                                @else
                                <h5 style="color: #fff">Belum ada data</h5>
                                @endif
                            </div>
                            <span><i class="fa icon-landslide" style="font-family: 'magma' !important;"></i></span>
                        </div>
                </li>
                <li>
                    <div class="city_jobs_item overlay">
                        <span><i class="fa icon-earthquake" style="font-family: 'magma' !important;"></i></span>
                        <div class="ciy_jobs_caption">
                            <h2>Kajian Kejadian Gempa Bumi & Tsunami</h2>
                            @if ($kajianKejadian)
                            <h5>{{ (strlen($kajianKejadian->title) > 25) ? substr($kajianKejadian->title,0,25).'...' : $kajianKejadian->title  }}
                            </h5>
                            <a href="/kajian-kejadian">Selengkapnya</a>
                            @else
                            <h5>Belum ada data</h5>
                            @endif
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="city_news_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!--SECTION HEADING START-->
                    <div class="section_heading margin-bottom">
                        <span>Terbaru</span>
                        @if (isset($news) && count($news) > 0)
                        <h2>{{ $news[0]->type }}</h2>
                        @else
                        <h2>Belum ada data</h2>
                        @endif
                    </div>
                    @if (isset($news) && count($news) > 0)
                    <!--SECTION HEADING START-->
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="city_news_fig">
                                <figure class="box">
                                    <a href="{{ $news[0]->link }}">
                                        <div class="box-layer layer-1"></div>
                                        <div class="box-layer layer-2"></div>
                                        <div class="box-layer layer-3"></div>
                                        <img src="{{ $news[0]->thumbnail ? $news[0]->thumbnail : '/images/mican.png'  }}"
                                            alt="">
                                    </a>
                                </figure>
                                <div class="city_news_text">
                                    <h2>
                                        <a href="{{ $news[0]->link }}">
                                            {{ (strlen($news[0]->title) > 25) ? substr($news[0]->title,0,25).'...' : $news[0]->title  }}
                                        </a>
                                    </h2>
                                    <div class="flex items-center" style="margin-bottom: 10px;">
                                        <div style="border-right: 2px solid #333;padding-right: 10px;">
                                            {{ date('d F Y', strtotime($news[0]->created_at))}}</div>
                                        <div style="padding-left: 10px;">{{ $news[0]->created_by }}</div>
                                    </div>
                                    <p>
                                        {!! strip_tags((strlen($news[0]->content) > 250) ? substr($news[0]->content,0,250).'...' : $news[0]->content)  !!}
                                    </p>
                                    <a class="theam_btn border-color color" href="{{ $news[0]->link }}" tabindex="0">
                                        Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="city_news_row">
                                <ul>
                                    @if (count($news) > 0)
                                    @foreach ($news as $n)
                                    <li>
                                        <div class="city_news_list">
                                            <figure class="box">
                                                <a href="{{ $n->link }}">
                                                    <div class="box-layer layer-1"></div>
                                                    <div class="box-layer layer-2"></div>
                                                    <div class="box-layer layer-3"></div>
                                                    <img src="{{ $n->thumbnail ? $n->thumbnail : '/images/mican.png' }}"
                                                        alt="" style="width: 104px;height: 102px;object-fit: cover"/>
                                                </a>
                                            </figure>
                                            <div class="city_news_list_text">
                                                <h5>
                                                    <a href="{{ $n->link }}" title="{{ $n->title }}">
                                                    {{ (strlen($n->title) > 25) ? substr($n->title,0,25).'...' : $n->title }}
                                                    </a>
                                                </h5>
                                                <div class="flex items-center" style="margin-bottom: 10px;">
                                                    <div style="border-right: 2px solid #333;padding-right: 10px;">
                                                        {{ date('d F Y', strtotime($n->created_at))}}</div>
                                                    <div style="padding-left: 10px;">{{ $n->created_by }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    @else
                                    <div>No data news...</div>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="city_news_fig">
                                <result-not-found />
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="city_news_form">
                        <div class="city_news_feild feild2">
                            <h4>Status Gunung Api</h4>
                            <p>Daftar status gunung api diatas normal</p>
                            <div class="city_document_list">
                                <status-gunung data="{{ $statusGunung }}"></status-gunung>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
