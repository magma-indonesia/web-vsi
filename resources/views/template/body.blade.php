<div class="wrapper">
    @include('components.home.navigation-bar', ['tingkatAktivitas' => $tingkatAktivitas])
    @yield('content')
    <x-home.footer/>
</div>
