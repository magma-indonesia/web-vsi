<?php

namespace App\Http\Controllers\Landing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function indexDataDasar(Request $request)
    {
        return view("home.gunung-api.data-dasar.index");
    }

    public function detailDataDasar(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gunung-api.data-dasar.detail", compact("retrieve"));
    }

    public function indexTingkatAktivitas(Request $request)
    {
        return view("home.gunung-api.tingkat-aktivitas.index");
    }

    public function detailTingkatAktivitas(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gunung-api.tingkat-aktivitas.detail", compact("retrieve"));
    }

    public function indexPressRelease(Request $request)
    {
        return view("home.gunung-api.press-release.index");
    }

    public function detailPressRelease(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gunung-api.press-release.detail", compact("retrieve"));
    }

    public function indexTanggapanKejadian(Request $request)
    {
        return view("home.gerakan-tanah.tanggapan-kejadian.index");
    }

    public function detailTanggapanKejadian(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gerakan-tanah.tanggapan-kejadian.detail", compact("retrieve"));
    }

    public function indexKajianKejadian(Request $request)
    {
        return view("home.gempa-bumi-tsunami.kajian-kejadian.index");
    }

    public function detailKajianKejadian(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gempa-bumi-tsunami.kajian-kejadian.detail", compact("retrieve"));
    }

    public function indexDaftarKejadian(Request $request)
    {
        return view("home.gempa-bumi-tsunami.daftar-kejadian.index");
    }

    public function detailDaftarKejadian(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gempa-bumi-tsunami.daftar-kejadian.detail", compact("retrieve"));
    }

    public function indexPublikasiMitigasi(Request $request)
    {
        return view("home.gempa-bumi-tsunami.publikasi-mitigasi.index");
    }

    public function detailPublikasiMitigasi(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gempa-bumi-tsunami.publikasi-mitigasi.detail", compact("retrieve"));
    }

    public function indexLaporanSingkat(Request $request)
    {
        return view("home.gempa-bumi-tsunami.laporan-singkat.index");
    }

    public function detailLaporanSingkat(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gempa-bumi-tsunami.laporan-singkat.detail", compact("retrieve"));
    }
}