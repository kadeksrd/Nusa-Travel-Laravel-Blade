@extends('layouts.app')
@section('title', 'Rental Mobil')
@section('content')

<div class="bg-rental text-white py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold mb-3">Rental Mobil</h1>
        <p class="text-blue-100 text-lg">Armada lengkap untuk perjalanan nyaman dan aman</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Filter Bar --}}
    <form method="GET" action="{{ route('rental-mobil.index') }}" class="flex flex-wrap gap-3 mb-10 bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mobil..."
            class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 outline-none flex-1 min-w-48">
        <select name="transmisi" class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 outline-none">
            <option value="">Semua Transmisi</option>
            <option value="manual" {{ request('transmisi')=='manual'?'selected':'' }}>Manual</option>
            <option value="automatic" {{ request('transmisi')=='automatic'?'selected':'' }}>Automatic</option>
        </select>
        <button type="submit" class="bg-primary-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-primary-700 transition">
            <i class="fas fa-search mr-1"></i> Filter
        </button>
    </form>

    {{-- Terfavorit --}}
    @if($terfavorit->isNotEmpty())
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fas fa-heart text-red-500"></i> Rental Mobil Terfavorit
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            @foreach($terfavorit as $mobil)
            <a href="{{ route('rental-mobil.show', $mobil->slug) }}" class="bg-white rounded-2xl overflow-hidden card-hover border border-gray-100 block shadow-sm">
                <div class="h-44 overflow-hidden">
                    <img src="{{ $mobil->gambar_utama ? asset('storage/'.$mobil->gambar_utama) : 'https://picsum.photos/300/200?random='.$mobil->id }}"
                         alt="{{ $mobil->nama_mobil }}" class="w-full h-full object-cover transition duration-300 hover:scale-110">
                </div>
                <div class="p-4">
                    <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-semibold mb-2 inline-block">Terfavorit</span>
                    <h3 class="font-bold text-gray-800 mb-1">{{ $mobil->nama_mobil }}</h3>
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                        <span><i class="fas fa-users mr-1"></i>{{ $mobil->kapasitas_penumpang }} org</span>
                        <span><i class="fas fa-cog mr-1"></i>{{ ucfirst($mobil->transmisi) }}</span>
                    </div>
                    <div class="text-primary-600 font-bold">Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}<span class="text-xs text-gray-400">/hari</span></div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Mobil Besar --}}
    @if($besar->isNotEmpty())
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fas fa-bus text-blue-500"></i> Rental Mobil Besar
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            @foreach($besar as $mobil)
            <a href="{{ route('rental-mobil.show', $mobil->slug) }}" class="bg-white rounded-2xl overflow-hidden card-hover border border-gray-100 block shadow-sm">
                <div class="h-44 overflow-hidden">
                    <img src="{{ $mobil->gambar_utama ? asset('storage/'.$mobil->gambar_utama) : 'https://picsum.photos/300/200?random='.$mobil->id }}"
                         alt="{{ $mobil->nama_mobil }}" class="w-full h-full object-cover transition duration-300 hover:scale-110">
                </div>
                <div class="p-4">
                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full font-semibold mb-2 inline-block">Mobil Besar</span>
                    <h3 class="font-bold text-gray-800 mb-1">{{ $mobil->nama_mobil }}</h3>
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                        <span><i class="fas fa-users mr-1"></i>{{ $mobil->kapasitas_penumpang }} org</span>
                        <span><i class="fas fa-cog mr-1"></i>{{ ucfirst($mobil->transmisi) }}</span>
                    </div>
                    <div class="text-primary-600 font-bold">Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}<span class="text-xs text-gray-400">/hari</span></div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Sendiri / Self Drive --}}
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fas fa-car text-green-500"></i> Rental Mobil Sendiri
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            @forelse($sendiri as $mobil)
            <a href="{{ route('rental-mobil.show', $mobil->slug) }}" class="bg-white rounded-2xl overflow-hidden card-hover border border-gray-100 block shadow-sm">
                <div class="h-44 overflow-hidden">
                    <img src="{{ $mobil->gambar_utama ? asset('storage/'.$mobil->gambar_utama) : 'https://picsum.photos/300/200?random='.$mobil->id }}"
                         alt="{{ $mobil->nama_mobil }}" class="w-full h-full object-cover transition duration-300 hover:scale-110">
                </div>
                <div class="p-4">
                    <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full font-semibold mb-2 inline-block">Self Drive</span>
                    <h3 class="font-bold text-gray-800 mb-1">{{ $mobil->nama_mobil }}</h3>
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                        <span><i class="fas fa-users mr-1"></i>{{ $mobil->kapasitas_penumpang }} org</span>
                        <span><i class="fas fa-cog mr-1"></i>{{ ucfirst($mobil->transmisi) }}</span>
                    </div>
                    <div class="text-primary-600 font-bold">Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}<span class="text-xs text-gray-400">/hari</span></div>
                </div>
            </a>
            @empty
            <div class="col-span-4 text-center py-10 text-gray-400">
                <i class="fas fa-car text-4xl mb-3"></i>
                <p>Belum ada data rental mobil</p>
            </div>
            @endforelse
        </div>
        <div class="mt-6">{{ $sendiri->links() }}</div>
    </div>
</div>

@include('components.cta-form')
@endsection
