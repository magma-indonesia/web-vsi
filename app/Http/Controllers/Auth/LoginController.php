<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\AuthenticatesUsers;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth as AuthUser;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;

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
     * Login API URL
     *
     * @return string
     */
    protected function loginApiUrl(): string
    {
        return config('magma.url').'/login';
    }

    /**
     * Get user information from MAGMA
     *
     * @param string $username
     * @return string
     */
    protected function userApiUrl(string $username): string
    {
        return config('magma.url') . '/v1/user/'. $username;
    }

    /**
     * Get user from MAGMA using token
     *
     * @param LoginRequest $request
     * @param string $token
     * @return array
     */
    protected function getUserFromMagma(LoginRequest $request, string $token): array
    {
        return Http::withToken($token)
            ->get($this->userApiUrl($request->username))
            ->json()['data'];
    }

    /**
     * Login with MAGMA
     *
     * @param LoginRequest $request
     * @return boolean
     */
    protected function loginWithMagma(LoginRequest $request): bool
    {
        if (AuthUser::check()) {
            return true;
        }

        $response = Http::acceptJson()->post($this->loginApiUrl(), [
            'username' => $request->username,
            'password' => $request->password,
        ])->json();

        if ($response['success']) {
            AuthUser::login($this->saveToDatabase(
                $this->getUserFromMagma($request, $response['token']),
                $request->password,
            ));

            return true;
        }

        return false;
    }

    /**
     * Save new user
     *
     * @param array $user
     * @param string $password
     * @return \App\Models\User
     */
    protected function saveToDatabase(array $user, string $password): User
    {
        $user = User::create([
            'uuid' => Str::uuid(),
            'name' => $user['name'],
            'nip' => $user['nip'],
            'password' => $password,
            'is_active' => 1,
        ]);

        return $user;
    }

    /**
     * Update login stats
     *
     * @param Request $request
     * @return self
     */
    protected function updateStatisticLogin(LoginRequest $request): self
    {
        $request->user()->statistik_logins()->updateOrCreate([
            'user_id' => auth()->user()->id,
            'ip_address' => $request->ip()
        ])->increment('hit');

        return $this;
    }

    /**
     * Login credentials
     *
     * @param LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request): mixed
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request) || $this->loginWithMagma($request)) {
            return $this->userIsActive($request)
                ->updateStatisticLogin($request)
                ->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
