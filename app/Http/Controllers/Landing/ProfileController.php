<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Param;

class ProfileController extends Controller
{
    public function showAbout()
    {
        $retrieve = Profile::where("category_id", Param::PROFILE_ABOUT)->first();
        if (!$retrieve) {
            abort(404);
        }

        // relation object set from Model somehow won't reflect in vue component, and i don't fucking know why
        $retrieve->name = $retrieve->author->name;

        return view("home.profile.tentang-pvmbg.index", [
            'retrieve' => $retrieve,
        ]);
    }

    public function showStructure()
    {
        $retrieve = Profile::where("category_id", Param::PROFILE_STRUCTURE)->first();
        if (!$retrieve) {
            abort(404);
        }
        $retrieve->name = $retrieve->author->name;

        return view("home.profile.struktur-organisasi.index", [
            'retrieve' => $retrieve,
        ]);
    }

    public function showHistory()
    {
        $retrieve = Profile::where("category_id", Param::PROFILE_HISTORY)->first();
        if (!$retrieve) {
            abort(404);
        }
        $retrieve->name = $retrieve->author->name;

        return view("home.profile.sejarah.index", [
            'retrieve' => $retrieve,
        ]);
    }
}
