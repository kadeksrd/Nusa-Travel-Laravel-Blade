@extends('layouts.app')
@section('title', 'Paket Wisata')
@section('content')

{{-- Hero Banner --}}
<div class="bg-wisata text-white py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold mb-3">Paket Wisata</h1>
        <p class="text-blue-100 text-lg">Temukan destinasi wisata impian Anda bersama kami</p>
    </div>
</div>

{{-- Filter --}}
<div class="bg-white border-b sticky top-20 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form method="GET" action="{{ route('paket-wisata.index') }}" class="flex flex-wrap gap-3 items-center">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari paket wisata..."
                class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 outline-none min-w-48">
            <select name="wilayah" class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 outline-none">
                <option value="">Semua Wilayah</option>
                @foreach($wilayahs as $w)
                    <option value="{{ $w }}" {{ request('wilayah')==$w?'selected':'' }}>{{ $w }}</option>
                @endforeach
            </select>
            <select name="durasi" class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 outline-none">
                <option value="">Semua Durasi</option>
                @foreach($durasiOptions as $d)
                    <option value="{{ $d }}" {{ request('durasi')==$d?'selected':'' }}>{{ $d }} Hari</option>
                @endforeach
            </select>
            <button type="submit" class="bg-primary-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-primary-700 transition">
                <i class="fas fa-search mr-1"></i> Filter
            </button>
            @if(request()->hasAny(['search','wilayah','durasi']))
            <a href="{{ route('paket-wisata.index') }}" class="text-gray-500 text-sm hover:text-gray-700">
                <i class="fas fa-times mr-1"></i> Reset
            </a>
            @endif
        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Paket Populer --}}
    @if($paketPopuler->isNotEmpty() && !request()->hasAny(['search','wilayah','durasi']))
    <div class="mb-14">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fas fa-fire-alt text-orange-500"></i> Paket Wisata Populer
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($paketPopuler as $paket)
            <a href="{{ route('paket-wisata.show', $paket->slug) }}" class="bg-white rounded-2xl overflow-hidden shadow-sm card-hover block border border-gray-100">
                <div class="relative h-44 overflow-hidden">
                    <img src="{{ $paket->gambar_utama ? asset('storage/'.$paket->gambar_utama) : 'https://picsum.photos/400/300?random='.$paket->id }}"
                         alt="{{ $paket->nama_paket }}" class="w-full h-full object-cover">
                    <div class="absolute top-2 left-2 flex gap-1.5">
                        <span class="bg-primary-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full">{{ $paket->durasi }}H</span>
                        <span class="bg-orange-400 text-white text-xs font-semibold px-2.5 py-1 rounded-full"><i class="fas fa-fire-alt mr-0.5"></i> Populer</span>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-800 mb-1 text-sm">{{ $paket->nama_paket }}</h3>
                    <p class="text-gray-400 text-xs mb-2"><i class="fas fa-map-marker-alt text-red-400 mr-1"></i>{{ $paket->wilayah }}</p>
                    <div class="text-primary-600 font-bold text-sm">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Semua Paket --}}
    <div>
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Semua Paket Wisata
            @if($semuaPaket->total() > 0)
            <span class="text-sm font-normal text-gray-400 ml-2">({{ $semuaPaket->total() }} paket)</span>
            @endif
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($semuaPaket as $paket)
            <a href="{{ route('paket-wisata.show', $paket->slug) }}" class="bg-white rounded-2xl overflow-hidden shadow-sm card-hover block border border-gray-100">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ $paket->gambar_utama ? asset('storage/'.$paket->gambar_utama) : 'https://picsum.photos/400/300?random='.$paket->id }}"
                         alt="{{ $paket->nama_paket }}" class="w-full h-full object-cover transition duration-300 hover:scale-110">
                    <div class="absolute top-3 left-3">
                        <span class="bg-primary-600 text-white text-xs font-semibold px-3 py-1 rounded-full">{{ $paket->durasi }} Hari</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex items-center gap-1 text-yellow-400 text-xs mb-1.5">
                        @for($i=1; $i<=5; $i++)<i class="fas fa-star {{ $i <= $paket->rating ? '' : 'text-gray-200' }}"></i>@endfor
                        <span class="text-gray-400 ml-1">({{ $paket->jumlah_ulasan }})</span>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-1 text-lg">{{ $paket->nama_paket }}</h3>
                    <p class="text-gray-400 text-sm mb-3"><i class="fas fa-map-marker-alt text-red-400 mr-1"></i>{{ $paket->wilayah }}</p>
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                        <div>
                            <div class="text-xs text-gray-400">Mulai dari</div>
                            <div class="text-primary-600 font-bold text-lg">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                        </div>
                        <span class="text-primary-600 hover:text-primary-700 text-sm font-semibold flex items-center gap-1">
                            Detail <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-16 text-gray-400">
                <i class="fas fa-search text-5xl mb-4"></i>
                <p class="text-lg">Tidak ada paket ditemukan</p>
                <a href="{{ route('paket-wisata.index') }}" class="text-primary-600 text-sm mt-2 block">Reset pencarian</a>
            </div>
            @endforelse
        </div>

        <div class="mt-8">{{ $semuaPaket->links() }}</div>
    </div>
</div>

{{-- CTA Section --}}
@include('components.cta-form')

@endsection
