<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroundMovement extends Model
{
    use HasFactory;

    protected $appends = [
        'author_name'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getAuthorNameAttribute()
    {
        return $this->author->name;
    }
}
