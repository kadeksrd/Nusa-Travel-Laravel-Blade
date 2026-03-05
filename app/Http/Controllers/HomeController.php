<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use App\Models\RentalMobil;
use App\Models\Testimonial;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $paketPopuler = PaketWisata::aktif()->populer()->latest()->take(6)->get();
        $testimonials = Testimonial::aktif()->latest()->take(6)->get();
        $paketTerbaru = PaketWisata::aktif()->latest()->take(6)->get();
        $rentalTerbaru = RentalMobil::aktif()->latest()->take(4)->get();

        // Wilayah unik untuk filter
        $wilayahs = PaketWisata::aktif()->distinct()->pluck('wilayah');
        $durasiOptions = PaketWisata::aktif()->distinct()->pluck('durasi')->sort();
        $mobilOptions = RentalMobil::aktif()->distinct()->pluck('nama_mobil');
        $transmisiOptions = ['manual', 'automatic'];

        return view('home.index', compact(
            'paketPopuler', 'testimonials', 'paketTerbaru',
            'rentalTerbaru', 'wilayahs', 'durasiOptions',
            'mobilOptions', 'transmisiOptions'
        ));
    }

    public function search(Request $request)
    {
        $tipe = $request->tipe;

        if ($tipe === 'wisata') {
            $query = PaketWisata::aktif();
            if ($request->wilayah) $query->byWilayah($request->wilayah);
            if ($request->durasi) $query->byDurasi($request->durasi);
            $results = $query->get();
        } else {
            $query = RentalMobil::aktif();
            if ($request->mobil) $query->where('nama_mobil', 'like', "%{$request->mobil}%");
            if ($request->transmisi) $query->byTransmisi($request->transmisi);
            $results = $query->get();
        }

        return response()->json($results);
    }

    public function pesan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
            'tipe' => 'required|in:wisata,rental',
            'paket_id' => 'nullable|integer',
            'tanggal_berangkat' => 'required|date|after:today',
            'jumlah_orang' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ]);

        $pemesanan = Pemesanan::create([
            'user_id' => auth()->id(),
            'nama_pemesan' => $request->nama,
            'email_pemesan' => $request->email,
            'no_hp' => $request->no_hp,
            'tipe' => $request->tipe,
            'paket_type' => $request->tipe === 'wisata' ? PaketWisata::class : RentalMobil::class,
            'paket_id' => $request->paket_id,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'jumlah_orang' => $request->jumlah_orang,
            'catatan' => $request->catatan,
        ]);

        $waNumber = \App\Models\Pengaturan::get('whatsapp_number', env('WHATSAPP_NUMBER'));
        $waMessage = $pemesanan->generateWhatsappMessage();
        $waUrl = "https://wa.me/{$waNumber}?text={$waMessage}";

        return redirect()->route('thank-you', ['kode' => $pemesanan->kode_booking])
            ->with('wa_url', $waUrl);
    }

    public function thankYou(Request $request)
    {
        $kode = $request->kode;
        $pemesanan = Pemesanan::where('kode_booking', $kode)->first();
        $waUrl = session('wa_url');

        return view('home.thank-you', compact('pemesanan', 'waUrl'));
    }
}
