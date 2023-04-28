<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroundMovement extends Model
{
    use HasFactory;

    protected $appends = [
        'author'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getAuthorAttribute()
    {
        return $this->user->name;
    }
}
