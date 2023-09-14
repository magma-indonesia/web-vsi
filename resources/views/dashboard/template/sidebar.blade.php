@inject('menus', 'App\Services\MenuService')

@php
$menus   = $menus->get();
$links   = collect();
$indexes = [];
$number  = 0;
foreach ($menus as $index => $mainMenu) {
    $mainLink = data_get($mainMenu, 'link');
    if (is_array($mainLink)) {
        foreach ($mainLink as $menu) {
            $childLink = data_get($menu, 'link');
            if (is_array($childLink)) {
                foreach ($childLink as $menuDetail) {
                    $links[$number]   = data_get($menuDetail, 'link');
                    $indexes[$number] = $index;
                    $number++;
                }
            } else {
                $links[$number]   = $childLink;
                $indexes[$number] = $index;
                $number++;
            }
        }
    } else {
        $links[$number] = $mainLink;
        $indexes[$number] = $index;
        $number++;
    }
}
$links        = $links->sort()->reverse();
$currentIndex = -1;
$currentPath  = route('dashboard.index');
$requestPath  = rtrim(request()->url(), '/');
foreach ($links as $index => $path) {
    if (substr($requestPath, 0, strlen($path)) == $path) {
        $currentIndex = data_get($indexes, $index);
        $currentPath  = $path;
        break;
    }
}
@endphp

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
                <a href="" class="avatar"><img src="{{ optional(auth()->user())->getAvatar() }}" class="rounded-circle" alt=""></a>
                <div class="aside-alert-link">
                    <!-- <a href="" class="new" data-toggle="tooltip" title="You have 2 unread messages"><i data-feather="message-square"></i></a>
                    <a href="" class="new" data-toggle="tooltip" title="You have 4 new notifications"><i data-feather="bell"></i></a> -->
                    <a href="{{ route('dashboard.change-password.edit', auth()->user()->id) }}" data-toggle="tooltip" title="Change Password"><i data-feather="lock"></i></a>
                    <a href="{{ route('logout') }}" data-toggle="tooltip" title="Sign out"><i data-feather="log-out"></i></a>
                </div>
            </div>
            <div class="aside-loggedin-user">
                <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2"
                    data-toggle="collapse">
                    <h6 class="tx-semibold mg-b-0">{{ optional(auth()->user())->name }}</h6>
                    <i data-feather="chevron-down"></i>
                </a>
                <p class="tx-color-03 tx-12 mg-b-0">{{ optional(optional(auth()->user())->role)->description }}</p>
            </div>
            <div class="collapse" id="loggedinMenu">
                <ul class="nav nav-aside mg-b-0">
                    <!-- <li class="nav-item"><a href="" class="nav-link"><i data-feather="edit"></i><span>Edit Profile</span></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><i data-feather="user"></i><span>View Profile</span></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><i data-feather="settings"></i><span>Account Settings</span></a></li> -->
                    <li class="nav-item"><a href="{{ route('dashboard.change-password.edit', auth()->user()->id) }}" class="nav-link"><i data-feather="lock"></i><span>Change Password</span></a></li>
                    <!-- <li class="nav-item"><a href="" class="nav-link"><i data-feather="help-circle"></i><span>Help Center</span></a></li> -->
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link"><i data-feather="log-out"></i><span>Sign Out</span></a></li>
                </ul>
            </div>
        </div>
        <!-- aside-loggedin -->
        <ul class="nav nav-aside">
            @foreach ($menus as $index => $mainMenu)
                @php
                    $mainLink = data_get($mainMenu, 'link');
                @endphp
                @if (is_array($mainLink))
                    <li @class(['nav-item with-sub', 'active show' => $index == $currentIndex])>
                        <a href="" class="nav-link">
                            <i data-feather="{{ data_get($mainMenu, 'icon') }}"></i>
                            <span>{{ data_get($mainMenu, 'label') }}</span>
                        </a>
                        <ul>
                            @foreach ($mainLink as $menu)
                                @php
                                    $childLink = data_get($menu, 'link');
                                @endphp
                                @if (is_array($childLink))
                                    <li @class(['nav-item with-sub', 'active' => $index == $currentIndex])>
                                        <a href="" class="nav-link">
                                            <i data-feather="{{ data_get($menu, 'icon') }}"></i>
                                            <span>{{ data_get($menu, 'label') }}</span>
                                        </a>
                                        <ul>
                                            @foreach ($childLink as $menuDetail)
                                                @php
                                                    $grandchildLink = data_get($menuDetail, 'link');
                                                @endphp
                                                <li @class(['disabled' => $grandchildLink == '#', 'active' => $grandchildLink == $currentPath, 'nav-item'])>
                                                    <a href="{{ $grandchildLink }}">
                                                        <span>{{ data_get($menuDetail, 'label') }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li @class(['disabled' => $childLink == '#', 'active' => $childLink == $currentPath, 'nav-item'])>
                                        <a href="{{ $childLink }}">
                                            <i data-feather="{{ data_get($menu, 'icon') }}"></i>
                                            <span>{{ data_get($menu, 'label') }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @elseif (data_get($mainMenu, 'icon') == '' && $mainLink == '#')
                    <li class="nav-label mg-t-25">{{ data_get($mainMenu, 'label') }}</li>
                @else
                    <li @class(['disabled' => $mainLink == '#', 'active' => $mainLink == $currentPath, 'nav-item'])>
                        <a href="{{ $mainLink }}" class="nav-link">
                            <i data-feather="{{ data_get($mainMenu, 'icon') }}"></i>
                            <span>{{ data_get($mainMenu, 'label') }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
        {{--<ul class="nav nav-aside">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i data-feather="home"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.index') }}" class="nav-link">
                    <i data-feather="trending-up"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('dashboard.pegawai.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.pegawai.index') }}" class="nav-link">
                    <i data-feather="user"></i>
                    <span>Pegawai</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('dashboard.upload-center.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.upload-center.index') }}" class="nav-link">
                    <i data-feather="upload"></i>
                    <span>Upload Center</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('dashboard.press-release.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.press-release.index') }}" class="nav-link">
                    <i data-feather="flag"></i>
                    <span>Press Release</span>
                </a>
            </li>

            <li class="nav-label mg-t-25">CMS</li>
            <li class="nav-item with-sub  {{ request()->is('*profile*') ? 'active show' : '' }}">
                <a href="" class="nav-link"><i data-feather="award"></i> <span>Profile</span></a>
                <ul>
                    <li
                        class="nav-item {{ request()->is('*profile*') && request()->route('id') == Param::PROFILE_ABOUT ? 'active' : '' }}">
                        <a href="{{ route('dashboard.profile.index', Param::PROFILE_ABOUT) }}"><i
                                data-feather="info"></i> <span>Tentang PVMBG</span></a>
                    </li>
                    <li
                        class="nav-item {{ request()->is('*profile*') && request()->route('id') == Param::PROFILE_STRUCTURE ? 'active' : '' }}">
                        <a href="{{ route('dashboard.profile.index', Param::PROFILE_STRUCTURE) }}"><i
                                data-feather="git-merge"></i> <span>Struktur Organisasi</span></a>
                    </li>
                    <li
                        class="nav-item {{ request()->is('*profile*') && request()->route('id') == Param::PROFILE_HISTORY ? 'active' : '' }}">
                        <a href="{{ route('dashboard.profile.index', Param::PROFILE_HISTORY) }}"><i
                                data-feather="clock"></i> <span>Sejarah</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item with-sub {{ request()->is('*gunung-api*') ? 'active show' : '' }}">
                <a href="" class="nav-link"><i data-feather="bar-chart-2"></i> <span>Gunung Api</span></a>
                <ul>
                    <li
                        class="nav-item {{ request()->routeIs('dashboard.gunung-api.data-dasar.index') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.gunung-api.data-dasar.index') }}">
                            <i data-feather="layers"></i><span>Data Dasar</span>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('dashboard.gunung-api.tingkat-aktivitas.index') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.gunung-api.tingkat-aktivitas.index') }}">
                            <i data-feather="activity"></i>
                            <span>Tingkat Aktivitas</span>
                        </a>
                    </li>
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
            <li class="nav-item with-sub  {{ request()->is('*gerakan-tanah*') ? 'active show' : '' }}">
                <a href="" class="nav-link"><i data-feather="activity"></i> <span>Gerakan Tanah</span></a>
                <ul>
                    <li
                        class="nav-item {{ request()->is('*gerakan-tanah*') && request()->get('category') == Param::GROUND_MOVEMENT_EVENT ? 'active' : '' }}">
                        <a
                            href="{{ route('dashboard.gerakan-tanah.index', ['category' => Param::GROUND_MOVEMENT_EVENT]) }}"><i
                                data-feather="list"></i><span>Daftar Kejadian</span></a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('dashboard.tanggapan-kejadian.index') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.tanggapan-kejadian.index') }}">
                            <i data-feather="alert-triangle"></i>
                            <span>Tanggapan Kejadian</span>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->is('*gerakan-tanah*') && request()->get('category') == Param::GROUND_MOVEMENT_EARLY_WARNING ? 'active' : '' }}">
                        <a
                            href="{{ route('dashboard.gerakan-tanah.index', ['category' => Param::GROUND_MOVEMENT_EARLY_WARNING]) }}"><i
                                data-feather="alert-triangle"></i><span>Peringatan Dini</span></a>
                    </li>
                    <li
                        class="nav-item {{ request()->is('*gerakan-tanah*') && request()->get('category') == Param::GROUND_MOVEMENT_EVENT_RECAP ? 'active' : '' }}">
                        <a
                            href="{{ route('dashboard.gerakan-tanah.index', ['category' => Param::GROUND_MOVEMENT_EVENT_RECAP]) }}"><i
                                data-feather="book-open"></i><span>Rekapitulasi Kejadian</span></a>
                    </li>
                    <li class="nav-item"><a href="#"><i data-feather="map"></i><span>Peta ZKGT</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item with-sub  {{ request()->is('*gempa-bumi-tsunami*') ? 'active show' : '' }}">
                <a href="" class="nav-link"><i data-feather="globe"></i> <span>Gempa Bumi & Tsunami</span></a>
                <ul>
                    <li class="nav-item"><a href="#"><i
                                data-feather="layers"></i><span>Rekapitulasi Kejadian</span></a></li>
                    <li
                        class="nav-item {{ request()->routeIs('dashboard.gempa-bumi-tsunami.daftar-kejadian.index') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.gempa-bumi-tsunami.daftar-kejadian.index') }}">
                            <i data-feather="list"></i>
                            <span>Daftar Kejadian</span>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('dashboard.gempa-bumi-tsunami.kajian-kejadian.index') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.gempa-bumi-tsunami.kajian-kejadian.index') }}">
                            <i data-feather="book-open"></i>
                            <span>Kajian Kejadian</span>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('dashboard.gempa-bumi-tsunami.laporan-singkat.index') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.gempa-bumi-tsunami.laporan-singkat.index') }}">
                            <i data-feather="file-text"></i>
                            <span>Laporan Singkat</span>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('dashboard.gempa-bumi-tsunami.publikasi-mitigasi.index') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.gempa-bumi-tsunami.publikasi-mitigasi.index') }}">
                            <i data-feather="radio"></i>
                            <span>Publikasi Mitigasi</span>
                        </a>
                    </li>
                    <li class="nav-item"><a href="#"><i data-feather="alert-triangle"></i><span>Katalog Gempa
                                Merusak</span></a></li>
                    <li class="nav-item"><a href="#"><i data-feather="alert-triangle"></i><span>Peta KRB Gempa
                                Bumi</span></a></li>
                    <li class="nav-item"><a href="#"><i data-feather="alert-triangle"></i><span>Peta KRB Tsunami</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item with-sub {{ request()->is('*layanan-publik*') ? 'active show' : '' }}">
                <a href="" class="nav-link"><i data-feather="menu"></i> <span>Layanan Publik</span></a>
                <ul>
                    <li class="nav-item {{ request()->is('*layanan-publik*') && request()->get('category') == Param::PUBLIC_SERVICE_BUREAUCRATIC_REFORM ? 'active' : '' }}">
                        <a href="{{ route('dashboard.layanan-publik.index', ['category' => Param::PUBLIC_SERVICE_BUREAUCRATIC_REFORM]) }}"><i data-feather="award"></i><span>Reformasi Birokrasi</span></a>
                    </li>
                    <li class="nav-item {{ request()->is('*layanan-publik*') && request()->get('category') == Param::PUBLIC_SERVICE_INFORMATION_DISSEMINATION ? 'active' : '' }}">
                        <a href="{{ route('dashboard.layanan-publik.index', ['category' => Param::PUBLIC_SERVICE_INFORMATION_DISSEMINATION]) }}"><i data-feather="info"></i><span>Diseminasi Informasi</span></a>
                    </li>
                    <li
                        class="nav-item with-sub {{ request()->routeIs('dashboard.layanan-publik.kerja-sama.informasi') ? 'active' : '' }}">
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
                    <li class="nav-item"><a href="#"><i data-feather="command"></i><span>Bimbingan Tugas Akhir</span></a>
                    </li>
                    <li class="nav-item"><a href="#"><i data-feather="flag"></i><span>Pengaduan</span></a></li>
                    <li class="nav-item"><a href="{{ route('dashboard.layanan-publik.kontak') }}"><i
                                data-feather="mail"></i><span>Kontak</span></a></li>
                    <li class="nav-item {{ request()->routeIs('dashboard.layanan-publik.pengumuman.index') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.layanan-publik.pengumuman.index') }}">
                            <i data-feather="info"></i>
                            <span>Pengumuman</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-label mg-t-25">Tata Usaha</li>
            <li class="nav-item with-sub {{ request()->is('*employee*') ? 'active show' : '' }}">
                <a href="" class="nav-link"><i data-feather="shopping-bag"> </i><span>Sub Kepegawaian</span></a>
                <ul>
                    <li class="nav-item {{ request()->is('*employee/index') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.admin.employee.index') }}"><i
                                data-feather="users"></i><span>Pegawai</span></a>
                    </li>
                    <li class="nav-item {{ request()->is('*sipeg*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.admin.employee.sipeg') }}"><i data-feather="users"></i><span>Pegawai -
                                SIPEG</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item with-sub {{ request()->is('*bmn*') ? 'active show' : '' }}">
                <a href="" class="nav-link"><i data-feather="layers"></i> <span>Sub BMN</span></a>
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('profile.struktur-organisasi') }}"><i
                                data-feather="git-merge"></i><span>Rekapitulasi</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profile.tentang-pvmbg') }}"><i data-feather="shopping-bag"></i><span>Daftar
                                Barang</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profile.sejarah') }}"><i data-feather="clock"></i><span>Keluar-Masuk
                                Barang</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item with-sub {{ request()->is('*finance*') ? 'active show' : '' }}">
                <a href="" class="nav-link"><i data-feather="layers"></i> <span>Sub Keuangan</span></a>
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('profile.struktur-organisasi') }}"><i
                                data-feather="git-merge"></i><span>Rekapitulasi</span></a>
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

            <!-- todo analyse usage of each parent menu here -->
            <li class="nav-label mg-t-25">Gunung Api</li>
            <li class="nav-label mg-t-25">Gerakan Tanah</li>
            <li class="nav-label mg-t-25">Gempa Bumi & Tsunami</li>
            <li class="nav-label mg-t-25">IMDI</li>

            <li class="nav-label mg-t-25">User Interface</li>
            <li class="nav-item"><a href="../../components" class="nav-link"><i
                        data-feather="layers"></i><span>Components</span></a>
            </li>
            <li class="nav-item"><a href="../../collections" class="nav-link"><i
                        data-feather="box"></i><span>Collections</span></a>
            </li>
        </ul>--}}
    </div>
</aside>
