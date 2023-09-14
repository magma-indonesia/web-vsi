<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Throwable;

class UserController extends Controller
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

            $data = User::query()
                ->when($search, function ($query) use ($search) {
                    $query
                        ->where('name', 'like', '%'.$search.'%')
                        ->orWhere('nip', 'like', '%'.$search.'%');
                })
                ->orderBy('nip', 'asc')
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
                    'segment_id' => ['required'],
                    'nip' => ['required'],
                    'name' => ['required'],
                    'position' => ['required'],
                    'group_class' => ['required'],
                    'password' => ['required'],
                ],
                [
                    'segment_id.required' => 'Bagian harus dipilih',
                    'nip.required' => 'NIP harus diisi',
                    'name.required' => 'Nama harus diisi',
                    'position.required' => 'Jabatan harus diisi',
                    'group_class.required' => 'Golongan harus dipilih',
                    'password.required' => 'Password harus diisi',
                ]
            );
           
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'serve' => []
                ], 400);
            }

            $user = new User();
            $user->id_segment = $request->segment_id;
            $user->nip = $request->nip;
            $user->name = $request->name;
            $user->position = $request->position;
            $group = explode("/", $request->group_class)[0];
            $user->group = $group;
            $class = explode("/", $request->group_class)[1];
            $user->class = $class;
            $user->password = $request->password;
            $user->is_active = 1;
            $user->save();

            if (!empty($request->role_id)) {
                $user->roles()->sync([$request->role_id]);
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
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'segment_id' => ['required'],
                    'nip' => ['required'],
                    'name' => ['required'],
                    'position' => ['required'],
                    'group_class' => ['required'],
                ],
                [
                    'segment_id.required' => 'Bagian harus dipilih',
                    'nip.required' => 'NIP harus diisi',
                    'name.required' => 'Nama harus diisi',
                    'position.required' => 'Jabatan harus diisi',
                    'group_class.required' => 'Golongan harus dipilih',
                ]
            );
           
            if ($validator->fails()) {
                DB::commit();
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'serve' => []
                ], 400);
            }

            $user = User::where('id', $request->id)->first();
            if (!$user) {
                return response()->json([
                    'message' => "Gagal mendapatkan data.",
                    'serve' => []
                ], 400);
            }
            
            $user->id_segment = $request->segment_id;
            $user->nip = $request->nip;
            $user->name = $request->name;
            $user->position = $request->position;
            $group = explode("/", $request->group_class)[0];
            $user->group = $group;
            $class = explode("/", $request->group_class)[1];
            $user->class = $class;
            if ($request->password) {
                $user->password = $request->password;
            }
            $user->is_active = $request->is_active;
            $user->save();

            if (empty($request->role_id)) {
                $user->roles()->detach();
            } else {
                $user->roles()->sync([$request->role_id]);
            }

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
            $user = User::where('id', $request->id)->first();
            if (!$user) {
                return response()->json([
                    'message' => "Gagal mendapatkan data.",
                    'serve' => []
                ], 400);
            }

            $user->delete();
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
    public function updatePassword(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'password' => ['required'],
                ],
                [
                    'password.required' => 'Password wajib diisi',
                ]
            );
           
            if ($validator->fails()) {
                DB::commit();
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'serve' => []
                ], 400);
            }

            $user = User::where('id', $request->id)->first();
            if (!$user) {
                return response()->json([
                    'message' => "Gagal mendapatkan data.",
                    'serve' => []
                ], 400);
            }
            
            $user->password = $request->password;
            $user->save();

            DB::commit();

            return response()->json([
                'message' => 'Password berhasil diubah.',
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
