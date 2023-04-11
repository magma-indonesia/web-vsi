@extends('template.layanan-publik.layout')

@section('title', 'Hubungi Kami')

@push('styles')
<link href="{{ asset('css/selectric.css') }}" rel="stylesheet">
@endpush

@section('body')
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
                <div class="event_booking_form">
                    <form method="POST" action="{{ route('layanan-publik.kontak.save') }}">
                        <div style="margin-top: 10px;display: flex;justify-content: center;">
                            @if(session('success') || session('error'))
                            @if (session('success'))
                            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                            @else
                            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                            @endif
                            @endif
                        </div>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="event_booking_field">
                                    <input type="text" placeholder="Nama" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="event_booking_field">
                                    <input type="email" placeholder="Email" name="email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="event_booking_field">
                                    <input type="text" placeholder="Subject" name="subject">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="event_booking_area">
                                    <textarea name="message" placeholder="Ketik pesan disini"></textarea>
                                </div>
                                <input type="hidden" name="token" id="recaptcha">
                                <button class="theam_btn btn2" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FORM END -->
@endsection

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITEKEY') }}"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('{{ env("RECAPTCHA_SITEKEY") }}', {
            action: 'register'
        }).then(function (token) {
            if (token) {
                document.getElementById('recaptcha').value = token;
            }
        });
    });

</script>
<script src="{{ asset('js/jquery-filterable.js') }}"></script>
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/web/collab/index.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var collabHandle = CollabHandler.construct({
            maxPicField: 2,
            maxInvolvedField: 5
        });
        collabHandle.init();
    });

</script>
@endpush
