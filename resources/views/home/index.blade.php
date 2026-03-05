@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<style>
    [x-cloak] { display: none !important; }
</style>
{{-- HERO SECTION --}}
<section class="relative  py-48 flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1600&q=80" 
             alt="Bali Background" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-transparent"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="text-center mb-12">
            <span class="inline-block bg-yellow-400 text-yellow-900 text-xs font-black px-4 py-1.5 rounded-full uppercase tracking-widest mb-4 shadow-lg">
                ✈️ Jelajahi Surga Nusantara
            </span>
            <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 leading-tight drop-shadow-2xl">
                Jelajahi Keindahan <br>
                <span class="text-yellow-300">Nusantara</span> Bersama Kami
            </h1>
            <p class="text-white/90 text-xl max-w-2xl mx-auto mb-10 font-medium drop-shadow-md">
                Paket wisata eksklusif dan rental mobil nyaman untuk perjalanan tak terlupakan Anda di Bali & sekitarnya.
            </p>
        </div>
       {{-- FORM SEARCH --}}
<div class="bg-white rounded-2xl shadow-2xl p-6 max-w-4xl mx-auto" x-data="searchForm()" x-cloak>
    {{-- Tab Switch --}}
    <div class="flex gap-2 mb-6 bg-gray-100 rounded-xl p-1">
        <button @click="tipe='wisata'"
            :class="tipe==='wisata' ? 'bg-primary-600 text-white shadow-sm' : 'text-gray-600'"
            class="flex-1 py-2.5 px-4 rounded-lg text-sm font-semibold transition-all duration-200 flex items-center justify-center gap-2">
            <i class="fas fa-map-marked-alt"></i> Paket Wisata
        </button>
        <button @click="tipe='rental'"
            :class="tipe==='rental' ? 'bg-primary-600 text-white shadow-sm' : 'text-gray-600'"
            class="flex-1 py-2.5 px-4 rounded-lg text-sm font-semibold transition-all duration-200 flex items-center justify-center gap-2">
            <i class="fas fa-car"></i> Rental Mobil
        </button>
    </div>

    {{-- Container Form dengan Tinggi Tetap agar tidak melompat --}}
    <div class="relative min-h-[80px]"> 
        
        {{-- Wisata Form --}}
        <div x-show="tipe==='wisata'" 
             x-transition:enter="transition opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="text-xs font-semibold text-gray-500 uppercase mb-1 block">Wilayah</label>
                <select x-model="wilayah" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="">Semua Wilayah</option>
                    @foreach($wilayahs as $w)
                        <option value="{{ $w }}">{{ $w }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-xs font-semibold text-gray-500 uppercase mb-1 block">Durasi</label>
                <select x-model="durasi" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="">Semua Durasi</option>
                    @foreach($durasiOptions as $d)
                        <option value="{{ $d }}">{{ $d }} Hari</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button @click="searchWisata()" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 px-6 rounded-xl transition-all active:scale-95 flex items-center justify-center gap-2">
                    <i class="fas fa-search"></i> Cari Paket
                </button>
            </div>
        </div>

        {{-- Rental Form --}}
        <div x-show="tipe==='rental'" 
             x-transition:enter="transition opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="text-xs font-semibold text-gray-500 uppercase mb-1 block">Jenis Mobil</label>
                <select x-model="mobil" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="">Semua Mobil</option>
                    @foreach($mobilOptions as $m)
                        <option value="{{ $m }}">{{ $m }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-xs font-semibold text-gray-500 uppercase mb-1 block">Transmisi</label>
                <select x-model="transmisi" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="">Semua Transmisi</option>
                    <option value="manual">Manual</option>
                    <option value="automatic">Automatic</option>
                </select>
            </div>
            <div class="flex items-end">
                <button @click="searchRental()" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 px-6 rounded-xl transition-all active:scale-95 flex items-center justify-center gap-2">
                    <i class="fas fa-search"></i> Cari Mobil
                </button>
            </div>
        </div>
    </div>
</div>
    </div>
</section>

{{-- BENEFITS SECTION --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-3">Mengapa Pilih Kami?</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Kami berkomitmen memberikan pengalaman perjalanan terbaik dengan layanan profesional</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach([
                ['icon'=>'fa-shield-alt','color'=>'blue','title'=>'Terpercaya','desc'=>'Ribuan pelanggan puas dengan layanan kami'],
                ['icon'=>'fa-tag','color'=>'green','title'=>'Harga Terbaik','desc'=>'Harga kompetitif tanpa biaya tersembunyi'],
                ['icon'=>'fa-headset','color'=>'purple','title'=>'24/7 Support','desc'=>'Tim kami siap membantu kapanpun Anda butuh'],
                ['icon'=>'fa-star','color'=>'yellow','title'=>'Kualitas Premium','desc'=>'Armada terawat dan pemandu berpengalaman'],
            ] as $b)
            <div class="text-center p-6 rounded-2xl border border-gray-100 card-hover bg-white">
                <div class="w-14 h-14 bg-{{ $b['color'] }}-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas {{ $b['icon'] }} text-{{ $b['color'] }}-600 text-2xl"></i>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">{{ $b['title'] }}</h3>
                <p class="text-gray-500 text-sm">{{ $b['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PAKET FAVORIT --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Paket Wisata Terfavorit</h2>
                <p class="text-gray-500">Destinasi populer pilihan wisatawan</p>
            </div>
            <a href="{{ route('paket-wisata.index') }}" class="text-primary-600 hover:text-primary-700 font-semibold text-sm flex items-center gap-1">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($paketPopuler as $paket)
            <a href="{{ route('paket-wisata.show', $paket->slug) }}" class="bg-white rounded-2xl overflow-hidden shadow-sm card-hover block">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ $paket->gambar_utama ? asset('storage/'.$paket->gambar_utama) : 'https://picsum.photos/400/300?random='.$paket->id }}"
                         alt="{{ $paket->nama_paket }}" class="w-full h-full object-cover transition duration-300 hover:scale-110">
                    <div class="absolute top-3 left-3">
                        <span class="bg-primary-600 text-white text-xs font-semibold px-3 py-1 rounded-full">{{ $paket->durasi }} Hari</span>
                    </div>
                    @if($paket->is_populer)
                    <div class="absolute top-3 right-3">
                        <span class="bg-yellow-400 text-yellow-900 text-xs font-semibold px-3 py-1 rounded-full">
                            <i class="fas fa-fire-alt mr-1"></i>Populer
                        </span>
                    </div>
                    @endif
                </div>
                <div class="p-5">
                    <div class="flex items-center gap-1 text-yellow-400 text-sm mb-1">
                        @for($i=1; $i<=5; $i++)
                            <i class="fas fa-star {{ $i <= $paket->rating ? '' : 'text-gray-200' }}"></i>
                        @endfor
                        <span class="text-gray-500 ml-1 text-xs">({{ $paket->jumlah_ulasan }} ulasan)</span>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-1 text-lg">{{ $paket->nama_paket }}</h3>
                    <p class="text-gray-500 text-sm mb-3 flex items-center gap-1">
                        <i class="fas fa-map-marker-alt text-red-400"></i> {{ $paket->wilayah }}
                    </p>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs text-gray-400">Mulai dari</span>
                            <div class="text-primary-600 font-bold text-lg">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                        </div>
                        <span class="bg-primary-50 text-primary-700 text-xs font-medium px-3 py-1.5 rounded-full">Per orang</span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-10 text-gray-400">
                <i class="fas fa-map-marked-alt text-5xl mb-4"></i>
                <p>Belum ada paket wisata tersedia</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- PAKET RENTAL MOBIL --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Rental Mobil Unggulan</h2>
                <p class="text-gray-500">Armada pilihan untuk perjalanan nyaman</p>
            </div>
            <a href="{{ route('rental-mobil.index') }}" class="text-primary-600 hover:text-primary-700 font-semibold text-sm flex items-center gap-1">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
            @forelse($rentalTerbaru as $rental)
            <a href="{{ route('rental-mobil.show', $rental->slug) }}" class="bg-gray-50 rounded-2xl overflow-hidden card-hover block border border-gray-100">
                <div class="h-40 overflow-hidden">
                    <img src="{{ $rental->gambar_utama ? asset('storage/'.$rental->gambar_utama) : 'https://picsum.photos/400/250?random='.$rental->id }}"
                         alt="{{ $rental->nama_mobil }}" class="w-full h-full object-cover transition duration-300 hover:scale-110">
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-800 mb-1">{{ $rental->nama_mobil }}</h3>
                    <div class="flex items-center gap-3 text-xs text-gray-500 mb-3">
                        <span><i class="fas fa-users mr-1"></i>{{ $rental->kapasitas_penumpang }} org</span>
                        <span><i class="fas fa-cog mr-1"></i>{{ ucfirst($rental->transmisi) }}</span>
                    </div>
                    <div class="text-primary-600 font-bold">Rp {{ number_format($rental->harga_per_hari, 0, ',', '.') }}<span class="text-xs text-gray-400">/hari</span></div>
                </div>
            </a>
            @empty
            <div class="col-span-4 text-center py-10 text-gray-400">
                <i class="fas fa-car text-5xl mb-4"></i>
                <p>Belum ada rental mobil tersedia</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- TESTIMONI - White Theme --}}
<section class="py-20 bg-gradient-to-br from-primary-900 via-primary-800 to-primary-700 text-white" id="testimoni">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-white mb-3">Apa Kata Mereka?</h2>
            <p class="text-white max-w-xl mx-auto font-medium">Kepercayaan pelanggan adalah prioritas utama kami dalam setiap perjalanan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($testimonials as $t)
            <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 card-hover shadow-sm">
                <div class="flex items-center gap-1 text-amber-400 mb-5">
                    @for($i=1; $i<=5; $i++)
                        <i class="fas fa-star text-sm {{ $i <= $t->rating ? '' : 'text-gray-200' }}"></i>
                    @endfor
                </div>

                <p class="text-gray-700 text-base italic leading-relaxed mb-6">
                    "{{ $t->komentar }}"
                </p>

                <div class="flex items-center gap-4">
                    @if($t->foto)
                        <img src="{{ asset('storage/'.$t->foto) }}" class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm">
                    @else
                        <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center text-white font-bold shadow-md shadow-primary-200">
                            {{ strtoupper(substr($t->nama, 0, 1)) }}
                        </div>
                    @endif
                    
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm tracking-tight">{{ $t->nama }}</h4>
                        <p class="text-xs text-green-600 font-semibold flex items-center gap-1">
                            <i class="fas fa-check-circle"></i> Verified Customer
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12 text-gray-400">
                <i class="fas fa-quote-left text-4xl mb-4 opacity-20"></i>
                <p>Belum ada testimoni yang tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- CTA & FORM PEMESANAN --}}
