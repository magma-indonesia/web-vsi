<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Traits\AuthenticatesUsers;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Show login blade
     *
     * @return View
     * @throws BindingResolutionException
     */
    public function index()
    {
        return view('login.index');
    }

    protected function loginApiUrl()
    {
        return config('magma.url').'/login';
    }

    protected function userApiUrl($username)
    {
        return config('magma.url') . '/v1/user/'. $username;
    }

    protected function loginMagma(string $token, string $username): mixed
    {
        $response = Http::withToken($token)
            ->get($this->userApiUrl($username))
            ->json();

        return $response['data'];
    }

    public function login(LoginRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->userIsActive($request)
                ->updateStatistikLogin()
                ->sendLoginResponse($request);
        }

        $response = Http::acceptJson()->post($this->loginApiUrl(), [
            'username' => $request->username,
            'password' => $request->password,
        ])->json();

        if ($response['success'])
            return $this->loginMagma($response['token'], $request->username);

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
