@extends('layouts.app')
@section('title', 'Blog')
@section('content')

<div class="hero-gradient text-white py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold mb-3">Blog & Artikel</h1>
        <p class="text-blue-100 text-lg">Tips perjalanan, destinasi wisata, dan banyak lagi</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($blogs as $blog)
        <a href="{{ route('blog.show', $blog->slug) }}" class="bg-white rounded-2xl overflow-hidden card-hover block border border-gray-100 shadow-sm">
            <div class="h-52 overflow-hidden">
                <img src="{{ $blog->gambar ? asset('storage/'.$blog->gambar) : 'https://picsum.photos/400/300?random='.$blog->id }}"
                     alt="{{ $blog->judul }}" class="w-full h-full object-cover transition duration-300 hover:scale-110">
            </div>
            <div class="p-5">
                <p class="text-xs text-gray-400 mb-2">{{ $blog->published_at?->format('d M Y') ?? '-' }}</p>
                <h3 class="font-bold text-gray-800 text-lg mb-2 line-clamp-2">{{ $blog->judul }}</h3>
                @if($blog->ringkasan)
                <p class="text-gray-500 text-sm line-clamp-2 mb-3">{{ $blog->ringkasan }}</p>
                @endif
                <span class="text-primary-600 text-sm font-semibold flex items-center gap-1">
                    Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                </span>
            </div>
        </a>
        @empty
        <div class="col-span-3 text-center py-16 text-gray-400">
            <i class="fas fa-pen-alt text-5xl mb-4"></i>
            <p>Belum ada artikel tersedia</p>
        </div>
        @endforelse
    </div>
    <div class="mt-8">{{ $blogs->links() }}</div>
</div>
@endsection
