@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="bg-gray-50 min-h-screen py-28">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-primary-600 to-primary-800 text-white rounded-2xl p-8 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center text-2xl font-bold">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-2xl font-bold">Halo, {{ $user->name }}!</h1>
                    <p class="text-blue-200 text-sm">{{ $user->email }}</p>
                    @if($user->phone)<p class="text-blue-200 text-sm"><i class="fas fa-phone mr-1"></i>{{ $user->phone }}</p>@endif
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl p-4 mb-6 flex items-center gap-3">
            <i class="fas fa-check-circle text-green-500"></i>{{ session('success') }}
        </div>
        @endif

        {{-- Riwayat Pemesanan --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Riwayat Pemesanan</h2>

            @forelse($pemesanans as $p)
            <div class="border border-gray-100 rounded-xl p-5 mb-4 hover:border-primary-200 transition">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-mono text-sm bg-gray-100 px-2.5 py-1 rounded-lg text-gray-600">{{ $p->kode_booking }}</span>
                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold
                                {{ $p->status == 'pending' ? 'bg-yellow-100 text-yellow-700' :
                                   ($p->status == 'dikonfirmasi' ? 'bg-blue-100 text-blue-700' :
                                   ($p->status == 'selesai' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700')) }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </div>
                        <p class="text-gray-700 font-medium">
                            {{ $p->tipe == 'wisata' ? '🗺️ Paket Wisata' : '🚗 Rental Mobil' }}
                        </p>
                        <div class="text-sm text-gray-500 mt-1 space-x-3">
                            <span><i class="fas fa-calendar mr-1 text-primary-400"></i>{{ $p->tanggal_berangkat->format('d M Y') }}</span>
                            <span><i class="fas fa-users mr-1 text-primary-400"></i>{{ $p->jumlah_orang }} orang</span>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        {{-- WhatsApp CTA --}}
                        @php $waNumber = \App\Models\Pengaturan::get('whatsapp_number', env('WHATSAPP_NUMBER', '628')); @endphp
                        <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Halo, saya ingin menanyakan pesanan dengan kode: '.$p->kode_booking) }}"
                           target="_blank"
                           class="bg-green-50 hover:bg-green-100 text-green-700 px-3 py-2 rounded-xl text-sm font-medium transition flex items-center gap-1">
                            <i class="fab fa-whatsapp"></i> Hubungi
                        </a>

                        {{-- Tulis Ulasan --}}
                        @if($p->status == 'selesai' && !$p->ulasan)
                        <button onclick="document.getElementById('modal-ulasan-{{ $p->id }}').classList.remove('hidden')"
                            class="bg-primary-50 hover:bg-primary-100 text-primary-700 px-3 py-2 rounded-xl text-sm font-medium transition flex items-center gap-1">
                            <i class="fas fa-star"></i> Beri Ulasan
                        </button>
                        @elseif($p->ulasan)
                        <span class="text-xs text-gray-400 flex items-center gap-1">
                            <i class="fas fa-check-circle text-green-500"></i> Diulas
                        </span>
                        @endif
                    </div>
                </div>

                {{-- Modal Ulasan --}}
                @if($p->status == 'selesai' && !$p->ulasan)
                <div id="modal-ulasan-{{ $p->id }}" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
                    <div class="bg-white rounded-2xl p-6 max-w-md w-full">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-bold text-gray-800">Tulis Ulasan</h3>
                            <button onclick="document.getElementById('modal-ulasan-{{ $p->id }}').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <form action="{{ route('dashboard.ulasan', $p->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="text-sm font-semibold text-gray-700 mb-2 block">Rating</label>
                                <div class="flex gap-2" x-data="{ rating: 5 }">
                                    @for($i=1; $i<=5; $i++)
                                    <button type="button" onclick="setRating({{ $i }}, this)" data-val="{{ $i }}" class="star-btn text-gray-300 hover:text-yellow-400 text-2xl transition">
                                        <i class="fas fa-star"></i>
                                    </button>
                                    @endfor
                                    <input type="hidden" name="rating" id="rating-val-{{ $p->id }}" value="5">
                                </div>
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-700 mb-2 block">Komentar</label>
                                <textarea name="komentar" required minlength="10" rows="3"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-500 outline-none resize-none"
                                    placeholder="Ceritakan pengalaman perjalanan Anda..."></textarea>
                            </div>
                            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 rounded-xl transition">
                                Kirim Ulasan
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
            @empty
            <div class="text-center py-12 text-gray-400">
                <i class="fas fa-clipboard-list text-5xl mb-4"></i>
                <p class="mb-4">Belum ada riwayat pemesanan</p>
                <a href="{{ route('home') }}#pesan" class="bg-primary-600 text-white px-6 py-3 rounded-xl text-sm font-semibold hover:bg-primary-700 transition">
                    Buat Pemesanan
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function setRating(val, btn) {
    const container = btn.closest('[x-data]') || btn.parentElement;
    const stars = container.querySelectorAll('.star-btn');
    stars.forEach((s, i) => {
        s.classList.toggle('text-yellow-400', i < val);
        s.classList.toggle('text-gray-300', i >= val);
    });
    const modalId = container.closest('form').querySelector('[id^="rating-val-"]')?.id;
    if(modalId) document.getElementById(modalId).value = val;
}
// Initialize all stars to 5
document.querySelectorAll('.star-btn').forEach((btn, i, arr) => {
    const siblings = Array.from(btn.parentElement.querySelectorAll('.star-btn'));
    const idx = siblings.indexOf(btn);
    if(idx < 5) btn.classList.replace('text-gray-300', 'text-yellow-400');
});
</script>
@endpush
