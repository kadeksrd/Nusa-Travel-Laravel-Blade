<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Travel & Rental Mobil') - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('description', 'Paket wisata dan rental mobil terpercaya')">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 50:'#eff6ff',100:'#dbeafe',500:'#3b82f6',600:'#1e3a8a',700:'#0449ba',800:'#1e40af',900:'#1e3a8a' },
                        accent: { 500:'#f59e0b',600:'#d97706' }
                    }
                }
            }
        }
    </script>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
    body { font-family: 'Inter', sans-serif; }
    .hero-gradient { background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #0ea5e9 100%); }
    .card-hover { transition: all 0.3s ease; }
    .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.15); }

    /* =========================================
       Class Baru: Pengaturan Gambar Inherit
       Sesuai permintaan: Display & Mewarisi Ukuran
       ========================================= */
    .img-inherit {
        display: block; /* Sesuai display yang diminta */
        width: inherit;   /* Mewarisi lebar container */
        height: inherit;  /* Mewarisi tinggi container */
        object-fit: cover; /* Biar gambar ga gepeng, tetep proporsional */
    }

    /* Class Baru: Foto Bali untuk Paket Wisata
       Gunakan Unsplash Terkompres (&q=60) agar enteng
    */
    .bg-wisata {
        background-image: linear-gradient(to bottom, rgba(0,0,0,0.8), rgba(0,0,0,0.3)), 
                          url('https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=60');
        background-size: cover;
        background-position: center;
    }

    /* KUSTOM GELAP: Foto Mobil untuk Rental Mobil
       Logika: Tambah Overlay Gradient Gelap (Black/80% -> Black/30%) di atas gambar
    */
    .bg-rental {
        background-image: linear-gradient(to bottom, rgba(0,0,0,0.8), rgba(0,0,0,0.3)), 
                          url("{{ asset('storage/hero-img/rental-hero.jpg') }}");
        background-size: cover;
        background-position: center center;
        height: 300px;
    }

    .bg-blog {
        background-image: linear-gradient(to bottom, rgba(0,0,0,0.8), rgba(0,0,0,0.3)), 
                          url('https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=60');
        background-size: cover;
        background-position: center;
    }
</style>

    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
  <nav x-data="{ 
        open: false, 
        scrolled: false, 
        /* Logika: Cek apakah URL saat ini adalah Home, Paket Wisata, atau Rental Mobil */
        isTransparentPage: ['/', '/paket-wisata', '/rental-mobil'].includes(window.location.pathname)
    }" 
    x-init="if(!isTransparentPage) scrolled = true"
    @scroll.window="if(isTransparentPage) scrolled = (window.pageYOffset > 50)"
    :class="{
        'bg-white border-b border-gray-200 py-2 border-b border-gray-200': scrolled || !isTransparentPage,
        'bg-transparent py-4': !scrolled && isTransparentPage
    }"
    class="fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
    <div class="w-9 h-9 bg-primary-600 rounded-lg flex items-center justify-center shadow-lg transition-transform group-hover:scale-110">
        <i class="fas fa-plane text-white text-sm"></i>
    </div>
    
    <span class="font-bold text-xl transition-colors duration-300"
          :class="scrolled ? 'text-primary-900' : 'text-white'">
        {{ config('app.name', 'TravelKu') }}
    </span>
