<?php

namespace App\Http\Controllers\Landing;
use App\Http\Controllers\Controller;
use App\Models\GroundResponse;
use Illuminate\Http\Request;

class GroundResponseController extends Controller
{
    public function index()
    {
        return view("home.gerakan-tanah.tanggapan-kejadian.index");
    }

    public function detail(Request $request)
    {
        $route = $request->route;

        $retrieve = GroundResponse::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gerakan-tanah.tanggapan-kejadian.detail", compact("retrieve"));
    }
}
