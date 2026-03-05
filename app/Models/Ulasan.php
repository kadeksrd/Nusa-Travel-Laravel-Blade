<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasans';
    protected $fillable = ['user_id', 'pemesanan_id', 'rating', 'komentar', 'is_approved'];
    protected $casts = ['is_approved' => 'boolean'];

    public function user() { return $this->belongsTo(User::class); }
    public function pemesanan() { return $this->belongsTo(Pemesanan::class); }
}
