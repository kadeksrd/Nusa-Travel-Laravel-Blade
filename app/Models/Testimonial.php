<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['nama', 'foto', 'rating', 'komentar', 'is_aktif'];
    protected $casts = ['is_aktif' => 'boolean'];
    public function scopeAktif($q) { return $q->where('is_aktif', true); }
}
