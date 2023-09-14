<!DOCTYPE html>
<html lang="id">
<head>
    @include('forgot.template.head')
</head>
<body>
    <div class="content content-fixed content-auth" id="app">
        <div class="container">
            <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
                <div class="sign-wrapper">
                    <div class="wd-100p">
                        <h3 class="tx-color-01 mg-b-25">Lupa password</h3>
                        <p class="tx-color-03 tx-16 mg-b-40">Harap isi kolom dibawah ini dengan benar!.</p>
                        <forgot-form 
                            url="{{ route('forgot.post') }}" 
                            csrf="{{ csrf_token() }}"
                            geetestid="{{ env('GEETEST_EVENT_ID') }}" 
                            routelogin="{{ route('login.index') }}"
                        />
                        <div class="justify-content-center d-flex w-100" style="font-size: 12px">
                            Sudah punya akun?&nbsp;<a href="{{ route('login.index') }}">login disini</a>
                        </div>
                        <div class="divider-text">powered by MAGMA Indonesia</div>
                        <h1 class="mg-t-25"><a href="{{ route('home') }}"><img
                                    src="{{ asset('images/pvmbg-logo.svg') }}" alt="Logo PVMBG"></a></h1>
                    </div>
                </div><!-- sign-wrapper -->
            </div><!-- media -->
        </div><!-- container -->
    </div><!-- content -->

    <footer class="footer">
        <div>
            <span>&copy; 2022 PVMBG v1.0.0. </span>
            <span>Powered by <a href="https://magma.esdm.go.id">MAGMA Indonesia</a></span>
        </div>
        <div>
            <nav class="nav">
                <a href="https://magma.esdm.go.id" class="nav-link">MAGMA Indonesia</a>
                <a href="#" class="nav-link">Change Log</a>
                <a href="#" class="nav-link">Get Help</a>
            </nav>
        </div>
    </footer>
    @include('forgot.template.js')
</body>
</html>
