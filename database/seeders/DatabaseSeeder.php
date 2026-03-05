<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PaketWisata;
use App\Models\RentalMobil;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\Pengaturan;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::firstOrCreate(
    ['email' => 'admin@travel.com'],
    ['name' => 'Admin Travel', 'password' => bcrypt('password'), 'role' => 'admin', 'phone' => '081234567890']
);
        // Regular User
        User::firstOrCreate(
    ['email' => 'user@travel.com'],
    ['name' => 'Budi Santoso', 'password' => bcrypt('password'), 'role' => 'user', 'phone' => '082345678901']
);

        // Pengaturan
        Pengaturan::set('whatsapp_number', '6281234567890');
        Pengaturan::set('admin_email', 'admin@travel.com');

        // Paket Wisata
        $wilayahs = ['Bali', 'Lombok', 'Raja Ampat', 'Yogyakarta', 'Labuan Bajo', 'Bromo'];
        foreach ($wilayahs as $i => $wilayah) {
            $nama = "Paket Wisata {$wilayah} Eksotis";
            PaketWisata::create([
                'nama_paket' => $nama,
                'slug' => Str::slug($nama) . '-' . ($i+1),
                'wilayah' => $wilayah,
                'durasi' => [3, 4, 5, 7][$i % 4],
                'harga' => [1500000, 2000000, 2500000, 3000000, 3500000, 4000000][$i],
                'gambar_utama' => 'placeholder.jpg',
                'fasilitas' => [
                    ['icon' => 'fas fa-hotel', 'label' => 'Hotel Bintang 3'],
                    ['icon' => 'fas fa-bus', 'label' => 'Transport AC'],
                    ['icon' => 'fas fa-utensils', 'label' => 'Makan 3x/hari'],
                    ['icon' => 'fas fa-camera', 'label' => 'Guide Lokal'],
                ],
                'rencana_perjalanan' => "<p><strong>Hari 1:</strong> Tiba di {$wilayah}, check in hotel, makan malam bersama.</p><p><strong>Hari 2:</strong> Wisata alam dan budaya setempat.</p><p><strong>Hari 3:</strong> Wisata pantai dan kuliner lokal.</p><p><strong>Hari 4:</strong> Free time, oleh-oleh, kepulangan.</p>",
                'deskripsi' => "Nikmati keindahan {$wilayah} dengan paket wisata lengkap dan terjangkau.",
                'rating' => 4.5 + ($i * 0.1),
                'jumlah_ulasan' => rand(10, 100),
                'is_populer' => $i < 3,
                'is_aktif' => true,
            ]);
        }

        // Rental Mobil
        $mobils = [
            ['Toyota Avanza', 'terfavorit', 'manual', 7, '1500cc', 350000],
            ['Toyota Innova', 'terfavorit', 'automatic', 8, '2000cc', 450000],
            ['Daihatsu Xenia', 'sendiri', 'manual', 7, '1300cc', 300000],
            ['Suzuki Ertiga', 'sendiri', 'automatic', 7, '1400cc', 380000],
            ['Hiace Commuter', 'besar', 'manual', 15, '2700cc', 700000],
            ['ELF Long', 'besar', 'manual', 19, '3000cc', 900000],
        ];

        foreach ($mobils as $i => $m) {
            $slug = Str::slug($m[0]) . '-' . ($i+1);
            RentalMobil::create([
                'nama_mobil' => $m[0],
                'slug' => $slug,
                'jenis' => $m[1],
                'transmisi' => $m[2],
                'kapasitas_penumpang' => $m[3],
                'cc_mesin' => $m[4],
                'harga_per_hari' => $m[5],
                'gambar_utama' => 'placeholder.jpg',
                'fasilitas' => [
                    ['icon' => 'fas fa-users', 'label' => $m[3].' Penumpang'],
                    ['icon' => 'fas fa-snowflake', 'label' => 'AC Dingin'],
                    ['icon' => 'fas fa-music', 'label' => 'Audio System'],
                    ['icon' => 'fas fa-gas-pump', 'label' => 'Bensin Termasuk'],
                ],
                'detail_rental' => '<p>Syarat & ketentuan rental: KTP/SIM wajib, DP 50%, include BBM pilihan, mobil bersih dan terawat.</p>',
                'rating' => 4.3 + ($i * 0.1),
                'jumlah_ulasan' => rand(5, 50),
                'is_populer' => $i < 2,
                'is_aktif' => true,
            ]);
        }

        // Testimonial
        $testimonials = [
            ['Siti Rahma', 5, 'Pelayanan sangat memuaskan! Paket wisata Bali yang saya pesan sangat sesuai ekspektasi. Pemandu wisatanya ramah dan profesional.'],
            ['Ahmad Fauzi', 5, 'Rental mobil sangat nyaman, mobil bersih dan terawat. Harga juga sangat terjangkau dibanding tempat lain.'],
            ['Dewi Sartika', 4, 'Paket Lombok 5 hari 4 malam sangat worth it! Snorkeling di Gili Trawangan jadi pengalaman tak terlupakan.'],
            ['Rudi Hartono', 5, 'Sudah 3x pakai layanan travel ini dan selalu puas. Recommended banget untuk keluarga!'],
            ['Maya Indah', 4, 'Sopir yang kami dapat sangat berpengalaman dan tahu banyak spot foto bagus. Trip Bromo jadi berkesan.'],
            ['Budi Prakoso', 5, 'Proses pemesanan mudah lewat WhatsApp, respon cepat, dan harga transparan. Terima kasih!'],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create([
                'nama' => $t[0],
                'rating' => $t[1],
                'komentar' => $t[2],
                'is_aktif' => true,
            ]);
        }

        // Blog
        $blogs = [
            ['10 Destinasi Wisata Terbaik di Indonesia 2024', 'Jelajahi keindahan nusantara dengan mengunjungi 10 destinasi terbaik pilihan wisatawan lokal dan mancanegara.'],
            ['Tips Rental Mobil Aman untuk Liburan Keluarga', 'Sebelum memesan rental mobil, ada beberapa hal penting yang perlu diperhatikan agar perjalanan lancar dan aman.'],
            ['Panduan Lengkap Wisata Bali untuk Pertama Kali', 'Bali adalah destinasi impian banyak orang. Artikel ini akan memandu Anda menikmati Bali secara maksimal.'],
        ];

        foreach ($blogs as $i => $b) {
            Blog::create([
                'judul' => $b[0],
                'slug' => Str::slug($b[0]),
                'gambar' => 'placeholder-blog.jpg',
                'konten' => '<p>' . $b[1] . '</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>',
                'ringkasan' => $b[1],
                'is_published' => true,
                'published_at' => now()->subDays($i * 7),
            ]);
        }
    }
}
