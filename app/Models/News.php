<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
   protected $fillable = [
    'news_category_id',
    'title',
    'description',
    'status',
    'image'
];
    public function category()
{
    return $this->belongsTo(NewsCategory::class,'news_category_id');
}
}
