<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use App\Models\RentalMobil;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PaketWisataController extends Controller
{
    public function index(Request $request)
    {
        $query = PaketWisata::aktif();

        if ($request->wilayah) $query->byWilayah($request->wilayah);
        if ($request->durasi) $query->byDurasi($request->durasi);
        if ($request->search) $query->where('nama_paket', 'like', "%{$request->search}%");

        $paketPopuler = PaketWisata::aktif()->populer()->latest()->take(4)->get();
        $semuaPaket = $query->paginate(9);
        $wilayahs = PaketWisata::aktif()->distinct()->pluck('wilayah');
        $durasiOptions = PaketWisata::aktif()->distinct()->pluck('durasi')->sort();

        return view('paket-wisata.index', compact('paketPopuler', 'semuaPaket', 'wilayahs', 'durasiOptions'));
    }

    public function show(PaketWisata $paketWisata)
    {
        $rekomendasiRental = RentalMobil::aktif()->terfavorit()->take(4)->get();
        $rekomendasiPaket = PaketWisata::aktif()->populer()->where('id', '!=', $paketWisata->id)->take(4)->get();
        $waNumber = Pengaturan::get('whatsapp_number', env('WHATSAPP_NUMBER'));

        return view('detail.paket-wisata', compact('paketWisata', 'rekomendasiRental', 'rekomendasiPaket', 'waNumber'));
    }
}
