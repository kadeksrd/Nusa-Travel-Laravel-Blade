<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   

    public function index()
    {
        $user = auth()->user();
        // Mengambil data sesuai Flow Dashboard User kamu
        $pemesanans = Pemesanan::where('user_id', $user->id)->latest()->get();

        return view('dashboard.user', compact('user', 'pemesanans'));
    }

   public function tulisUlasan(Request $request, Pemesanan $pemesanan)
    {
        // Proteksi agar user tidak mengulas orderan orang lain
        abort_if($pemesanan->user_id !== auth()->id(), 403);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|min:10',
        ]);

        Ulasan::updateOrCreate(
            ['pemesanan_id' => $pemesanan->id],
            [
                'user_id' => auth()->id(),
                'rating' => $request->rating,
                'komentar' => $request->komentar,
            ]
        );

        return back()->with('success', 'Ulasan berhasil dikirim!');
    }
}
