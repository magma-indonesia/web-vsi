<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function sipeg(Request $request)
    {
        $response = Http::sipeg()->get('/employee', [
            'nip' => $request->user()->nip,
        ])->json();

        return $response;
    }
}
