<aside class="aside aside-fixed">
    <div class="aside-header">
        <a href="{{ route('dashboard.index') }}" class="aside-logo">dash<span>board</span></a>
        <a href="" class="aside-menu-link">
            <i data-feather="menu"></i>
            <i data-feather="x"></i>
        </a>
    </div>
    <div class="aside-body">
        <div class="aside-loggedin">
            <div class="d-flex align-items-center justify-content-start">
                <a href="" class="avatar"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></a>
                <div class="aside-alert-link">
                    <a href="" class="new" data-toggle="tooltip" title="You have 2 unread messages"><i
                            data-feather="message-square"></i></a>
                    <a href="" class="new" data-toggle="tooltip" title="You have 4 new notifications"><i
                            data-feather="bell"></i></a>
                    <a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();" data-toggle="tooltip" title="Sign out"><i data-feather="log-out"></i></a>

                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            <div class="aside-loggedin-user">
                <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2"
                    data-toggle="collapse">
                    <h6 class="tx-semibold mg-b-0">{{ auth()->user()->name }}</h6>
                    <i data-feather="chevron-down"></i>
                </a>
                <p class="tx-color-03 tx-12 mg-b-0">Administrator</p>
            </div>
            <div class="collapse" id="loggedinMenu">
                <ul class="nav nav-aside mg-b-0">
                    <li class="nav-item"><a href="" class="nav-link"><i data-feather="edit"></i> <span>Edit
                                Profile</span></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><i data-feather="user"></i> <span>View
                                Profile</span></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><i data-feather="settings"></i> <span>Account
                                Settings</span></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><i data-feather="help-circle"></i> <span>Help
                                Center</span></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><i data-feather="log-out"></i> <span>Sign
                                Out</span></a></li>
                </ul>
            </div>
        </div><!-- aside-loggedin -->
        <ul class="nav nav-aside">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i data-feather="home"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.index') }}" class="nav-link">
                    <i data-feather="bar-chart-2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-label mg-t-25">Profile</li>
            <li class="nav-item"><a href="{{ route('profile.tentang-pvmbg') }}" class="nav-link"><i
                        data-feather="shopping-bag"></i> <span>Tentang PVMBG</span></a></li>
            <li class="nav-item"><a href="{{ route('profile.struktur-organisasi') }}" class="nav-link"><i data-feather="git-merge"></i>
                    <span>Struktur Organisasi</span></a></li>
            <li class="nav-item"><a href="{{ route('profile.sejarah') }}" class="nav-link"><i data-feather="clock"></i>
                    <span>Sejarah</span></a></li>

            <li class="nav-label mg-t-25">Gunung Api</li>
            <li class="nav-item"><a href="{{ route('gunung-api.data-dasar') }}" class="nav-link"><i
                        data-feather="layers"></i> <span>Data Dasar</span></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i
                        data-feather="alert-triangle"></i> <span>Informasi Letusan</span></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i
                        data-feather="airplay"></i> <span>Tingkat Aktivitas</span></a></li>

            <li class="nav-label mg-t-25">Layanan Publik</li>
            <li class="nav-item"><a href="" class="nav-link"><i
                        data-feather="award"></i> <span>Reformasi Birokrasi</span></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i
                        data-feather="info"></i> <span>Diseminasi Informasi</span></a></li>
            <li class="nav-item with-sub">
                <a href="" class="nav-link"><i data-feather="users"></i> <span>Kerja Sama</span></a>
                <ul>
                    <li><a href="page-profile-view.html">Informasi Kerja Sama</a></li>
                    <li><a href="page-connections.html">Dalam Negeri</a></li>
                    <li><a href="page-groups.html">Luar Negeri</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="#" class="nav-link"><i data-feather="database"></i><span>Permohonan Data</span></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i data-feather="share-2"></i><span>Permohonan API</span></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i data-feather="briefcase"></i><span>Praktek Kerja Lapangan</span></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i data-feather="command"></i><span>Bimbingan Tugas Akhir</span></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i data-feather="flag"></i><span>Pengaduan</span></a></li>

            <li class="nav-label mg-t-25">User Interface</li>
            <li class="nav-item"><a href="../../components" class="nav-link"><i data-feather="layers"></i>
                    <span>Components</span></a></li>
            <li class="nav-item"><a href="../../collections" class="nav-link"><i data-feather="box"></i>
                    <span>Collections</span></a></li>
        </ul>
    </div>
</aside>
