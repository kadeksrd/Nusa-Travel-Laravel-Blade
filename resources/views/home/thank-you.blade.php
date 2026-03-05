@extends('layouts.app')
@section('title', 'Terima Kasih')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50 flex items-center justify-center py-16">
    <div class="max-w-lg w-full mx-4">
        <div class="bg-white rounded-3xl shadow-xl p-10 text-center">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check-circle text-green-500 text-4xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Pemesanan Berhasil!</h1>
            @if($pemesanan)
                <p class="text-gray-500 mb-6">Kode Booking Anda: <span class="font-bold text-primary-600 text-lg">{{ $pemesanan->kode_booking }}</span></p>
                <div class="bg-gray-50 rounded-xl p-4 text-left mb-6 text-sm text-gray-600 space-y-2">
                    <div class="flex justify-between"><span>Nama</span><span class="font-semibold">{{ $pemesanan->nama_pemesan }}</span></div>
                    <div class="flex justify-between"><span>Tanggal</span><span class="font-semibold">{{ $pemesanan->tanggal_berangkat->format('d M Y') }}</span></div>
                    <div class="flex justify-between"><span>Jumlah Orang</span><span class="font-semibold">{{ $pemesanan->jumlah_orang }}</span></div>
                    <div class="flex justify-between"><span>Status</span><span class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full text-xs font-semibold">Pending</span></div>
                </div>
            @endif
            @if($waUrl)
            <a href="{{ $waUrl }}" target="_blank" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-8 rounded-xl transition text-lg flex items-center justify-center gap-2 mb-4">
                <i class="fab fa-whatsapp text-xl"></i> Konfirmasi via WhatsApp
            </a>
            @endif
            <a href="{{ route('home') }}" class="text-primary-600 hover:text-primary-700 font-medium text-sm">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda
            </a>
            @auth
            <div class="mt-4">
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 font-medium text-sm">
                    <i class="fas fa-user mr-1"></i> Lihat di Dashboard
                </a>
            </div>
            @endauth
        </div>
    </div>
</div>
@endsection
