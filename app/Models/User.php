<?php

namespace App\Models;

use App\Models\Statistic\StatisticLogin;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $table = 'a_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Set password encrypting
     *
     * @param string $password
     * @return void
     */
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Mencari user yang aktif
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeActive(Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('is_active', '1');
    }

    /**
     * Mendapatkan relasi data statistik login user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function loginStatistic(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(StatisticLogin::class);
    }
}
