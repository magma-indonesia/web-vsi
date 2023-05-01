<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\GroundMovement;
use Illuminate\Http\Request;

class GroundMovementController extends Controller
{
    public function showEvent(Request $request)
    {
        $route = $request->route;

        $retrieve = GroundMovement::where("slug", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gerakan-tanah.daftar-kejadian.detail", [
            'retrieve' => $retrieve,
        ]);
    }

    public function showEarlyWarning(Request $request)
    {
        $route = $request->route;

        $retrieve = GroundMovement::where("slug", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gerakan-tanah.peringatan-dini.detail", [
            'retrieve' => $retrieve,
        ]);
    }

    public function showEventRecap(Request $request)
    {
        $route = $request->route;

        $retrieve = GroundMovement::where("slug", $route)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("home.gerakan-tanah.rekapitulasi-kejadian.detail", [
            'retrieve' => $retrieve,
        ]);
    }
}
