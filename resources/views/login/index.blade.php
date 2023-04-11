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
                        <p class="tx-color-03 tx-16 mg-b-40">Halo selamat datang! Harap gunakan NIP dan password MAGMA
                            Anda untuk masuk ke dalam Dashboard.</p>
                        <login-form url="{{ route('login.post') }}" csrf="{{ csrf_token() }}"
                            routeforget="{{ route('forgot.index') }}"></login-form>
                        <div class="justify-content-center d-flex w-100" style="font-size: 12px">
                            Belum punya akun?&nbsp;<a href="{{ route('register.index') }}">daftar disini</a>
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

    {{-- <form action="{{ route('login.post') }}" method="post">
    @csrf
    <input name="username" type="text">
    <input name="password" type="password">
    <button type="submit">Submit</button>
    </form> --}}
    @include('login.template.js')
</body>
</html>
