<?php

namespace App\Services;

use App\Param;
use Illuminate\Support\Facades\Auth;

class MenuService
{
    private function menus()
    {
        return [
            [
                'icon' => 'home', // feather-icon
                'label' => 'Home',
                'link' => route('home'),
                'policies' => [
                    Param::DEFAULT_ACCESS_POLICY
                ]
            ],
            [
                'icon' => 'trending-up',
                'label' => 'Dashboard',
                'link' => route('dashboard.index'),
                'policies' => [
                    Param::DEFAULT_ACCESS_POLICY
                ]
            ],
            [
                'icon' => '',
                'label' => 'CMS',
                'link' => '#',
                'policies' => [
                    Param::DEFAULT_ACCESS_POLICY
                ]
            ],
            [
                'icon' => 'sliders',
                'label' => 'Role',
                'link' => route('dashboard.role.index'),
                'policies' => [
                    Param::MANAGE_ROLE_POLICY
                ]
            ],
            [
                'icon' => 'user',
                'label' => 'Pegawai',
                'link' => route('dashboard.pegawai.index'),
                'policies' => [
                    Param::MANAGE_USER_POLICY
                ]
            ],
            [
                'icon' => 'upload',
                'label' => 'Upload Center',
                'link' => route('dashboard.upload-center.index'),
                'policies' => [
                    Param::MANAGE_UPLOAD_POLICY
                ]
            ],
            [
                'icon' => 'flag',
                'label' => 'Press Release',
                'link' => route('dashboard.press-release.index'),
                'policies' => [
                    Param::MANAGE_PRESS_RELEASE_POLICY
                ]
            ],
            [
                'icon' => 'award',
                'label' => 'Profile',
                'link' => [
                    [
                        'icon' => 'info',
                        'label' => 'Tentang PVMBG',
                        'link' => route('dashboard.profile.index', Param::PROFILE_ABOUT),
                        'policies' => [
                            Param::MANAGE_PROFILE_ABOUT_POLICY
                        ],
                    ],
                    [
                        'icon' => 'git-merge',
                        'label' => 'Struktur Organisasi',
                        'link' => route('dashboard.profile.index', Param::PROFILE_STRUCTURE),
                        'policies' => [
                            Param::MANAGE_PROFILE_STRUCTURE_POLICY
                        ],
                    ],
                    [
                        'icon' => 'clock',
                        'label' => 'Sejarah',
                        'link' => route('dashboard.profile.index', Param::PROFILE_HISTORY),
                        'policies' => [
                            Param::MANAGE_PROFILE_HISTORY_POLICY
                        ],
                    ],
                ],
            ],
            [
                'icon' => 'bar-chart-2',
                'label' => 'Gunung Api',
                'link' => [
                    [
                        'icon' => 'layers',
                        'label' => 'Data Dasar',
                        'link' => route('dashboard.gunung-api.data-dasar.index'),
                        'policies' => [
                            Param::MANAGE_VOLCANO_BASIC_DATA_POLICY
                        ],
                    ],
                    [
                        'icon' => 'activity',
                        'label' => 'Tingkat Aktivitas',
                        'link' => route('dashboard.gunung-api.tingkat-aktivitas.index'),
                        'policies' => [
                            Param::MANAGE_VOLCANO_ACTIVITY_LEVEL_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'Laporan Aktivitas',
                        'link' => 'https://magma.esdm.go.id/v1/gunung-api/laporan',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'Informasi Letusan',
                        'link' => 'https://magma.esdm.go.id/v1/gunung-api/informasi-letusan',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'CCTV Gunung Api',
                        'link' => '#',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'Gallery Foto',
                        'link' => '#',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'Peta KR Gunung Api',
                        'link' => '#',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'Live Seismogram',
                        'link' => '#',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'VONA',
                        'link' => '#',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                ],
            ],
            [
                'icon' => 'activity',
                'label' => 'Gerakan Tanah',
                'link' => [
                    [
                        'icon' => 'hash', //'list',
                        'label' => 'Daftar Kejadian',
                        'link' => '#', //route('dashboard.gerakan-tanah.index', ['category' => Param::GROUND_MOVEMENT_EVENT]),
                        'policies' => [
                            Param::MANAGE_GROUND_MOVEMENT_EVENT_POLICY
                        ],
                    ],
                    [
                        'icon' => 'message-square',
                        'label' => 'Tanggapan Kejadian',
                        'link' => route('dashboard.tanggapan-kejadian.index'),
                        'policies' => [
                            Param::MANAGE_GROUND_MOVEMENT_INCIDENT_RESPONSE_POLICY
                        ],
                    ],
                    [
                        'icon' => 'alert-triangle',
                        'label' => 'Peringatan Dini',
                        'link' => route('dashboard.gerakan-tanah.index', ['category' => Param::GROUND_MOVEMENT_EARLY_WARNING]),
                        'policies' => [
                            Param::MANAGE_GROUND_MOVEMENT_EARLY_WARNING_POLICY
                        ],
                    ],
                    [
                        'icon' => 'book-open',
                        'label' => 'Rekapitulasi Kejadian',
                        'link' => route('dashboard.gerakan-tanah.index', ['category' => Param::GROUND_MOVEMENT_EVENT_RECAP]),
                        'policies' => [
                            Param::MANAGE_GROUND_MOVEMENT_EVENT_RECAP_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'Peta ZKGT',
                        'link' => '#',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                ],
            ],
            [
                'icon' => 'globe',
                'label' => 'Gempa Bumi & Tsunami',
                'link' => [
                    [
                        'icon' => 'hash',
                        'label' => 'Rekapitulasi Kejadian',
                        'link' => '#',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash', //'list',
                        'label' => 'Daftar Kejadian',
                        'link' => '#', //route('dashboard.gempa-bumi-tsunami.daftar-kejadian.index'),
                        'policies' => [
                            Param::MANAGE_EARTHQUAKES_AND_TSUNAMI_EVENT_POLICY
                        ],
                    ],
                    [
                        'icon' => 'book-open',
                        'label' => 'Kajian Kejadian',
                        'link' => route('dashboard.gempa-bumi-tsunami.kajian-kejadian.index'),
                        'policies' => [
                            Param::MANAGE_EARTHQUAKES_AND_TSUNAMI_EVENT_REVIEW_POLICY
                        ],
                    ],
                    [
                        'icon' => 'file-text',
                        'label' => 'Laporan Singkat',
                        'link' => route('dashboard.gempa-bumi-tsunami.laporan-singkat.index'),
                        'policies' => [
                            Param::MANAGE_EARTHQUAKES_AND_TSUNAMI_EVENT_REPORT_POLICY
                        ],
                    ],
                    [
                        'icon' => 'radio',
                        'label' => 'Publikasi Mitigasi',
                        'link' => route('dashboard.gempa-bumi-tsunami.publikasi-mitigasi.index'),
                        'policies' => [
                            Param::MANAGE_EARTHQUAKES_AND_TSUNAMI_MITIGATION_PUBLICATION_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'Katalog Gempa',
                        'link' => '#',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'Peta KRB Gempa',
                        'link' => '#',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'Peta KRB Tsunami',
                        'link' => '#',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                ],
            ],
            [
                'icon' => 'menu',
                'label' => 'Layanan Publik',
                'link' => [
                    [
                        'icon' => 'award',
                        'label' => 'Reformasi Birokrasi',
                        'link' => route('dashboard.layanan-publik.index', ['category' => Param::PUBLIC_SERVICE_BUREAUCRATIC_REFORM]),
                        'policies' => [
                            Param::MANAGE_PUBLIC_SERVICE_BUREAUCRATIC_REFORM_POLICY
                        ],
                    ],
                    [
                        'icon' => 'info',
                        'label' => 'Diseminasi Informasi',
                        'link' => route('dashboard.layanan-publik.index', ['category' => Param::PUBLIC_SERVICE_INFORMATION_DISSEMINATION]),
                        'policies' => [
                            Param::MANAGE_PUBLIC_SERVICE_INFORMATION_DISSEMINATION_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'Kerja Sama',
                        'link' => [
                            [
                                'icon' => '',
                                'label' => 'Informasi Kerja Sama',
                                'link' => '#', // route('dashboard.layanan-publik.kerja-sama.informasi'),
                                'policies' => [
                                    Param::MANAGE_PUBLIC_SERVICE_COLLABORATION_INFORMATION_POLICY
                                ],
                            ],
                            [
                                'icon' => '',
                                'label' => 'Dalam Negeri',
                                'link' => '#',
                                'policies' => [
                                    Param::DEFAULT_ACCESS_POLICY
                                ],
                            ],
                            [
                                'icon' => '',
                                'label' => 'Luar Negeri',
                                'link' => '#',
                                'policies' => [
                                    Param::DEFAULT_ACCESS_POLICY
                                ],
                            ],
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'Permohonan Data',
                        'link' => '#',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'Permohonan API',
                        'link' => '#',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'Praktek Kerja Lapangan',
                        'link' => '#',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'Bimbingan Tugas Akhir',
                        'link' => '#',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                    [
                        'icon' => 'hash',
                        'label' => 'Pengaduan',
                        'link' => '#',
                        'policies' => [
                            Param::DEFAULT_ACCESS_POLICY
                        ],
                    ],
                    [
                        'icon' => 'mail',
                        'label' => 'Kontak',
                        'link' => route('dashboard.layanan-publik.kontak'),
                        'policies' => [
                            Param::MANAGE_PUBLIC_SERVICE_CONTACT_POLICY
                        ],
                    ],
                    [
                        'icon' => 'info',
                        'label' => 'Pengumuman',
                        'link' => route('dashboard.layanan-publik.pengumuman.index'),
                        'policies' => [
                            Param::MANAGE_PUBLIC_SERVICE_ANNOUNCMENT_POLICY
                        ],
                    ],
                ],
            ],
        ];
    }

    public function get()
    {
        $user = Auth::user();
        if ($user->role != null) {
            if ($user->role->slug == Param::ROLE_SLUG_ADMIN) {
                $policies = collect(config('pvmbg.policies'))->keys()->toArray();
            } else {
                $policies = json_decode(optional($user->role)->policies);
            }
        } else {
            $policies = [];
        }
        $policies[] = Param::DEFAULT_ACCESS_POLICY;
        $menus = $this->menus();

        return $this->filteringMenu($menus, $policies);
    }

    protected function filteringMenu($menus, $policies)
    {
        foreach ($menus as $menuIndex => $menu) {
            $menu['policies'] = data_get($menu, 'policies', []);
            $link = data_get($menu, 'link');
            if (is_array($link)) {
                $menu['link'] = $this->filteringMenu($link, $policies);
                foreach ($menu['link'] as $item) {
                    $menu['policies'] = array_merge($menu['policies'], $item['policies']);
                }
            }

            $menu['policies'] = array_intersect($policies, $menu['policies']);
            if (empty($menu['policies'])) {
                unset($menus[$menuIndex]);
            } else {
                $menus[$menuIndex] = $menu;
            }
        }

        return $menus;
    }
}
