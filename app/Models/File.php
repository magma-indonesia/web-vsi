<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $casts = [
        'is_tmp' => 'boolean',
    ];

    protected $appends = [
        'url',
        'tags_name',
    ];

    public function url()
    {
        return route('files.download', [
            'id'    => $this->id,
            'name'  => $this->name
        ]);
    }

    public function getUrlAttribute()
    {
        return $this->url();
    }

    public function getTagsNameAttribute()
    {
        $tags = $this->tags;
        return $tags->count() > 0 ? implode(', ', $tags->pluck('name')->toArray()) : '';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'file_tags', 'file_id', 'tag_id');
    }
}
