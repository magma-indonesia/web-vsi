<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

trait LoginWithMagma
{
    /**
     * URL for MAGMA API
     *
     * @var string
     */
    protected string $magmaApiUrl = 'https://magma.esdm.go.id/api';

    /**
     * MAGMA API url
     *
     * @return string
     */
    protected function magmaApiUrl(): string
    {
        if (config()->has('magma.api_url')) {
            return config('magma.api_url');
        }

        return $this->magmaApiUrl;
    }

    /**
     * MAGMA Login API url
     *
     * @return string
     */
    protected function magmaLoginApiUrl(): string
    {
        return $this->magmaApiUrl().'/login';
    }

    /**
     * MAGMA User API url
     *
     * @return string
     */
    protected function magmaUserApiUrl(): string
    {
        return $this->magmaApiUrl() . '/v1/user/' . request()->username;
    }

    /**
     * Get the failed getting user informaation response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedUserResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }

    /**
     * Get user from MAGMA using token
     *
     * @param Request $request
     * @return array
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function getUserFromMagma(Request $request, string $token): array
    {
        $response = Http::magma()->withToken($token)
            ->get($this->magmaUserApiUrl())
            ->json();

        if (array_key_exists('data', $response)) {
            return $response['data'];
        }

        $this->sendFailedUserResponse($request);
    }

    /**
     * Get or save new user
     *
     * @param array $user
     * @return App\Models\User
     */
    protected function saveToDatabase(array $user): User
    {
        return User::firstOrCreate(
            [
                'nip' => $user['nip'],
            ],[
                'uuid' => Str::uuid(),
                'name' => $user['name'],
                'password' => request()->password,
                'is_active' => 1,
            ]);
    }

    /**
     *  Login is success or not
     *
     * @param array $user
     * @return boolean
     */
    protected function successedLoginMagma(array $user): bool
    {
        Auth::login($this->saveToDatabase($user));

        return true;
    }

    /**
     * Login using MAGMA
     *
     * @param Request $request
     * @return boolean
     */
    public function attemptLoginMagma(Request $request): bool
    {
        $response = Http::magma()->post($this->magmaLoginApiUrl(), [
            'username' => $request->username,
            'password' => $request->password,
        ])->json();

        return $response['success'] ?
            $this->successedLoginMagma($response['user']) : false;
    }
}
