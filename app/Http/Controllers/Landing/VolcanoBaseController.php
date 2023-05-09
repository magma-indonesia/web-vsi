<?php

namespace App\Http\Controllers\Landing;
use App\Http\Controllers\Controller;
use App\Models\VolcanoBase;
use Illuminate\Http\Request;

class VolcanoBaseController extends Controller
{
    public function index()
    {
        return view("home.gunung-api.data-dasar.index");
    }

    public function detail(Request $request)
    {
        $route = $request->route;

        $retrieve = VolcanoBase::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gunung-api.data-dasar.detail", compact("retrieve"));
    }
}
