<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="min-h-screen flex items-center justify-center p-4" style="background: linear-gradient(135deg, #1e3a8a, #2563eb)">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-white">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-plane text-white"></i>
                </div>
                <span class="font-bold text-2xl">{{ config('app.name', 'TravelKu') }}</span>
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Buat Akun Baru</h2>
            <p class="text-gray-500 mb-6">Daftar untuk mulai memesan</p>

            @if($errors->any())
            <div class="bg-red-50 text-red-700 rounded-xl p-3 mb-4 text-sm">
                @foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        placeholder="Nama Anda">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        placeholder="email@contoh.com">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">No. HP / WhatsApp</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        placeholder="Min 8 karakter">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        placeholder="Ulangi password">
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl transition">
                    Buat Akun
                </button>
            </form>

            <div class="text-center mt-6 text-sm text-gray-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:text-blue-700">Masuk</a>
            </div>
        </div>
    </div>
</body>
</html>
