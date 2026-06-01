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

    public function setTechStackAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['tech_stack'] = json_encode($value);
        } elseif (is_string($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                $this->attributes['tech_stack'] = json_encode($decoded);
            } else {
                $decoded2 = json_decode($decoded, true);
                $this->attributes['tech_stack'] = json_encode(is_array($decoded2) ? $decoded2 : [$decoded ?? $value]);
            }
        } else {
            $this->attributes['tech_stack'] = json_encode([]);
        }
    }

    public function setImagesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['images'] = json_encode($value);
        } elseif (is_string($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                $this->attributes['images'] = json_encode($decoded);
            } else {
                $decoded2 = json_decode($decoded, true);
                $this->attributes['images'] = json_encode(is_array($decoded2) ? $decoded2 : [$decoded ?? $value]);
            }
        } else {
            $this->attributes['images'] = json_encode([]);
        }
    }

    public function getTechStackAttribute($value)
    {
        if (is_array($value)) return $value;
        $decoded = json_decode($value, true);
        if (is_array($decoded)) return $decoded;
        $decoded2 = json_decode($decoded, true);
        return is_array($decoded2) ? $decoded2 : [];
    }

    public function getImagesAttribute($value)
    {
        if (is_array($value)) return $value;
        $decoded = json_decode($value, true);
        if (is_array($decoded)) return $decoded;
        $decoded2 = json_decode($decoded, true);
        return is_array($decoded2) ? $decoded2 : [];
    }
}