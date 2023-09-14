<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("news_categories")->insert([
            [
                "id" => 1,
                "category" => "Data Dasar Gunung Api",
            ],
            [
                "id" => 2,
                "category" => "Aktivitas Gunung Api",
            ],
            [
                "id" => 3,
                "category" => "Press Release Gunung Api",
            ],
            [
                "id" => 4,
                "category" => "Tanggapan Kejadian Gerakan Tanah",
            ],
            [
                "id" => 5,
                "category" => "Kajian Kejadian Gempa Bumi & Tsunami",
            ],
            [
                "id" => 6,
                "category" => "Daftar Kejadian Gempa Bumi & Tsunami",
            ],
            [
                "id" => 7,
                "category" => "Publikasi Mitigasi Gempa Bumi & Tsunami",
            ],
            [
                "id" => 8,
                "category" => "Laporan Singkat Gempa Bumi & Tsunami",
            ],
            [
                "id" => 9,
                "category" => "Pengumuman",
            ]
        ]);
    }
}
