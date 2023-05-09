<?php

namespace App\Http\Controllers\Landing;
use App\Http\Controllers\Controller;
use App\Models\EqtStudyEvent;
use Illuminate\Http\Request;

class EqtStudyEventController extends Controller
{
    public function index()
    {
        return view("home.gempa-bumi-tsunami.kajian-kejadian.index");
    }

    public function detail(Request $request)
    {
        $route = $request->route;

        $retrieve = EqtStudyEvent::where("route", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gempa-bumi-tsunami.kajian-kejadian.detail", compact("retrieve"));
    }
}
