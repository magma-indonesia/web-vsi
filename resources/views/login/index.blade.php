<!DOCTYPE html>
<html lang="id">
<head>
    @include('login.template.head')
</head>
<body>
    <div class="content content-fixed content-auth" id="app">
        <div class="container">
            <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
                <div class="sign-wrapper">
                    <div class="wd-100p">
                        <h3 class="tx-color-01 mg-b-25">Login</h3>
                        <p class="tx-color-03 tx-16 mg-b-40">Selamat Datang di Website PVMBG.</p>
                        <login-form
                            url="{{ route('login.post') }}"
                            csrf="{{ csrf_token() }}"
                            routeforget="{{ route('forgot.index') }}"
                            geetestid="{{ env('GEETEST_EVENT_ID') }}"></login-form>
                        <div class="justify-content-center d-flex w-100" style="font-size: 12px">
                            Belum punya akun?&nbsp;<a href="{{ route('register.index') }}">daftar disini</a>
                        </div><hr>
                        <h1 class="mg-t-25"><a href="{{ route('home') }}"><img
                                    src="{{ asset('images/pvmbg-logo.svg') }}" alt="Logo PVMBG"></a></h1>
                    </div>
                </div><!-- sign-wrapper -->
            </div><!-- media -->
        </div><!-- container -->
    </div><!-- content -->

    <footer class="footer">
        <div>
            <span>&copy; 2023 PVMBG</span>
        </div>
        <div>
            <nav class="nav">
                <a href="#" class="nav-link">Change Log</a>
                <a href="#" class="nav-link">Get Help</a>
            </nav>
        </div>
    </footer>
    @include('login.template.js')
</body>
</html>
