<!DOCTYPE html>
<html lang="id">
<head>
@include('login.template.head')
</head>
<body>
<div class="content content-fixed content-auth">
    <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
            <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
                <div class="wd-100p">
                    <h3 class="tx-color-01 mg-b-5">Login</h3>
                    <p class="tx-color-03 tx-16 mg-b-40">Welcome back! Please signin to continue.</p>

                    <form action="{{ route('login.post') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan NIP">
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mg-b-5">
                                <label class="mg-b-0-f">Password</label>
                                <a href="" class="tx-13">Forgot password?</a>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password">
                        </div>

                        @if($errors->isNotEmpty())
                        <div class="form-group">
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif

                        <button type="submit" class="btn btn-brand-02 btn-block">Login</button>
                    </form>

                    <div class="divider-text">powered by MAGMA Indonesia</div>
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
</body>
</html>
