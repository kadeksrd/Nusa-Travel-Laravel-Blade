@extends('layouts.app')
@section('title', $rentalMobil->nama_mobil)
@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Main Content --}}
        <div class="lg:col-span-2">
            <nav class="text-sm text-gray-500 mb-4 flex items-center gap-2">
                <a href="{{ route('home') }}" class="hover:text-primary-600">Beranda</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="{{ route('rental-mobil.index') }}" class="hover:text-primary-600">Rental Mobil</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-gray-800 font-medium">{{ $rentalMobil->nama_mobil }}</span>
            </nav>

            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $rentalMobil->nama_mobil }}</h1>
            <div class="flex items-center flex-wrap gap-4 mb-6">
                <div class="flex items-center gap-1 text-yellow-400">
                    @for($i=1; $i<=5; $i++)<i class="fas fa-star text-sm {{ $i <= $rentalMobil->rating ? '' : 'text-gray-300' }}"></i>@endfor
                    <span class="text-gray-600 text-sm ml-1">({{ $rentalMobil->jumlah_ulasan }} ulasan)</span>
                </div>
                <span class="bg-{{ $rentalMobil->jenis=='terfavorit' ? 'red' : ($rentalMobil->jenis=='besar' ? 'blue' : 'green') }}-100 text-{{ $rentalMobil->jenis=='terfavorit' ? 'red' : ($rentalMobil->jenis=='besar' ? 'blue' : 'green') }}-700 text-sm font-semibold px-3 py-1 rounded-full">
                    {{ ucfirst($rentalMobil->jenis) }}
                </span>
            </div>

            {{-- Main Image --}}
            <div class="rounded-2xl overflow-hidden mb-4 h-80 md:h-96">
                <img id="mainImgRental"
                    src="{{ $rentalMobil->gambar_utama ? asset('storage/'.$rentalMobil->gambar_utama) : 'https://picsum.photos/800/500?random='.$rentalMobil->id }}"
                    alt="{{ $rentalMobil->nama_mobil }}" class="w-full h-full object-cover">
            </div>

            {{-- Thumbnails --}}
            @if($rentalMobil->gambar_detail && count($rentalMobil->gambar_detail) > 0)
            <div class="grid grid-cols-4 gap-2 mb-8">
                <div class="rounded-xl overflow-hidden h-20 cursor-pointer" onclick="document.getElementById('mainImgRental').src='{{ asset('storage/'.$rentalMobil->gambar_utama) }}'">
                    <img src="{{ asset('storage/'.$rentalMobil->gambar_utama) }}" class="w-full h-full object-cover hover:opacity-80 transition">
                </div>
                @foreach(array_slice($rentalMobil->gambar_detail, 0, 3) as $img)
                <div class="rounded-xl overflow-hidden h-20 cursor-pointer" onclick="document.getElementById('mainImgRental').src='{{ asset('storage/'.$img) }}'">
                    <img src="{{ asset('storage/'.$img) }}" class="w-full h-full object-cover hover:opacity-80 transition">
                </div>
                @endforeach
            </div>
            @endif

            {{-- Fasilitas --}}
            @if($rentalMobil->fasilitas)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Fasilitas Kendaraan</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach($rentalMobil->fasilitas as $f)
                    <div class="bg-gray-50 rounded-xl p-4 text-center border border-gray-100">
                        <i class="{{ $f['icon'] ?? 'fas fa-check' }} text-primary-600 text-2xl mb-2"></i>
                        <p class="text-sm text-gray-700 font-medium">{{ $f['label'] ?? '-' }}</p>
                    </div>
                    @endforeach
                </div>
                {{-- Quick specs --}}
                <div class="grid grid-cols-3 gap-4 mt-4 bg-primary-50 rounded-xl p-5">
                    <div class="text-center">
                        <i class="fas fa-users text-primary-600 text-xl mb-1"></i>
                        <div class="text-sm font-bold text-gray-800">{{ $rentalMobil->kapasitas_penumpang }} Orang</div>
                        <div class="text-xs text-gray-500">Kapasitas</div>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-cog text-primary-600 text-xl mb-1"></i>
                        <div class="text-sm font-bold text-gray-800">{{ ucfirst($rentalMobil->transmisi) }}</div>
                        <div class="text-xs text-gray-500">Transmisi</div>
                    </div>
                    @if($rentalMobil->cc_mesin)
                    <div class="text-center">
                        <i class="fas fa-tachometer-alt text-primary-600 text-xl mb-1"></i>
                        <div class="text-sm font-bold text-gray-800">{{ $rentalMobil->cc_mesin }}</div>
                        <div class="text-xs text-gray-500">CC Mesin</div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            {{-- Detail Rental --}}
            @if($rentalMobil->detail_rental)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Detail Rental</h2>
                <div class="prose max-w-none text-gray-600 bg-gray-50 rounded-2xl p-6">
                    {!! $rentalMobil->detail_rental !!}
                </div>
            </div>
            @endif

            {{-- Rekomendasi Rental Lain --}}
            @if($rekomendasiRental->isNotEmpty())
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Mobil Lainnya</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($rekomendasiRental as $r)
                    <a href="{{ route('rental-mobil.show', $r->slug) }}" class="bg-white rounded-xl overflow-hidden card-hover border border-gray-100 block">
                        <div class="h-28 overflow-hidden">
                            <img src="{{ $r->gambar_utama ? asset('storage/'.$r->gambar_utama) : 'https://picsum.photos/200/150?random='.$r->id }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-3">
                            <h4 class="font-semibold text-xs text-gray-800">{{ $r->nama_mobil }}</h4>
                            <p class="text-primary-600 text-xs font-bold mt-1">Rp {{ number_format($r->harga_per_hari, 0, ',', '.') }}/hari</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Rekomendasi Paket Populer --}}
            @if($rekomendasiPaket->isNotEmpty())
            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-4">Paket Wisata Populer</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($rekomendasiPaket as $pk)
                    <a href="{{ route('paket-wisata.show', $pk->slug) }}" class="bg-white rounded-xl overflow-hidden card-hover border border-gray-100 block">
                        <div class="h-28 overflow-hidden">
                            <img src="{{ $pk->gambar_utama ? asset('storage/'.$pk->gambar_utama) : 'https://picsum.photos/200/150?random='.$pk->id }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-3">
                            <h4 class="font-semibold text-xs text-gray-800 line-clamp-1">{{ $pk->nama_paket }}</h4>
                            <p class="text-primary-600 text-xs font-bold mt-1">Rp {{ number_format($pk->harga, 0, ',', '.') }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        {{-- Sidebar Form Order --}}
        <div class="lg:col-span-1">
            <div class="sticky top-24">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-primary-600 text-white p-5">
                        <div class="text-sm text-blue-200 mb-1">Harga sewa per hari</div>
                        <div class="text-3xl font-bold">Rp {{ number_format($rentalMobil->harga_per_hari, 0, ',', '.') }}</div>
                        <div class="text-blue-200 text-sm">Belum termasuk bensin & driver (opsional)</div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-gray-800 mb-4">Form Pemesanan</h3>
                        <form action="{{ route('pesan') }}" method="POST" class="space-y-3">
                            @csrf
                            <input type="hidden" name="tipe" value="rental">
                            <input type="hidden" name="paket_id" value="{{ $rentalMobil->id }}">

                            <div>
                                <label class="text-xs font-semibold text-gray-500 mb-1 block">Nama Lengkap *</label>
                                <input type="text" name="nama" required class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 outline-none" placeholder="Nama Anda">
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 mb-1 block">No. WhatsApp *</label>
                                <input type="text" name="no_hp" required class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 outline-none">
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 mb-1 block">Email *</label>
                                <input type="email" name="email" required class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 outline-none">
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 mb-1 block">Tanggal Mulai *</label>
                                <input type="date" name="tanggal_berangkat" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 outline-none">
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 mb-1 block">Durasi (Hari) *</label>
                                <input type="number" name="jumlah_orang" min="1" value="1" required class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 outline-none">
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500 mb-1 block">Catatan</label>
                                <textarea name="catatan" rows="2" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 outline-none resize-none" placeholder="Butuh driver? Tujuan?"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3.5 rounded-xl transition flex items-center justify-center gap-2">
                                <i class="fab fa-whatsapp text-lg"></i> Pesan via WhatsApp
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
