<?php

namespace App\Http\Controllers\Landing;
use App\Http\Controllers\Controller;
use App\Models\EqtMitigationPublication;
use Illuminate\Http\Request;

class EqtMitigationPublicationController extends Controller
{
    public function index()
    {
        return view("home.gempa-bumi-tsunami.publikasi-mitigasi.index");
    }

    public function detail(Request $request)
    {
        $route = $request->route;

        $retrieve = EqtMitigationPublication::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gempa-bumi-tsunami.publikasi-mitigasi.detail", compact("retrieve"));
    }
}