<section class="py-16 bg-white" id="pesan">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-3">Siap Berwisata?</h2>
            <p class="text-gray-500">Isi form di bawah dan tim kami akan segera menghubungi Anda</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl p-4 mb-6 flex items-center gap-3">
                <i class="fas fa-check-circle text-green-500"></i>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('pesan') }}" method="POST" class="bg-gray-50 rounded-2xl p-8 space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap *</label>
                    <input type="text" name="nama" required value="{{ old('nama') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition"
                        placeholder="Masukkan nama Anda">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor HP / WhatsApp *</label>
                    <input type="text" name="no_hp" required value="{{ old('no_hp') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition"
                        placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email *</label>
                    <input type="email" name="email" required value="{{ old('email') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition"
                        placeholder="email@contoh.com">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Layanan yang Diinginkan *</label>
                    <select name="tipe" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition">
                        <option value="">-- Pilih Layanan --</option>
                        <option value="wisata" {{ old('tipe')=='wisata'?'selected':'' }}>Paket Wisata</option>
                        <option value="rental" {{ old('tipe')=='rental'?'selected':'' }}>Rental Mobil</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Keberangkatan *</label>
                    <input type="date" name="tanggal_berangkat" required value="{{ old('tanggal_berangkat') }}"
                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah Orang *</label>
                    <input type="number" name="jumlah_orang" required min="1" value="{{ old('jumlah_orang', 1) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Catatan Tambahan</label>
                <textarea name="catatan" rows="3"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition resize-none"
                    placeholder="Permintaan khusus, destinasi yang diinginkan, dll...">{{ old('catatan') }}</textarea>
            </div>
            @if($errors->any())
            <div class="bg-red-50 text-red-700 rounded-xl p-4 text-sm">
                <ul class="space-y-1">@foreach($errors->all() as $e)<li><i class="fas fa-exclamation-circle mr-1"></i>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif
            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-4 px-8 rounded-xl transition text-lg flex items-center justify-center gap-2">
                <i class="fab fa-whatsapp"></i> Kirim ke WhatsApp
            </button>
        </form>
    </div>
</section>

@endsection

@push('scripts')
<script>
function searchForm() {
    return {
        tipe: 'wisata',
        wilayah: '',
        durasi: '',
        mobil: '',
        transmisi: '',
        searchWisata() {
            const params = new URLSearchParams({ wilayah: this.wilayah, durasi: this.durasi });
            window.location.href = '{{ route("paket-wisata.index") }}?' + params;
        },
        searchRental() {
            const params = new URLSearchParams({ transmisi: this.transmisi, search: this.mobil });
            window.location.href = '{{ route("rental-mobil.index") }}?' + params;
        }
    }
}
</script>
@endpush
