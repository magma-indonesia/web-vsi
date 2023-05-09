<?php

namespace App\Http\Controllers\Landing;
use App\Http\Controllers\Controller;
use App\Models\PressRelease;
use Illuminate\Http\Request;

class PressReleaseController extends Controller
{
    public function index()
    {
        return view("home.press-release.index");
    }

    public function detail(Request $request)
    {
        $route = $request->route;

        $retrieve = PressRelease::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.press-release.detail", compact("retrieve"));
    }
}
