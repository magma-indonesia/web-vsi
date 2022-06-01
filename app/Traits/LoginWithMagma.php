<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

trait LoginWithMagma
{
    /**
     * Login is successed
     *
     * @var boolean
     */
    protected bool $success = false;

    /**
     * Response from MAGMA after successfull login
     *
     * @var array
     */
    protected array $response;

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
     * Get user from MAGMA using token
     *
     * @return array
     */
    protected function getUserFromMagma(): array
    {
        return Http::magma()->withToken($this->response['token'])
            ->get($this->magmaUserApiUrl())
            ->json()['data'];
    }

    /**
     * Get or save new user
     *
     * @param array $user
     * @return User
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
     * Login is success or not
     *
     * @return boolean
     */
    protected function successedLoginMagma(): bool
    {
        Auth::login($this->saveToDatabase(
            $this->getUserFromMagma()
        ));

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
        $this->response = Http::magma()->post($this->magmaLoginApiUrl(), [
            'username' => $request->username,
            'password' => $request->password,
        ])->json();

        return $this->response['success'] ?
            $this->successedLoginMagma() : false;
    }
}
