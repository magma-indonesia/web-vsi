<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            $fileUpload = $request->file('file');
            $fileName = $fileUpload->getClientOriginalName();
            $filePath = 'files/thumbnail';
            Storage::putFileAs(
                $filePath,
                $fileUpload,
                $fileName
            );
            
            return response()->json([
                'message' => '', 
                'serve' => [
                    "url"=> $filePath.'/'.$fileName,
                    "uid"=> $filePath.'/'.$fileName,
                    "status"=>"done",
                    "name"=> $filePath.'/'.$fileName
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