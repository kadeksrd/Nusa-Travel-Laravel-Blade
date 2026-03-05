@extends('layouts.app')
@section('title', $blog->judul)
@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <nav class="text-sm text-gray-500 mb-6 flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-primary-600">Beranda</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <a href="{{ route('blog.index') }}" class="hover:text-primary-600">Blog</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-gray-800">{{ Str::limit($blog->judul, 40) }}</span>
    </nav>
    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">{{ $blog->judul }}</h1>
    <p class="text-sm text-gray-400 mb-6">{{ $blog->published_at?->format('d M Y') }}</p>
    <img src="{{ $blog->gambar ? asset('storage/'.$blog->gambar) : 'https://picsum.photos/800/400?random='.$blog->id }}"
         alt="{{ $blog->judul }}" class="w-full h-80 object-cover rounded-2xl mb-8">
    <div class="prose prose-lg max-w-none text-gray-700">
        {!! $blog->konten !!}
    </div>
    @if($blogLainnya->isNotEmpty())
    <div class="mt-12 pt-8 border-t border-gray-200">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Artikel Lainnya</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($blogLainnya as $b)
            <a href="{{ route('blog.show', $b->slug) }}" class="bg-gray-50 rounded-xl overflow-hidden card-hover block">
                <div class="h-36 overflow-hidden">
                    <img src="{{ $b->gambar ? asset('storage/'.$b->gambar) : 'https://picsum.photos/300/200?random='.$b->id }}" class="w-full h-full object-cover">
                </div>
                <div class="p-3">
                    <h4 class="font-semibold text-sm text-gray-800 line-clamp-2">{{ $b->judul }}</h4>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
