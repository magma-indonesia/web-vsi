<?php

namespace App\Http\Controllers\Landing;
use App\Http\Controllers\Controller;
use App\Models\EqtListEvent;
use Illuminate\Http\Request;

class EqtListEventController extends Controller
{
    public function index()
    {
        return view("home.gempa-bumi-tsunami.daftar-kejadian.index");
    }

    public function detail(Request $request)
    {
        $route = $request->route;

        $retrieve = EqtListEvent::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gempa-bumi-tsunami.daftar-kejadian.detail", compact("retrieve"));
    }
}
