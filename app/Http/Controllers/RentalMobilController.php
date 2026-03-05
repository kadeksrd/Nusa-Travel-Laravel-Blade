<?php

namespace App\Http\Controllers;

use App\Models\RentalMobil;
use App\Models\PaketWisata;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class RentalMobilController extends Controller
{
    public function index(Request $request)
    {
        $query = RentalMobil::aktif();
        if ($request->transmisi) $query->byTransmisi($request->transmisi);
        if ($request->search) $query->where('nama_mobil', 'like', "%{$request->search}%");

        $terfavorit = RentalMobil::aktif()->terfavorit()->get();
        $besar = RentalMobil::aktif()->besar()->get();
        $sendiri = RentalMobil::aktif()->sendiri()->paginate(9);

        return view('rental-mobil.index', compact('terfavorit', 'besar', 'sendiri'));
    }

    public function show(RentalMobil $rentalMobil)
    {
        $rekomendasiRental = RentalMobil::aktif()->where('id', '!=', $rentalMobil->id)->take(4)->get();
        $rekomendasiPaket = PaketWisata::aktif()->populer()->take(4)->get();
        $waNumber = Pengaturan::get('whatsapp_number', env('WHATSAPP_NUMBER'));

        return view('detail.rental-mobil', compact('rentalMobil', 'rekomendasiRental', 'rekomendasiPaket', 'waNumber'));
    }
}
