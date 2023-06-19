<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $contents = 'dashboard.template.body';

    public function index()
    {
        return view("dashboard.layanan-publik.kontak.index", [
            'appUrl' => env('APP_URL'),
            'contents' => $this->contents,
        ]);
    }

    public function detail(Request $request)
    {
        try {
            $id = $request->query("id");
          
            $contacts = Contact::where('id', $id)->first();
            return response()->json([
                'message' => '',
                'serve' => $contacts,
            ], 200);
        } catch (\Throwable $e) {
            abort(500, $e->getMessage());
        }
    }
}