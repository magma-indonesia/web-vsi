<?php

namespace App\Http\Controllers\Landing;
use App\Http\Controllers\Controller;
use App\Models\EqtReport;
use Illuminate\Http\Request;

class EqtReportController extends Controller
{
    public function index()
    {
        return view("home.gempa-bumi-tsunami.laporan-singkat.index");
    }

    public function detail(Request $request)
    {
        $route = $request->route;

        $retrieve = EqtReport::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gempa-bumi-tsunami.laporan-singkat.detail", compact("retrieve"));
    }
}
