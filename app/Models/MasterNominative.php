<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterNominative extends Model
{
    public $timestamps = false;
    protected $table = 'f_mn';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function spdStatus()
    {
        return $this->hasOne(NominativeStatus::class, 'id', 'id_ns');
    }
}
