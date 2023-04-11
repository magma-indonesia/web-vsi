<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
class ForgotController extends Controller
{
    /**
     * Show login blade
     *
     * @return View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index()
    {
        return view('forgot.index');
    }

    /**
     * 
     * Forgot password
     */
    public function forgot(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'csrf' => csrf_token()
                ], 400);
            }

            $u = User::where('email', $request['email'])->first();
            if (!$u) {
                return response()->json([
                    'message' => "Email belum terdaftar pada sistem.",
                    'csrf' => csrf_token()
                ], 400);
            }

            $link = Password::sendResetLink($request->only("email"));
            if ($link !== Password::RESET_LINK_SENT) {
                return response()->json([
                    'message' => 'Terjadi kesalahan pada server, gagal mengirim tautan silahkan coba kembali.',
                    'csrf' => csrf_token()
                ], 400);
            }

            return response()->json([
                'message' => "Kami telah mengirimkan tautan pembaruan password ke email Anda, silahkan cek tautan tersebut.",
                'csrf' => csrf_token()
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'csrf' => csrf_token()
            ], 500);
        }
    }

    /**
     * 
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'csrf' => csrf_token()
                ], 400);
            }

            $verify = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );
            if ($verify !== Password::PASSWORD_RESET) {
                return response()->json([
                    'message' => 'Terjadi kesalahan pada server, gagal reset password silahkan coba kembali.',
                    'csrf' => csrf_token()
                ], 400);
            }

            return response()->json([
                'message' => 'Password berhasil terganti, silahkan coba login kembali.',
                'csrf' => csrf_token()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'csrf' => csrf_token()
            ], 500);
        }
    }
}
