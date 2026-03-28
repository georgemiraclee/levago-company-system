<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'client_name',
        'category', 'tech_stack', 'images', 'url', 'status'
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'images'     => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }
}