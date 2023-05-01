<?php

namespace App\Http\Controllers\Landing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function indexDataDasar(Request $request)
    {
        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();

        return view("home.gunung-api.data-dasar.index", compact("tingkatAktivitas"));
    }

    public function detailDataDasar(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();
        return view("home.gunung-api.data-dasar.detail", compact("retrieve", "tingkatAktivitas"));
    }

    public function indexTingkatAktivitas(Request $request)
    {
        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();

        return view("home.gunung-api.tingkat-aktivitas.index", compact("tingkatAktivitas"));
    }

    public function detailTingkatAktivitas(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();
        return view("home.gunung-api.tingkat-aktivitas.detail", compact("retrieve", "tingkatAktivitas"));
    }

    public function indexPressRelease(Request $request)
    {
        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();

        return view("home.gunung-api.press-release.index", compact("tingkatAktivitas"));
    }

    public function detailPressRelease(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();
        return view("home.gunung-api.press-release.detail", compact("retrieve", "tingkatAktivitas"));
    }

    public function indexTanggapanKejadian(Request $request)
    {
        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();

        return view("home.gerakan-tanah.tanggapan-kejadian.index", compact("tingkatAktivitas"));
    }

    public function detailTanggapanKejadian(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();
        return view("home.gerakan-tanah.tanggapan-kejadian.detail", compact("retrieve", "tingkatAktivitas"));
    }

    public function indexKajianKejadian(Request $request)
    {
        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();

        return view("home.gempa-bumi-tsunami.kajian-kejadian.index", compact("tingkatAktivitas"));
    }

    public function detailKajianKejadian(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();
        return view("home.gempa-bumi-tsunami.kajian-kejadian.detail", compact("retrieve", "tingkatAktivitas"));
    }

    public function indexDaftarKejadian(Request $request)
    {
        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();

        return view("home.gempa-bumi-tsunami.daftar-kejadian.index", compact("tingkatAktivitas"));
    }

    public function detailDaftarKejadian(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();
        return view("home.gempa-bumi-tsunami.daftar-kejadian.detail", compact("retrieve", "tingkatAktivitas"));
    }

    public function indexPublikasiMitigasi(Request $request)
    {
        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();

        return view("home.gempa-bumi-tsunami.publikasi-mitigasi.index", compact("tingkatAktivitas"));
    }

    public function detailPublikasiMitigasi(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();
        return view("home.gempa-bumi-tsunami.publikasi-mitigasi.detail", compact("retrieve", "tingkatAktivitas"));
    }

    public function indexLaporanSingkat(Request $request)
    {
        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();

        return view("home.gempa-bumi-tsunami.laporan-singkat.index", compact("tingkatAktivitas"));
    }

    public function detailLaporanSingkat(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        $lc = new LandingController;
        $tingkatAktivitas = $lc->getTingkatAktivitas();
        return view("home.gempa-bumi-tsunami.laporan-singkat.detail", compact("retrieve", "tingkatAktivitas"));
    }
}