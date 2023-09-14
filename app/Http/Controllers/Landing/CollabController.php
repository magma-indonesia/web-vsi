<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use PragmaRX\Countries\Package\Countries;

class CollabController extends Controller
{
    public function index()
    {
        $countries = app(Countries::class)
            ->all()
            ->map(function ($country) {
                $commonName = $country->name->common;

                $languages = $country->languages ?? collect();

                $language = $languages->keys()->first() ?? null;

                $nativeNames = $country->name->native ?? null;

                if (
                    filled($language) &&
                    filled($nativeNames) &&
                    filled($nativeNames[$language]) ?? null
                ) {
                    $native = $nativeNames[$language]['common'] ?? null;
                }

                if (blank($native ?? null) && filled($nativeNames)) {
                    $native = $nativeNames->first()['common'] ?? null;
                }

                $native = $native ?? $commonName;

                if ($native !== $commonName && filled($native)) {
                    $native = "$native ($commonName)";
                }

                return array(
                    'code' => $country->cca3,
                    'native' => $native
                );
            })
            ->values()
            ->toArray();

        return view('home.layanan-publik.kerja-sama.informasi.index', compact('countries'));
    }
}
