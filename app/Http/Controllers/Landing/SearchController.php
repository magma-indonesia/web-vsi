<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\PressRelease;
use App\Models\VolcanoBase;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function index(Request $request)
    {
        $data['pressReleases'] = PressRelease::where('title', 'like', '%' . $request->keyword . '%')
            ->orWhere('content', 'like', '%' . $request->keyword . '%')
            ->get();
        $data['volcanoBases'] = VolcanoBase::where('title', 'like', '%' . $request->keyword . '%')
            ->orWhere('content', 'like', '%' . $request->keyword . '%')
            ->get();

        // $data['results'] = $volcanoBase->union($pressReleases)->paginate(10);        


        // dd($data['results'], PressRelease::where('title', 'like', '%' . $request->keyword . '%')->get());
        return view("home.hasil-pencarian.index", $data);
    }

}
