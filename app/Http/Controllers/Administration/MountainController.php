<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Mountain;
use Illuminate\Http\Request;

class MountainController extends Controller
{
    public function get()
    {
        try {
            $data = Mountain::orderBy("ga_nama_gapi", "asc")->get();
            return response()->json([
                'message' => 'Data berhasil didapatkan.',
                'serve' => $data,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }
}
