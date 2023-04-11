<script src="{{ asset('dashforge/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dashforge/lib/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('dashforge/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

@if (config('app.debug'))
<script src="{{ asset('dashforge/lib/jquery.flot/jquery.flot.js') }}"></script>
<script src="{{ asset('dashforge/lib/jquery.flot/jquery.flot.stack.js') }}"></script>
<script src="{{ asset('dashforge/lib/jquery.flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('dashforge/lib/chart.js/Chart.bundle.min.js') }}"></script>
@endif

@yield('add-vendor-script')
<script src="{{ asset('dashforge/assets/js/dashforge.js') }}"></script>
<script src="{{ asset('dashforge/assets/js/dashforge.aside.js') }}"></script>

@yield('add-script')

@stack('scripts')

<style>
    .pagination{
        float: right;
    }
</style>
