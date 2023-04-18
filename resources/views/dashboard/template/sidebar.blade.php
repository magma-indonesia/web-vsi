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
                <a href="" class="avatar"><img src="{{ auth()->user()->getAvatar() }}" class="rounded-circle"
                                               alt=""></a>
                <div class="aside-alert-link">
                    <a href="" class="new" data-toggle="tooltip" title="You have 2 unread messages"><i
                            data-feather="message-square"></i></a>
                    <a href="" class="new" data-toggle="tooltip" title="You have 4 new notifications"><i
                            data-feather="bell"></i></a>
                    <a href="{{ route('logout') }}" data-toggle="tooltip" title="Sign out"><i data-feather="log-out"></i></a>
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
                    <li class="nav-item"><a href="" class="nav-link"><i data-feather="edit"></i>
                            <span>Edit Profile</span></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><i data-feather="user"></i>
                            <span>View Profile</span></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><i data-feather="settings"></i> <span>Account Settings</span></a>
                    </li>
                    <li class="nav-item"><a href="" class="nav-link"><i data-feather="help-circle"></i> <span>Help Center</span></a>
                    </li>
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link"><i data-feather="log-out"></i>
                            <span>Sign Out</span></a></li>
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

            <li class="nav-item {{ request()->routeIs('settings.employee.index') ? 'active' : '' }}">
                <a href="{{ route('settings.employee.index') }}" class="nav-link">
                    <i data-feather="user"></i>
                    <span>Pegawai</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.index') }}" class="nav-link">
                    <i data-feather="bar-chart-2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('settings.upload.index') ? 'active' : '' }}">
                <a href="{{ route('settings.upload.index') }}" class="nav-link">
                    <i data-feather="upload"></i>
                    <span>Upload Center</span>
                </a>
            </li>

            <li class="nav-label mg-t-25">CMS</li>
            <li class="nav-item with-sub">
                <a href="" class="nav-link"><i data-feather="layers"></i> <span>Profile</span></a>
                <ul>
                    <li class="nav-item"><a href="{{ route('profile.tentang-pvmbg') }}"><i
                                data-feather="shopping-bag"></i> <span>Tentang PVMBG</span></a></li>
                    <li class="nav-item"><a href="{{ route('profile.struktur-organisasi') }}"><i
                                data-feather="git-merge"></i>
                            <span>Struktur Organisasi</span></a></li>
                    <li class="nav-item"><a href="{{ route('profile.sejarah') }}"><i data-feather="clock"></i>
                            <span>Sejarah</span></a></li>
                </ul>
            </li>
            <li class="nav-item with-sub">
                <a href="" class="nav-link"><i data-feather="layers"></i> <span>Gunung Api</span></a>
                <ul>
                    <li class="nav-item"><a href="{{ route('gunung-api.data-dasar') }}"><i
                                data-feather="layers"></i><span>Data Dasar</span></a></li>
                    <li class="nav-item"><a href="#"><i data-feather="airplay"></i><span>Tingkat Aktivitas</span></a>
                    </li>
                    <li class="nav-item"><a href="#"><i data-feather="airplay"></i><span>Laporan Aktivitas</span></a>
                    </li>
                    <li class="nav-item"><a href="#"><i data-feather="alert-triangle"></i><span>Informasi Letusan</span></a>
                    </li>
                    <li class="nav-item"><a href="#"><i data-feather="airplay"></i><span>CCTV Gunung Api</span></a></li>
                    <li class="nav-item"><a href="#"><i data-feather="airplay"></i><span>Gallery Foto</span></a></li>
                    <li class="nav-item"><a href="#"><i data-feather="airplay"></i><span>Peta KR Gunung Api</span></a>
                    </li>
                    <li class="nav-item"><a href="#"><i data-feather="airplay"></i><span>Live Seismogram</span></a></li>
                    <li class="nav-item"><a href="#"><i data-feather="airplay"></i><span>VONA</span></a></li>
                </ul>
            </li>
            <li class="nav-item with-sub">
                <a href="" class="nav-link"><i data-feather="layers"></i> <span>Gerakan Tanah</span></a>
                <ul>
                    <li class="nav-item"><a href="#"><i
                                data-feather="alert-triangle"></i><span>Rekapitulasi Kejadian</span></a></li>
                    <li class="nav-item"><a href="{{ route('gunung-api.data-dasar') }}"><i
                                data-feather="layers"></i><span>Daftar Kejadian</span></a></li>
                    <li class="nav-item"><a href="#"><i
                                data-feather="alert-triangle"></i><span>Peringatan Dini</span></a></li>
                    <li class="nav-item"><a href="#"><i data-feather="alert-triangle"></i><span>Peta ZKGT</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item with-sub">
                <a href="" class="nav-link"><i data-feather="layers"></i> <span>Gempa Bumi & Tsunami</span></a>
                <ul>
                    <li class="nav-item"><a href="{{ route('gunung-api.data-dasar') }}"><i
                                data-feather="layers"></i><span>Rekapitulasi Kejadian</span></a></li>
                    <li class="nav-item"><a href="#"><i
                                data-feather="alert-triangle"></i><span>Daftar Kejadian</span></a></li>
                    <li class="nav-item"><a href="#"><i
                                data-feather="alert-triangle"></i><span>Laporan Singkat</span></a></li>
                    <li class="nav-item"><a href="#"><i
                                data-feather="alert-triangle"></i><span>Publikasi Dan Mitigasi</span></a></li>
                    <li class="nav-item"><a href="#"><i
                                data-feather="alert-triangle"></i><span>Katalog Gempa Merusak</span></a></li>
                    <li class="nav-item"><a href="#"><i
                                data-feather="alert-triangle"></i><span>Daftar Kejadian</span></a></li>
                    <li class="nav-item"><a href="#"><i
                                data-feather="alert-triangle"></i><span>Peta KRB Gempa Bumi</span></a></li>
                    <li class="nav-item"><a href="#"><i data-feather="alert-triangle"></i><span>Peta KRB Tsunami</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item with-sub">
                <a href="" class="nav-link"><i data-feather="layers"></i> <span>Layanan Publik</span></a>
                <ul>
                    <li class="nav-item"><a href=""><i data-feather="award"></i><span>Reformasi Birokrasi</span></a>
                    </li>
                    <li class="nav-item"><a href="#"><i data-feather="info"></i><span>Diseminasi Informasi</span></a>
                    </li>
                    <li class="nav-item with-sub {{ request()->routeIs('dashboard.layanan-publik.kerja-sama.informasi') ? 'active' : '' }}">
                        <a href="" class="nav-link"><i data-feather="users"></i> <span>Kerja Sama</span></a>
                        <ul>
                            <li><a href="{{ route('dashboard.layanan-publik.kerja-sama.informasi') }}">Informasi Kerja
                                    Sama</a></li>
                            <li><a href="page-connections.html">Dalam Negeri</a></li>
                            <li><a href="page-groups.html">Luar Negeri</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="#"><i data-feather="database"></i><span>Permohonan Data</span></a>
                    </li>
                    <li class="nav-item"><a href="#"><i data-feather="share-2"></i><span>Permohonan API</span></a></li>
                    <li class="nav-item"><a href="#"><i data-feather="briefcase"></i><span>Praktek Kerja Lapangan</span></a>
                    </li>
                    <li class="nav-item"><a href="#"><i
                                data-feather="command"></i><span>Bimbingan Tugas Akhir</span></a></li>
                    <li class="nav-item"><a href="#"><i data-feather="flag"></i><span>Pengaduan</span></a></li>
                    <li class="nav-item"><a href="{{ route('dashboard.layanan-publik.kontak') }}"><i data-feather="mail"></i><span>Kontak</span></a></li>
                </ul>
            </li>

            <li class="nav-label mg-t-25">Tata Usaha</li>
            <li class="nav-item with-sub {{ request()->is('*employee*') ? 'active show' : '' }}">
                <a href="" class="nav-link"><i data-feather="shopping-bag"> </i><span>Sub Kepegawaian</span></a>
                <ul>
                    <li class="nav-item {{ request()->is('*employee/index') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.admin.employee.index') }}"><i data-feather="users"></i><span>Pegawai</span></a>
                    </li>
                    <li class="nav-item {{ request()->is('*sipeg*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.admin.employee.sipeg') }}"><i data-feather="users"></i><span>Pegawai - SIPEG</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item with-sub {{ request()->is('*bmn*') ? 'active show' : '' }}">
                <a href="" class="nav-link"><i data-feather="layers"></i> <span>Sub BMN</span></a>
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('profile.struktur-organisasi') }}"><i data-feather="git-merge"></i><span>Rekapitulasi</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profile.tentang-pvmbg') }}"><i data-feather="shopping-bag"></i><span>Daftar Barang</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profile.sejarah') }}"><i
                                data-feather="clock"></i><span>Keluar-Masuk Barang</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item with-sub {{ request()->is('*finance*') ? 'active show' : '' }}">
                <a href="" class="nav-link"><i data-feather="layers"></i> <span>Sub Keuangan</span></a>
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('profile.struktur-organisasi') }}"><i data-feather="git-merge"></i><span>Rekapitulasi</span></a>
                    </li>
                    <li class="nav-item {{ request()->is('*nominative*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.admin.finance.get.master-nominative') }}"><i
                                data-feather="shopping-bag"></i><span>Nominatif</span></a>
                    </li>
                    <li class="nav-item {{ request()->is('*spd*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.admin.finance.get.track-spd') }}"><i
                                data-feather="clock"></i><span>Tracking SPPD</span></a>
                    </li>
                </ul>
            </li>

            {{-- todo analyse usage of each parent menu here --}}
            <li class="nav-label mg-t-25">Gunung Api</li>
            <li class="nav-label mg-t-25">Gerakan Tanah</li>
            <li class="nav-label mg-t-25">Gempa Bumi & Tsunami</li>
            <li class="nav-label mg-t-25">IMDI</li>

            <li class="nav-label mg-t-25">User Interface</li>
            <li class="nav-item"><a href="../../components" class="nav-link"><i data-feather="layers"></i><span>Components</span></a>
            </li>
            <li class="nav-item"><a href="../../collections" class="nav-link"><i data-feather="box"></i><span>Collections</span></a>
            </li>
        </ul>
    </div>
</aside>
