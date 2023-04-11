<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
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
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                            ->back()
                            ->with("error", $validator->errors()->first())
                            ->withInput();
            }

            $clientIps = request()->getClientIps();
            $visitorIp = end($clientIps);

            $client = new Client();
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => env('RECAPTCHA_SERVERKEY'),
                    'response' => $request->token,
                    'remoteip' => $visitorIp
                ]
            ]);
            $dirtyResult = $response->getBody()->getContents();
            $result = json_decode($dirtyResult, true);
            
            if (!$result['success']) {
                return redirect()->back()->with("error", "Recaptcha error");
            }

            $c = new Contact();
            $c->subject = $request->subject;
            $c->name = $request->name;
            $c->email = $request->email;
            $c->message = $request->message;
            $c->save();
            
            return redirect()->back()->with("success", "Pesan berhasil terkirim dan telah kami terima, harap tunggu balasan dari kami.");
        } catch (\Throwable $e) {
            abort(500, $e->getMessage());
        }
    }
}
