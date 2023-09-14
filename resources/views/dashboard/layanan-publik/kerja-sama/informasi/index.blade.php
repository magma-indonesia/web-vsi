@extends('dashboard.template.layout')

@section('title', 'Informasi Kerja Sama')

@section('body-content')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item">Layanan Publik</li>
                    <li class="breadcrumb-item active" aria-current="page">Informasi Kerja Sama</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Selamat datang di Dashboard Web PVMBG</h4>
        </div>
        <div class="d-none d-md-block">
            <button class="btn btn-sm pd-x-15 btn-white btn-uppercase"><i data-feather="mail"
                                                                          class="wd-10 mg-r-5"></i> Email
            </button>
            <button class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-l-5"><i data-feather="printer"
                                                                                 class="wd-10 mg-r-5"></i> Print
            </button>
            <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5"><i data-feather="file"
                                                                                   class="wd-10 mg-r-5"></i> Generate
                Report
            </button>
        </div>
    </div>

    <h1 class="df-title">Informasi Kerja Sama</h1>
    <p class="df-lead">Kerja sama PVMBG melingkupi kerja sama di bidang bencana geologi yang meliputi kegiatan
        penyelidikan, pemantauan,
        instalasi peralatan, dan optimalisasi sistem mitigasi bencana geologi. Kunjungi halaman <a
            href="{{ route('layanan-publik.kerja-sama.informasi-kerja-sama') }}"
            target="_blank">Informasi kerja sama</a> untuk mendapatkan detail informasi kerja sama.</p>

    <hr class="mg-y-40">

    <h4 id="section1" class="mg-b-10">Pengajuan Baru</h4>
    <p class="mg-b-30">Pengajuan baru permohonan kerja sama di bidang kebencanaan geologi yang telah masuk dan akan
        diproses untuk dilakukan pengecekan syarat administrasi dan kelengkapan dokumen. Daftar ini digunakan untuk
        melihat berapa banyak pengajuan yang masuk dalsam satu waktu.</p>

    <div class="row row-xs">
        <div class="col-12">
            <div class="card ht-100p">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">Pengajuan Baru</h6>
                    <div class="d-flex align-items-center tx-18">
                        <a href="" class="link-03 lh-0"><i class="icon ion-md-refresh"></i></a>
                        <a href="" class="link-03 lh-0 mg-l-10"><i class="icon ion-md-more"></i></a>
                    </div>
                </div>
                <ul class="list-group list-group-flush tx-13">
                    <li class="list-group-item d-flex pd-sm-x-20">
                        <div class="avatar"><span class="avatar-initial rounded-circle bg-gray-600">d</span></div>
                        <div class="pd-l-10">
                            <p class="tx-medium mg-b-0">Dewi Lestari - Lembaga Ilmu Pengetahuan Indonesia</p>
                            <small class="tx-12 tx-color-03 mg-b-0">Gunung Api - Penyelidikan Geologi, Geokimia, dan
                                Geofisika</small>
                        </div>
                        <div class="mg-l-auto d-flex align-self-center">
                            <nav class="nav nav-icon-only">
                                <a href="" class="nav-link d-none d-sm-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                        </path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </a>
                                <a href="" class="nav-link d-none d-sm-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-slash">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
                                    </svg>
                                </a>
                                <a href="" class="nav-link d-none d-sm-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </a>
                                <a href="" class="nav-link d-sm-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-more-vertical">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="12" cy="5" r="1"></circle>
                                        <circle cx="12" cy="19" r="1"></circle>
                                    </svg>
                                </a>
                            </nav>
                        </div>
                    </li>

                    <li class="list-group-item d-flex pd-sm-x-20">
                        <div class="avatar"><span class="avatar-initial rounded-circle bg-gray-600">i</span></div>
                        <div class="pd-l-10">
                            <p class="tx-medium mg-b-0">Imanuel Raha - Badan Riset dan Inovasi Nasional</p>
                            <small class="tx-12 tx-color-03 mg-b-0">Gerakan Tanah - Pemetaan Gerakan Tanah</small>
                        </div>
                        <div class="mg-l-auto d-flex align-self-center">
                            <nav class="nav nav-icon-only">
                                <a href="" class="nav-link d-none d-sm-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                        </path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </a>
                                <a href="" class="nav-link d-none d-sm-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-slash">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
                                    </svg>
                                </a>
                                <a href="" class="nav-link d-none d-sm-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </a>
                                <a href="" class="nav-link d-sm-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-more-vertical">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="12" cy="5" r="1"></circle>
                                        <circle cx="12" cy="19" r="1"></circle>
                                    </svg>
                                </a>
                            </nav>
                        </div>
                    </li>

                    <li class="list-group-item d-flex pd-sm-x-20">
                        <div class="avatar"><span class="avatar-initial rounded-circle bg-gray-600">f</span></div>
                        <div class="pd-l-10">
                            <p class="tx-medium mg-b-0">Farid Raharja - Badan Informasi Geospasial</p>
                            <small class="tx-12 tx-color-03 mg-b-0">Gempa Bumi dan Tsunami - Pemantauan Sesar
                                Lembang</small>
                        </div>
                        <div class="mg-l-auto d-flex align-self-center">
                            <nav class="nav nav-icon-only">
                                <a href="" class="nav-link d-none d-sm-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                        </path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </a>
                                <a href="" class="nav-link d-none d-sm-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-slash">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
                                    </svg>
                                </a>
                                <a href="" class="nav-link d-none d-sm-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </a>
                                <a href="" class="nav-link d-sm-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-more-vertical">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="12" cy="5" r="1"></circle>
                                        <circle cx="12" cy="19" r="1"></circle>
                                    </svg>
                                </a>
                            </nav>
                        </div>
                    </li>

                </ul>
                <div class="card-footer text-center tx-13">
                    <a href="" class="link-03">Liat lainnya <i class="icon ion-md-arrow-down mg-l-5"></i></a>
                </div><!-- card-footer -->
            </div><!-- card -->
        </div>
    </div>

    <hr class="mg-y-40">

    <h4 id="section1" class="mg-b-10">Selesai Dikerjakan</h4>
    <p class="mg-b-30">Using the most basic table markup, here’s how <code>.table</code> based tables look in Bootstrap.
        All
        table styles are inherited in Bootstrap 4, meaning any nested tables will be styled in the same manner as the
        parent.</p>

    <div data-label="Example" class="df-example demo-table">
        <div class="table-responsive">
            <table class="table mg-b-0">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Insitusi</th>
                    <th scope="col">Jenis Kerja Sama</th>
                    <th scope="col">Kelengkapan Dokumen</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Adrian Nugraha</td>
                    <td>Institut Teknologi Bandung</td>
                    <td>Gunung Api - Pemenuhan Kebutuhan Peralatan Ppemantauan Kimia Gunung Api</td>
                    <td><small class="tx-14 tx-success">Lengkap</small></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Septian Firman</td>
                    <td>Surveyor Indonesia</td>
                    <td>Gunung Api - Modeling Potensi Bahaya Gunung Api</td>
                    <td><small class="tx-14 tx-success">Lengkap</small></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Riskiray Ryannugroho</td>
                    <td>Badan Pengkajian dan Penerapan Teknologi</td>
                    <td>Gerakan Tanah - Teknologi dan Sistem Peringatan Dini Gerakan Tanah</td>
                    <td><small class="tx-14 tx-success">Lengkap</small></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Ardy Prayoga</td>
                    <td>Badan Informasi Geospasial</td>
                    <td>Gempa Bumi dan Tsunami - Pemetaan KRB Tsunami Skala Detail</td>
                    <td><small class="tx-14 tx-success">Lengkap</small></td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Bang Willy</td>
                    <td>Lembaga Ilmu Pengetahuan Indonesia</td>
                    <td>Gempa Bumi dan Tsunami - Data Karakteristik Sumber Pembangkit Tsunami Non Tektonik</td>
                    <td><small class="tx-14 tx-success">Lengkap</small></td>
                </tr>
                </tbody>
            </table>
        </div><!-- table-responsive -->
    </div><!-- df-example -->
@endsection
