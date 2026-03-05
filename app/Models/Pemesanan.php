<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pemesanan extends Model
{
    protected $table = 'pemesanans';

    protected $fillable = [
        'user_id', 'nama_pemesan', 'email_pemesan', 'no_hp',
        'tipe', 'paket_type', 'paket_id', 'tanggal_berangkat',
        'jumlah_orang', 'catatan', 'status', 'kode_booking',
    ];

    protected $casts = [
        'tanggal_berangkat' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->kode_booking = 'TRV-' . strtoupper(Str::random(8));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->morphTo();
    }

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class);
    }

    public function generateWhatsappMessage(): string
    {
        $tipeLabel = $this->tipe === 'wisata' ? 'Paket Wisata' : 'Rental Mobil';
        $paketNama = $this->paket ? ($this->tipe === 'wisata' ? $this->paket->nama_paket : $this->paket->nama_mobil) : '-';

        return urlencode(
            "Halo, saya ingin memesan:\n" .
            "Tipe: {$tipeLabel}\n" .
            "Paket: {$paketNama}\n" .
            "Nama: {$this->nama_pemesan}\n" .
            "Tanggal: {$this->tanggal_berangkat->format('d M Y')}\n" .
            "Jumlah Orang: {$this->jumlah_orang}\n" .
            ($this->catatan ? "Catatan: {$this->catatan}\n" : '') .
            "Kode Booking: {$this->kode_booking}"
        );
    }
}
