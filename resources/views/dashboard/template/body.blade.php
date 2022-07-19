<div class="content ht-100v pd-0">
    <div class="content-header">
        <div class="content-search">
            <i data-feather="search"></i>
            <input type="search" class="form-control" placeholder="Search...">
        </div>
        <nav class="nav">
            <a href="{{ route('home') }}" class="nav-link"><i data-feather="home"></i></a>
            <a href="" class="nav-link"><i data-feather="user"></i></a>
            <a href="" class="nav-link"><i data-feather="log-out"></i></a>
        </nav>
    </div>

    <div class="@yield('body-class', 'content-body')">
        <div class="@yield('body-container', 'container pd-r-60 pd-l-60')">
            @yield('body-content')
        </div>
    </div>
</div>
