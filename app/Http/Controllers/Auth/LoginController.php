<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\AuthenticatesUsers;
use App\Traits\LoginWithMagma;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
        $request->user()->statistik_logins()->updateOrCreate([
            'user_id' => auth()->user()->id,
            'ip_address' => $request->ip()
        ])->increment('hit');

        return $this;
    }

    /**
     * Get the successed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendSuccessedLoginResponse(Request $request)
    {
        return $this->userIsActive($request)
                ->updateStatisticLogin($request)
                ->sendLoginResponse($request);
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

        if ($this->attemptLogin($request)) {
            return $this->sendSuccessedLoginResponse($request);
        }

        if (User::where('nip', $request->username)->first()) {
            $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);
        }

        if ($this->attemptLoginMagma($request)) {
            return $this->sendSuccessedLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
