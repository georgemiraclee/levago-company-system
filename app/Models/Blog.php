<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'excerpt', 'thumbnail',
        'category', 'tags', 'seo_title', 'seo_description',
        'status', 'published_at', 'user_id'
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
    ];

    public function author() { return $this->belongsTo(User::class, 'user_id'); }
}