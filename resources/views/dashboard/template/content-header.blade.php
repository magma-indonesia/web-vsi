<div class="content-header">
    <div class="content-search">
        <!-- <i data-feather="search"></i>
        <input type="search" class="form-control" placeholder="Search..."> -->
    </div>
    <nav class="nav">
        @if(auth()->user()->role->slug == 'admin' || auth()->user()->role->slug == 'indi')
            <message-notification-nav-bar
                url="{{ url('') }}"
                messageurl="{{ route('dashboard.layanan-publik.kontak') }}"
            ></message-notification-nav-bar>
        @endif
        <a href="{{ route('logout') }}" class="nav-link"><i data-feather="log-out"></i></a>
        <!-- <a href="{{ route('home') }}" class="nav-link"><i data-feather="home"></i></a> -->
        <!-- <a href="" class="nav-link"><i data-feather="user"></i></a> -->
    </nav>
</div>
