<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $appends = ['news_categories', 'news_files'];
    protected function getNewsCategoriesAttribute()
    {
        return NewsPublishCategory::select('news_categories.id', 'news_categories.category')->join('news_categories', 'news_categories.id', '=', 'news_publish_categories.news_category_id')
                                    ->where('news_id', $this->attributes['id'])
                                    ->get();
    }

    protected function getNewsFilesAttribute()
    {
        return NewsFile::select('files.*')->join('files', 'files.id', '=', 'news_files.file_id')
                                    ->where('news_files.news_id', $this->attributes['id'])
                                    ->get();
    }
}
