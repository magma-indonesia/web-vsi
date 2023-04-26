<?php

namespace App\Http\Controllers\Landing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function detailDataDasar(Request $request)
    {
        $route = $request->route;

        $retrieve = News::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gunung-api.data-dasar.detail", compact("retrieve"));
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
}