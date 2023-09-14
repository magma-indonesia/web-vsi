<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PragmaRX\Countries\Package\Countries;

class ContactController extends Controller
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
        return view('home.layanan-publik.hubungi-kami.index', compact('countries'));
    }

    public function save(Request $request) {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required'
            ]);
            if ($validator->fails()) {
                DB::commit();
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'serve' => []
                ], 400);
            }

            $c = new Contact();
            $c->subject = $request->subject;
            $c->name = $request->name;
            $c->email = $request->email;
            $c->message = $request->message;
            $c->save();
            
            DB::commit();
            return response()->json([
                'message' => 'Pesan berhasil terkirim dan telah kami terima, harap tunggu balasan dari kami.',
                'serve' => [],
            ], 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }
}
