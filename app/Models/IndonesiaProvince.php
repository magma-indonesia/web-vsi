<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndonesiaProvince extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'pmbgi';
    protected $primaryKey = null;
}

