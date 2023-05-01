<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                    'title' => ['required'],
                    'description' => ['required'],
                ],
                [
                    'title.required' => 'Judul Artikel harus dipilih',
                    'description.required' => 'Deskripsi Artikel harus diisi',
                ]
            );
           
            if ($validator->fails()) {
                DB::commit();
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'serve' => []
                ], 400);
            }

            $data = new Profile();
            $data->category_id = $request->category;
            $data->title = $request->title;
            $data->description = $request->description;
            // $data->thumbnail = $request->thumbnail;
            $slug = Str::slug($request->title);
            $data->slug = $slug;
            $data->author_id = $this->user()->id;
            $data->save();

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
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => ['required'],
                    'description' => ['required'],
                ],
                [
                    'title.required' => 'Judul Artikel harus dipilih',
                    'description.required' => 'Deskripsi Artikel harus diisi',
                ]
            );
           
            if ($validator->fails()) {
                DB::commit();
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'serve' => []
                ], 400);
            }

            $data = Profile::where('id', $request->id)->first();
            if (!$data) {
                return response()->json([
                    'message' => "Gagal mendapatkan data.",
                    'serve' => []
                ], 400);
            }

            if ($data->title != $request->title) {
                $slug = Str::slug($request->title);
                $data->slug = $slug;
            }
            $data->title = $request->title;
            $data->description = $request->description;
            // $data->thumbnail = $request->thumbnail;
            $data->author_id = $this->user()->id;
            $data->save();

            DB::commit();

            return response()->json([
                'message' => 'Data berhasil diubah.',
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