</a>

                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center gap-6">
                    @php $linkClass = "font-medium transition-colors duration-300"; @endphp
                    
                    <a href="{{ route('paket-wisata.index') }}" 
                       :class="scrolled ? 'text-gray-600 hover:text-primary-600' : 'text-white hover:text-primary-200'"
                       class="{{ $linkClass }}">Paket Wisata</a>
                    
                    <a href="{{ route('rental-mobil.index') }}" 
                       :class="scrolled ? 'text-gray-600 hover:text-primary-600' : 'text-white hover:text-primary-200'"
                       class="{{ $linkClass }}">Rental Mobil</a>
                    
                    <a href="{{ route('home') }}#testimoni" 
                       :class="scrolled ? 'text-gray-600 hover:text-primary-600' : 'text-white hover:text-primary-200'"
                       class="{{ $linkClass }}">Testimoni</a>
                    
                    <a href="{{ route('blog.index') }}" 
                       :class="scrolled ? 'text-gray-600 hover:text-primary-600' : 'text-white hover:text-primary-200'"
                       class="{{ $linkClass }}">Blog</a>
                    
                    <a href="{{ route('home') }}#contact" 
                       :class="scrolled ? 'text-gray-600 hover:text-primary-600' : 'text-white hover:text-primary-200'"
                       class="{{ $linkClass }}">Kontak</a>
                </div>

                <!-- Auth -->
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" 
       :class="(scrolled || !isTransparentPage) ? 'text-gray-600 hover:text-primary-600' : 'text-white hover:text-primary-200'"
       class="text-sm font-medium transition-colors duration-300">
        <i class="fas fa-user-circle mr-1"></i> {{ auth()->user()->name }}
    </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-red-500 hover:text-red-700">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-primary-600 font-medium">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700 transition">Daftar</a>
                    @endauth
                </div>

                <!-- Mobile toggle -->
              <button @click="open = !open" 
                        :class="scrolled ? 'text-gray-500' : 'text-white'"
                        class="md:hidden p-2 rounded-md transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition class="md:hidden bg-white border-t px-4 py-3 space-y-2">
            <a href="{{ route('paket-wisata.index') }}" class="block py-2 text-gray-700 hover:text-primary-600">Paket Wisata</a>
            <a href="{{ route('rental-mobil.index') }}" class="block py-2 text-gray-700 hover:text-primary-600">Rental Mobil</a>
            <a href="{{ route('blog.index') }}" class="block py-2 text-gray-700 hover:text-primary-600">Blog</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block py-2 text-gray-700">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button type="submit" class="block py-2 text-red-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block py-2 text-gray-700">Masuk</a>
                <a href="{{ route('register') }}" class="block py-2 text-primary-600 font-medium">Daftar</a>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-12 pb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-9 h-9 bg-primary-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-plane text-white text-sm"></i>
                        </div>
                        <span class="font-bold text-xl">{{ config('app.name', 'TravelKu') }}</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">Layanan paket wisata dan rental mobil terpercaya dengan pengalaman terbaik.</p>
                    <div class="flex gap-3 mt-4">
                        <a href="#" class="w-9 h-9 bg-gray-700 rounded-full flex items-center justify-center hover:bg-primary-600 transition"><i class="fab fa-instagram text-sm"></i></a>
                        <a href="#" class="w-9 h-9 bg-gray-700 rounded-full flex items-center justify-center hover:bg-primary-600 transition"><i class="fab fa-facebook text-sm"></i></a>
                        <a href="#" class="w-9 h-9 bg-gray-700 rounded-full flex items-center justify-center hover:bg-green-600 transition"><i class="fab fa-whatsapp text-sm"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 text-white">Layanan</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('paket-wisata.index') }}" class="hover:text-white transition">Paket Wisata</a></li>
                        <li><a href="{{ route('rental-mobil.index') }}" class="hover:text-white transition">Rental Mobil</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-white transition">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 text-white">Akun</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        @auth
                            <li><a href="{{ route('dashboard') }}" class="hover:text-white transition">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-white transition">Masuk</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-white transition">Daftar</a></li>
                        @endauth
                    </ul>
                </div>
                <div id="contact">
                    <h4 class="font-semibold mb-4 text-white">Kontak</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center gap-2"><i class="fas fa-phone text-green-400"></i> +62 812 3456 7890</li>
                        <li class="flex items-center gap-2"><i class="fas fa-envelope text-blue-400"></i> info@travelku.com</li>
                        <li class="flex items-center gap-2"><i class="fas fa-map-marker-alt text-red-400"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-6 text-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'TravelKu') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
