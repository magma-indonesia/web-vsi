<script src="{{ asset('dashforge/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dashforge/lib/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('dashforge/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
@if (config('app.debug'))
    <script src="{{ asset('dashforge/lib/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('dashforge/lib/jquery.flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('dashforge/lib/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('dashforge/lib/chart.js/Chart.bundle.min.js') }}"></script>
    @if (request()->is('dashboard'))
        <script src="{{ asset('dashforge/assets/js/dashforge.sampledata.js') }}"></script>
        <script src="{{ asset('dashforge/assets/js/dashboard-one.js') }}"></script>
    @endif
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
