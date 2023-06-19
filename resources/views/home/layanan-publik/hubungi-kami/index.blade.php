@extends('template.layout')

@section('title', 'Hubungi Kami')

@section('content')
<!-- SAB BANNER START-->
<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <h2>Hubungi Kami</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Layanan Publik</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('layanan-publik.kontak') }}">Hubungi Kami</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- SAB BANNER END-->

<!-- FORM START-->
<div class="city_blog2_wrap team">
    <div class="container">
        <div class="city_contact_row">
            <div class="city_event_detail contact">
                <div class="section_heading center">
                    <span>Hubungi Kami</span>
                    <h2>Lebih dekat dengan Kami</h2>
                </div>
                <div class="event_booking_form" id="app">
                    <div class="mapouter" style="padding-bottom: 10px;height: 500px;">
                        <div class="gmap_canvas"><iframe width="100%" height="500px" id="gmap_canvas"
                                src="https://maps.google.com/maps?q=Pusat Vulkanologi dan Mitigasi Bencana Geologi&t=&z=15&ie=UTF8&iwloc=&output=embed&language=ID"
                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        </div>
                    </div>
                    <div style="margin-top: 30px;">
                        <b>Pusat Vulkanologi dan Mitigasi Bencana Geologi - Badan Geologi - Kementrian Energi dan Sumber Daya Mineral</b> <br />

                        Jl.Diponegoro No. 57

                        Bandung - Jawa Barat

                        40122 Indonesia <br/>
                        <hr/>
                       Email: <a href="mailto:pvmbg@esdm.go.id">pvmbg@esdm.go.id</a> <br/>
                       Telepon 1: <a href="tel:+62227271402">+62227271402</a><br/>
                       Telepon 2: <a href="tel:+62227272606">+62227272606</a><br/>
                       Fax: <a href="tel:+62227202761">+62227202761</a><br/>
                    </div>
                    <!-- <contact-form csrf="{{ csrf_token() }}" apiurl="{{ env('APP_URL') }}"
                        geetestid="{{ env('GEETEST_EVENT_ID') }}"></contact-form> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FORM END -->
@endsection
