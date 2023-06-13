<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserRole;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show login blade
     *
     * @return View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index()
    {
        return view('register.index');
    }

    /**
     * 
     * Store data to database
     */
    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            /** Validation schema */
            $validation = Validator::make($request->all(), [
                'email' => 'required|email|max:255|unique:a_users',
                'first_name' => 'required',
                'institution' => 'required',
                'password' => 'required|string|min:8|confirmed',
            ]);

            /** Validation throw */
            if ($validation->fails()) {
                DB::commit();
                return response()->json([
                    'message' => $validation->errors()->first(),
                    'csrf' => csrf_token()
                ], 400);
            }

            $u = new User();
            $u->uuid = $u->bootGenerateUUID();
            $u->name = $request->first_name . " " . $request->last_name;
            $u->email = $request->email;
            $u->password = Hash::make($request->password);
            $u->save();

            $p = new UserProfile();
            $p->user_id = $u->id;
            $p->gender = $request->gender;
            $p->agama = $request->agama;
            $p->first_degree = $request->first_degree;
            $p->first_name = $request->first_name;
            $p->last_name = $request->last_name;
            $p->last_degree = $request->last_degree;
            $p->institution = $request->institution;
            $p->save();

            $r = new UserRole();
            $r->user_id = $u->id;
            $r->role_id = 5;
            $r->save();

            DB::commit();
            return response()->json([
                'message' => 'Daftar sukses.',
                'csrf' => csrf_token()
            ], 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'csrf' => csrf_token(),
            ], 500);
        }
    }
}