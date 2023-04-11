<?php

namespace App\Models;

use App\Models\Statistic\StatisticLogin;
use App\Traits\GenerateUUID;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Itstructure\LaRbac\Interfaces\RbacUserInterface;
use Itstructure\LaRbac\Traits\Administrable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements RbacUserInterface
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use GenerateUUID;
    use Notifiable;
    use Administrable;

    protected $fillable = [
        'name', 'email', 'password', 'roles'
    ];

    protected $table = 'a_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'uuid',
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
        if(Hash::needsRehash($password) ) {
            $password = Hash::make($password);
        }
        $this->attributes['password'] = $password;
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

    public function getAvatar()
    {
        $defaultAvatarPlaceholder = 'https://via.placeholder.com/500';
        return $this->attributes['avatar'] == null || '' ?
            $defaultAvatarPlaceholder :
            config('sipeg.photo_url') . $this->attributes['avatar'];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }
}
