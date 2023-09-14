<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Param;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class FileController extends Controller
{
    private $contents = 'dashboard.template.body';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roleSlug = $this->user()->role->slug;
        $loginId = $this->user()->id;
        $employee = User::where('id', $request->user_id)->first();
        $user = empty($employee) ? $this->user() : $employee;
        $mode = $request->mode ?? 'folder';
        // dd(env('APP_URL'));
        if (($roleSlug == Param::ROLE_SLUG_ADMIN && !empty($employee)) || $roleSlug != Param::ROLE_SLUG_ADMIN) {
            return view('dashboard.upload-center.employee-index', [
                'contents' => $this->contents,
                'pageTitle' => 'Upload Center',
                'roleSlug' => $roleSlug,
                'loginId' => $loginId,
                'user' => $user,
                'appUrl' => env('APP_URL'),
                'addUrl' => route('dashboard.upload-center.create'),
            ]);
        } else {
            return view('dashboard.upload-center.admin-index', [
                'contents' => $this->contents,
                'pageTitle' => 'Upload Center',
                'appUrl' => env('APP_URL'),
                'addUrl' => route('dashboard.upload-center.index', ['user_id' => $loginId]),
                'detailUrl' => route('dashboard.upload-center.index'),
                'mode' => $mode,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.upload-center.form', [
            'pageTitle' => 'Upload Center',
            'appUrl' => env('APP_URL'),
            'isUpdate' => false,
        ]);
    }

    public function download($id, $name)
    {
        $file = File::findOrFail($id);
        if ($file->name != $name) {
            http_response_code(404);

            die();
        }

        $fileName = basename($file->path);
        $filePath = storage_path('app/public/' . $file->path);
        if (!file_exists($filePath)) {
            http_response_code(404);

            die();
        }

        return Storage::download($file->path, $fileName, [
            'Content-Disposition' => 'inline; filename=' . $fileName
        ]);
    }

    public function storeImage(Request $request)
    {
        // if ($request->hasFile('upload')) {
        //     $fileUpload = $request->file('upload');
        //     $fileName = $fileUpload->getClientOriginalName();
        //     $ext = '.'.$fileUpload->getClientOriginalExtension();
        //     $fileName = str_replace($ext, '-'.date('dmYHi').$ext, $fileName);
        //     $filePath = 'images';
        //     Storage::putFileAs(
        //         'public/'.$filePath,
        //         $fileUpload,
        //         $fileName
        //     );

        //     $file = new File();
        //     $file->user_id = $this->user()->id;
        //     $file->name = $fileName;
        //     $file->path = $filePath.'/'.$fileName;
        //     $file->is_tmp = true;
        //     $file->save();

        //     return json_encode([
        //         'location' => $file->url(),
        //     ]);
        // }

        try {
            if (!$request->file()) {
                return response()->json([
                    'message' => 'Upload gagal.',
                    'serve' => []
                ], 400);
            }

            $fileUpload = $request->file('file');
            $fileName = $fileUpload->getClientOriginalName();
            $ext = '.' . $fileUpload->getClientOriginalExtension();
            $fileName = str_replace($ext, '-' . date('dmYHi') . $ext, $fileName);
            $filePath = 'images';
            Storage::putFileAs(
                $filePath,
                $fileUpload,
                $fileName
            );

            $file = new File();
            $file->user_id = $this->user()->id;
            $file->name = $fileName;
            $file->path = $filePath . '/' . $fileName;
            $file->is_tmp = true;
            $file->save();

            $url = str_replace(env('APP_URL'), '', $file->url());

            return response()->json([
                'message' => '',
                'serve' => [
                    'url' => $url,
                ]
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }
}