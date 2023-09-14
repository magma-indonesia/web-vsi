<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Param;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Throwable;

class RoleController extends Controller
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

            $data = Role::query()
                ->where('slug', '!=', Param::ROLE_SLUG_ADMIN)
                ->when($search, function ($query) use ($search) {
                    $query
                        ->where('name', 'like', '%'.$search.'%');
                })
                ->orderBy('id', 'asc')
                ->paginate($request->pageSize);

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
                    'name' => ['required'],
                    'slug' => ['required'],
                    'description' => ['required'],
                ],
                [
                    'name.required' => 'Nama harus diisi',
                    'slug.required' => 'Slug harus diisi',
                    'description.required' => 'Deskripsi harus diisi',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'serve' => []
                ], 400);
            }

            $role = new Role();
            $role->name = $request->name;
            $role->slug = $request->slug;
            $role->description = $request->description;
            $role->save();

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
                    'name' => ['required'],
                    'slug' => ['required'],
                    'description' => ['required'],
                ],
                [
                    'name.required' => 'Nama harus diisi',
                    'slug.required' => 'Slug harus diisi',
                    'description.required' => 'Deskripsi harus diisi',
                ]
            );

            if ($validator->fails()) {
                DB::commit();

                return response()->json([
                    'message' => $validator->errors()->first(),
                    'serve' => []
                ], 400);
            }

            $role = Role::where('id', $request->id)->first();
            if (!$role) {
                return response()->json([
                    'message' => "Gagal mendapatkan data.",
                    'serve' => []
                ], 400);
            }

            $role->name = $request->name;
            $role->slug = $request->slug;
            $role->description = $request->description;
            $role->save();

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
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::where('id', $request->id)->first();
            if (!$role) {
                return response()->json([
                    'message' => "Gagal mendapatkan data.",
                    'serve' => []
                ], 400);
            }

            $role->delete();
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePolicy(Request $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::where('id', $request->id)->first();
            $policies = $request->policy ?? [];
            if (!$role) {
                return response()->json([
                    'message' => "Gagal mendapatkan data.",
                    'serve' => []
                ], 400);
            }

            $role->policies = json_encode($policies);
            $role->save();

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
}
