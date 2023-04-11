@extends('template.layout')

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
                    <div class="large_text animated"><span id='text'></span>
                        <div class='console-underscore' id='console'>&#95;</div>
                    </div>
                    <div class="banner_btn">
                        <a class="theam_btn animated" href="#">Daftar Layanan</a>
                        <a class="theam_btn animated" href="#">MAGMA Indonesia</a>
                    </div>
                    <div class="banner_search_form">
                        <label>Search Here</label>
                        <div class="banner_search_field animated">
                            <input type="text" placeholder="What  do you want to do">
                            <a href="#"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                </div>
            </figure>
        </div>

        <div>
            <figure class="overlay">
                <img src="extra-images/main-banner-pvmbg1.jpg" alt="">
                <div class="banner_text">
                    <div class="small_text animated">Peringatan Dini</div>
                    <div class="medium_text animated">Gerakan Tanah</div>
                    <div class="large_text animated">Nov 2021</div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum modi natus officia repellendus
                        impedit veritatis exercitationem, vitae quidem obcaecati sit adipisci atque tenetur beatae qui
                        dolorem doloribus iste dolorum animi.</p>
                    <a class="theam_btn animated" href="#">Detail</a>
                </div>
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
            <h3>Informasi Letusan</h3>
            <h2>Gunung Api Ibu</h2>
            <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean
                sollicitudin, lorem quis </p>
            <a class="theam_btn_yellow" href="#" tabindex="0">Get In Touch</a>
        </div>
    </div>
    <div class="city_jobs_list">
        <ul>
            <li>
                <div class="city_jobs_item overlay">
                    <span><i class="fa icon-volcano-warning" style="font-family: 'magma' !important;"></i></span>
                    <div class="ciy_jobs_caption">
                        <h2>Laporan Gunung Api</h2>
                        <p>This is Photoshop's ersion of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
                            Aenean sollicitudin</p>
                        <a href="#">Find Out More</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="city_jobs_item pull-right overlay">
                    <div class="ciy_jobs_caption ciy_jobs_caption_dark">
                        <h2>Tanggapan Kejadian Gerakan Tanah</h2>
                        <p>This is Photoshop's ersion of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
                            Aenean sollicitudin</p>
                        <a href="#">Find Out More</a>
                    </div>
                    <span><i class="fa icon-landslide" style="font-family: 'magma' !important;"></i></span>
                </div>
            </li>
            <li>
                <div class="city_jobs_item overlay">
                    <span><i class="fa icon-earthquake" style="font-family: 'magma' !important;"></i></span>
                    <div class="ciy_jobs_caption">
                        <h2>Kajian Kejadian Gempa Bumi dan Tsunami</h2>
                        <p>This is Photoshop's ersion of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
                            Aenean sollicitudin</p>
                        <a href="#">Find Out More</a>
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
                    <span>Welcome to Local City</span>
                    <h2>News Releases</h2>
                </div>
                <!--SECTION HEADING START-->
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="city_news_fig">
                            <figure class="box">
                                <div class="box-layer layer-1"></div>
                                <div class="box-layer layer-2"></div>
                                <div class="box-layer layer-3"></div>
                                <img src="extra-images/news-fig.jpg" alt="">
                            </figure>
                            <div class="city_news_text">
                                <h2>A Fundraiser for the City Club</h2>
                                <ul class="city_news_meta">
                                    <li><a href="#">May 22, 2018</a></li>
                                    <li><a href="#">Public Notices</a></li>
                                </ul>
                                <p>Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem
                                    quis bibendum auctor, nisi elit consequat ipsum, nec sollicitudin</p>
                                <a class="theam_btn border-color color" href="#" tabindex="0">Read More</a>
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
