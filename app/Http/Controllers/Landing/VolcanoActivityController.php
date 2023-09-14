<?php

namespace App\Http\Controllers\Landing;
use App\Http\Controllers\Controller;
use App\Models\VolcanoActivity;
use Illuminate\Http\Request;

class VolcanoActivityController extends Controller
{
    public function index()
    {
        return view("home.gunung-api.tingkat-aktivitas.index");
    }

    public function detail(Request $request)
    {
        $route = $request->route;

        $retrieve = VolcanoActivity::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gunung-api.tingkat-aktivitas.detail", compact("retrieve"));
    }
}
