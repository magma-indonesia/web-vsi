<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Traits\AuthenticatesUsers;
use App\Traits\LoginWithMagma;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    use LoginWithMagma;

    /**
     * Show login blade
     *
     * @return View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index()
    {
        return view('login.index');
    }

    /**
     * Update login stats
     *
     * @param Request $request
     * @return self
     */
    protected function updateStatisticLogin(Request $request): self
    {
        $request->user()->loginStatistic()->updateOrCreate([
            'user_id' => auth()->user()->id,
            'ip_address' => $request->ip()
        ])->increment('hit');

        return $this;
    }

    /**
     * Set cookies for MAGMA User token
     *
     * @param Request $request
     * @return self
     */
    protected function setCookiesTokenUser(Request $request): self
    {
        if (isset($this->tokenUser)) {
            Cookie::queue('magma_user_token', $this->tokenUser, 60 * 24);
            return $this;
        }

        Cookie::queue('magma_user_token', $this->tokenUser($request), 60 * 24);

        return $this;
    }

    /**
     * Get the successed login response instance.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendSuccessedLoginResponse(Request $request)
    {
        return $this->userIsActive($request)
            ->setCookiesTokenUser($request)
            ->updateStatisticLogin($request)
            ->sendLoginResponse($request);
    }

    public function login(LoginRequest $request)
    {
        try {
            /** Validation schema */
            $validation = Validator::make($request->all(), $request->rules());
            
            /** Validation throw */
            if ($validation->fails()) {
                return response()->json([
                    'message' => $validation->errors()->first(),
                    'csrf' => csrf_token()
                ], 400);
            }

            /** Validation too many request */
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);
                return response()->json([
                    'message' => 'Terlalu banyak aksi, silahkan coba kembali nanti.',
                    'csrf' => csrf_token()
                ], 400);
            }

            /** Validation role guest or else */
            $credentials = $request->only('nip', 'password');
            if ($request->role == '5') {
                $credentials = $request->only('email', 'password');
            }

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Email atau password kurang tepat.',
                    'csrf' => csrf_token()
                ], 400);
            }

            /** Validation is active user */
            if (Auth::user()->is_active != '1') {
                Auth::guard()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return response()->json([
                    'message' => 'Akun tidak aktif, silahkan hubungi Admin untuk informasi lebih lanjut.',
                    'csrf' => csrf_token()
                ], 400);
            }

            /** Store statistic login */
            $request->user()->loginStatistic()->updateOrCreate([
                'user_id' => auth()->user()->id,
                'ip_address' => $request->ip()
            ])->increment('hit');

            $request->session()->regenerate();
            return response()->json([
                'message' => 'Login sukses.',
                'csrf' => csrf_token()
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'csrf' => csrf_token(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect("/login");
        } catch (\Throwable $e) {
            abort(500, $e->getMessage());
        }
    }
}
