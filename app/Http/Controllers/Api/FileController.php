<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');
            $userId = $request->query('user_id');

            if (!empty($userId)) {
                $data = File::query()
                    ->where('user_id', $userId)
                    ->where('is_tmp', false)
                    ->when($search, function ($query) use ($search) {
                        $query->where('name', 'like', '%'.$search.'%');
                    })
                    ->orderBy('created_at', 'asc')
                    ->paginate($request->pageSize);
            } else {
                $data = User::query()
                    ->whereHas('uploadCenters', function ($query) {
                        $query->where('is_tmp', false);
                    })
                    ->when($search, function ($query) use ($search) {
                        $query
                            ->where('name', 'like', '%'.$search.'%')
                            ->orWhere('nip', 'like', '%'.$search.'%');
                    })
                    ->orderBy('nip', 'asc')
                    ->paginate($request->pageSize);
            }

            return response()->json([
                'message' => '',
                'serve' => $data,
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'files' => ['required'],
                    'files.*' => ['file'],
                ],
                [
                    'files.required' => 'File harus dipilih',
                ]
            );
           
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'serve' => []
                ], 400);
            }

            foreach ($request->file('files') as $fileUpload) {
                $fileName = $fileUpload->getClientOriginalName();
                $fileNameExist = File::query()
                    ->where('user_id', $this->user()->id)
                    ->where('name', $fileName)
                    ->get();
                if ($fileNameExist->count() > 0) {
                    $ext = '.'.$fileUpload->getClientOriginalExtension();
                    $fileName = str_replace($ext, '('.$fileNameExist->count().')'.$ext, $fileName);
                }
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
                $file->label = $request->label;
                $file->save();
            }

            DB::commit();

            return response()->json([
                'message' => 'Data berhasil ditambahkan.',
                'serve' => [],
            ], 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
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
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = File::where('id', $request->id)->first();
            if (!$data) {
                return response()->json([
                    'message' => "Gagal mendapatkan data.",
                    'serve' => []
                ], 400);
            }

            Storage::delete('public/'.$data->path);
            $data->delete();
            DB::commit();

            return response()->json([
                'message' => 'Data berhasil dihapus.',
                'serve' => [],
            ], 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }

    public function indexLabel()
    {
        try {
            $data = File::query()
                ->where('is_tmp', false)
                ->select('label')
                ->distinct()
                ->get()
                ->map(fn($item) => $item->label);

            return response()->json([
                'message' => '',
                'serve' => $data,
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }
}
