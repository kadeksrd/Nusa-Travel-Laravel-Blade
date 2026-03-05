<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = ['judul', 'slug', 'gambar', 'konten', 'ringkasan', 'is_published', 'published_at'];
    protected $casts = ['is_published' => 'boolean', 'published_at' => 'datetime'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });
    }

    public function getRouteKeyName() { return 'slug'; }
    public function scopePublished($query) { return $query->where('is_published', true); }
}
