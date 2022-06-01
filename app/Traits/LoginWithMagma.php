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
     * Get user from MAGMA using token
     *
     * @return array
     */
    protected function getUserFromMagma(): array
    {
        return Http::magma()->withToken($this->response['token'])
            ->get('/v1/user/' . request()->username)
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
     * Login using MAGMA
     *
     * @param Request $request
     * @return boolean
     */
    public function attemptLoginMagma(Request $request): bool
    {
        $this->response = Http::magma()->post('/login', [
            'username' => request()->username,
            'password' => request()->password,
        ])->json();

        return $this->response['success'] ?
            $this->successedLoginMagma() : false;
    }

    /**
     * Login is success or not
     *
     * @return boolean
     */
    public function successedLoginMagma(): bool
    {
        Auth::login($this->saveToDatabase(
            $this->getUserFromMagma()
        ));

        return true;
    }
}
