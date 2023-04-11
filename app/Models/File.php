<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public function url()
    {
        return route('files.download', [
            'id'    => $this->id,
            'name'  => $this->name
        ]);
    }
}
