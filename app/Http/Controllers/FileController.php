<?php

namespace App\Http\Controllers;

use App\Models\File;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $search = $request->search;
        $files = File::query()
            ->where('user_id', $this->user()->id)
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('settings.file.index', [
            'contents' => $this->contents,
            'pageTitle' => 'Upload Center',
            'createUrl' => route('settings.upload.create'),
            'files' => $files,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.file.form', [
            'contents' => $this->contents,
            'pageTitle' => 'Upload Center',
            'saveUrl' => route('settings.upload.store'),
            'isUpdate' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'file_uploads' => ['required'],
                'file_uploads.*' => ['file'],
            ],
            [
                'file_uploads.required' => 'File harus dipilih',
            ]
        );

        try {
            foreach ($request->file('file_uploads') as $fileUpload) {
                $fileName = $fileUpload->getClientOriginalName();
                $filePath = 'files/'.$this->user()->nip;
                Storage::putFileAs(
                    'public/'.$filePath,
                    $fileUpload,
                    $fileName
                );
    
                $file = new File();
                $file->user_id = $this->user()->id;
                $file->name = $fileName;
                $file->path = $filePath.'/'.$fileName;
                $file->save();
            }
        } catch (Exception $e) {
            return $this->errorRedirectBack($e);
        }

        return $this->successRedirect('settings.upload.create', 'Data upload berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $file = File::find($id);
            Storage::delete('public/'.$file->path);
            $file->delete();
        } catch (Exception $e) {
            return $this->errorRedirectBack($e);
        }

        return $this->successRedirect('settings.upload.index', 'Data upload berhasil dihapus.');
    }

    public function download($id, $name)
    {
        $file = File::findOrFail($id);
        if ($file->name != $name) {
            http_response_code(404);

            die();
        }

        $fileName = basename($file->path);
        $filePath = storage_path('app/public/'.$file->path);
        if (! file_exists($filePath)) {
            http_response_code(404);

            die();
        }

        return Storage::download('public/'.$file->path, $fileName, [
            'Content-Disposition' => 'inline; filename='.$fileName
        ]);
    }
}
