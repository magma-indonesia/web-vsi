<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadFile(Request $request){
        try {
            if(!$request->file()){
                return response()->json([
                    'message' => 'Upload gagal.', 
                    'serve' => []
                ], 400);
            }
            
            $path = Storage::putFile(
                'public/upload/files',
                $request->file('file'),
            );
            
            return response()->json([
                'message' => '', 
                'serve' => [
                    "url"=> url('/')."/storage/".str_replace('public/', "", $path),
                    "uid"=> $path,
                    "status"=>"done",
                    "name"=> $path
                ]
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }
    public function uploadFileBase64(Request $request){
        try {
            if(!$request->base64){
                return response()->json([
                    'message' => 'Upload gagal.', 
                    'serve' => []
                ], 400);
            }
            
            $file = base64_decode($request->base64);
            $file_name = base64_encode(random_bytes(10)).".".$request->extension;
            $file_destination_path = storage_path('app/public/upload/files/').$file_name;
            $put = file_put_contents($file_destination_path, $file);
            if ($put) {
                return response()->json([
                    'message' => '', 
                    'serve' => [
                        "url"=>url('/').'/storage/upload/files/'.$file_name,
                        "name"=>$file_name
                    ]
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Upload gagal.', 
                    'serve' => []
                ], 400);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }
}