<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $appends = ['news_categories'];
    protected function getNewsCategoriesAttribute()
    {
        return NewsPublishCategory::select('news_categories.id', 'news_categories.category')->join('news_categories', 'news_categories.id', '=', 'news_publish_categories.news_category_id')
                                    ->where('news_id', $this->attributes['id'])
                                    ->get();
    }
}
