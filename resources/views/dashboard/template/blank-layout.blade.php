<!DOCTYPE html>
<html lang="id">
    @include('dashboard.template.head')
    <body>
        <div class="content ht-100v pd-0">
            <div class="@yield('body-class', 'content-body')">
                <div class="@yield('body-container', 'container pd-r-60 pd-l-60')">
                    @yield('body-content')
                </div>
            </div>
        </div>
        @include('dashboard.template.script')
    </body>
</html>