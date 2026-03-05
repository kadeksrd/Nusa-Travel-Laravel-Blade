<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class RentalMobil extends Model
{
    use HasFactory;

    protected $table = 'rental_mobils';

    protected $fillable = [
        'nama_mobil', 'slug', 'jenis', 'transmisi',
        'kapasitas_penumpang', 'cc_mesin', 'harga_per_hari',
        'gambar_utama', 'gambar_detail', 'fasilitas',
        'detail_rental', 'rating', 'jumlah_ulasan',
        'is_populer', 'is_aktif',
    ];

    protected $casts = [
        'gambar_detail' => 'array',
        'fasilitas' => 'array',
        'is_populer' => 'boolean',
        'is_aktif' => 'boolean',
        'harga_per_hari' => 'decimal:2',
        'rating' => 'decimal:1',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama_mobil);
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

    public function scopeByTransmisi($query, $transmisi)
    {
        return $query->where(function ($q) use ($transmisi) {
            $q->where('transmisi', $transmisi)->orWhere('transmisi', 'both');
        });
    }

    public function scopeTerfavorit($query)
    {
        return $query->where('jenis', 'terfavorit');
    }

    public function scopeBesar($query)
    {
        return $query->where('jenis', 'besar');
    }

    public function scopeSendiri($query)
    {
        return $query->where('jenis', 'sendiri');
    }

    public function pemesanans()
    {
        return $this->morphMany(Pemesanan::class, 'paket');
    }
}
