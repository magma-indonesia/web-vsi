<?php

namespace App\Models\Statistic;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class StatisticLogin extends Model
{
    protected $fillable = [
        'user_id',
        'ip_address',
    ];

    /**
     * Get User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
