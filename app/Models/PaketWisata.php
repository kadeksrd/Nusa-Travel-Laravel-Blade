<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class PaketWisata extends Model
{
    use HasFactory;

    protected $table = 'paket_wisatas';

    protected $fillable = [
        'nama_paket', 'slug', 'wilayah', 'durasi', 'harga',
        'gambar_utama', 'gambar_detail', 'fasilitas',
        'rencana_perjalanan', 'deskripsi', 'rating',
        'jumlah_ulasan', 'is_populer', 'is_aktif',
    ];

    protected $casts = [
        'gambar_detail' => 'array',
        'fasilitas' => 'array',
        'is_populer' => 'boolean',
        'is_aktif' => 'boolean',
        'harga' => 'decimal:2',
        'rating' => 'decimal:1',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama_paket);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }

    public function scopePopuler($query)
    {
        return $query->where('is_populer', true);
    }

    public function scopeByWilayah($query, $wilayah)
    {
        return $query->where('wilayah', 'like', "%{$wilayah}%");
    }

    public function scopeByDurasi($query, $durasi)
    {
        return $query->where('durasi', $durasi);
    }

    public function pemesanans()
    {
        return $this->morphMany(Pemesanan::class, 'paket');
    }
}
