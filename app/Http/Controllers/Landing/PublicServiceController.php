<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\PublicService;
use Illuminate\Http\Request;

class PublicServiceController extends Controller
{
    public function showBureaucraticReform(Request $request)
    {
        $route = $request->route;

        $retrieve = PublicService::where("slug", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.layanan-publik.reformasi-birokrasi.detail", [
            'retrieve' => $retrieve,
        ]);
    }
}
