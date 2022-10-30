<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

trait LoginWithMagma
{
    /**
     * Token MAGMA
     *
     * @var string|null
     */
    protected ?string $tokenUser = null;

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
                'name' => $user['name'],
                'password' => request()->password,
                'is_active' => 1,
            ]);
    }

    /**
     *  Login is success or not
     *
     * @param array $response
     * @return boolean
     */
    protected function successedLoginMagma(array $response): bool
    {
        Auth::login($this->saveToDatabase($response['user']));
        $this->tokenUser = $response['token'];

        return true;
    }

    /**
     * Get response after login
     *
     * @param Request $request
     * @return mixed
     */
    protected function responseLoginMagma(Request $request): mixed
    {
        return Http::magma()->post($this->magmaLoginApiUrl(), [
            'username' => $request->username,
            'password' => $request->password,
        ])->json();
    }

    /**
     * Get MAGMA User token
     *
     * @param Request $request
     * @return string|null
     */
    protected function tokenUser(Request $request): ?string
    {
        $response = $this->responseLoginMagma($request);

        return $this->tokenUser = $response['success'] ? $response['token'] : null;
    }

    /**
     * Login using MAGMA
     *
     * @param Request $request
     * @return boolean
     */
    public function attemptLoginMagma(Request $request): bool
    {
        $response = $this->responseLoginMagma($request);

        return $response['success'] && $this->successedLoginMagma($response);
    }
}
