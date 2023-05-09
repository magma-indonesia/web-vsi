<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolcanoBase extends Model
{
    use HasFactory;
    protected $appends = ['files'];
    protected function getFilesAttribute()
    {
        return VolcanoBaseFile::select('files.*')->join('files', 'files.id', '=', 'volcano_base_files.file_id')
                                    ->where('volcano_base_files.volcano_base_id', $this->attributes['id'])
                                    ->get();
    }
}
