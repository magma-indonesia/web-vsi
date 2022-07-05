<?php

namespace App\Http\Controllers;

use App\Services\Sipeg\Interfaces\SipegInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function __construct(
        private SipegInterface $sipegService
    ){}

    public function sipeg(Request $request)
    {
        $response = Http::sipeg()->get('/employee', [
            'nip' => $request->user()->nip,
        ])->json();

        return $response;
    }

    public function sipegProvider()
    {
        return response()->json([
            'data' => $this->sipegService->daftarJabatan()
        ]);
    }
}
