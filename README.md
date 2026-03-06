# 🌴 Travel & Rental Mobil – Laravel + Filament + Breeze

Website travel professional dengan fitur lengkap sesuai flowchart desain.

## 📦 Stack Teknologi
- **Laravel 12** – Backend framework
- **Filament 3** – Admin panel
- **Laravel Breeze** – Auth (login/register)
- **Blade + Alpine.js** – Frontend templating
- **Tailwind CSS CDN** – Styling
- **MySQL** – Database

---

## 🚀 Cara Install

### 1. Clone / Ekstrak Project
```bash
cd /var/www
unzip travel-app.zip
cd travel-app
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` sesuaikan database:
```env
DB_DATABASE=travel_rental
DB_USERNAME=root
DB_PASSWORD=your_password
WHATSAPP_NUMBER=6281234567890
```

### 4. Setup Database
```bash
mysql -u root -p -e "CREATE DATABASE Nusa_travel_Blade CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
php artisan migrate
php artisan db:seed
```

### 5. Storage Link
```bash
php artisan storage:link
```

### 6. Jalankan Server
```bash
php artisan serve
```

Buka: **http://localhost:8000**

---

## 🔐 Akun Default (setelah seeding)

| Role  | Email              | Password |
|-------|--------------------|----------|
| Admin | admin@travel.com   | password |
| User  | user@travel.com    | password |

### URL Admin Panel
```
http://localhost:8000/admin
```

---

## 📄 Halaman & Fitur

### Public Website
| Halaman | URL | Deskripsi |
|---------|-----|-----------|
| Homepage | `/` | Hero, form search wisata/rental, paket favorit, rental, testimoni, CTA form |
| Paket Wisata | `/paket-wisata` | List semua paket dengan filter wilayah & durasi, pagination |
| Detail Wisata | `/paket-wisata/{slug}` | Detail lengkap + sidebar form order WhatsApp |
| Rental Mobil | `/rental-mobil` | Kategori: Terfavorit, Besar, Sendiri dengan filter transmisi |
| Detail Rental | `/rental-mobil/{slug}` | Detail lengkap + sidebar form order WhatsApp |
| Blog | `/blog` | Kumpulan artikel, pagination |
| Detail Blog | `/blog/{slug}` | Konten artikel lengkap |
| Thank You | `/terima-kasih` | Konfirmasi pemesanan + link WhatsApp |

### Auth
| Halaman | URL |
|---------|-----|
| Login | `/login` |
| Register | `/register` |
| Dashboard User | `/dashboard` |

### Admin Panel (Filament)
| Menu | Fitur |
|------|-------|
| **Paket Wisata** | CRUD paket wisata + upload gambar, fasilitas, rencana perjalanan |
| **Rental Mobil** | CRUD rental mobil + kategori, fasilitas, spesifikasi |
| **Pemesanan** | Lihat & kelola semua order, ubah status |
| **Blog** | CRUD artikel dengan rich editor |
| **Pengaturan Website** | No WA, paket populer, email admin |

---

## 🗄️ Struktur Database

```
users               - Data pengguna (admin/user)
paket_wisatas       - Paket wisata (wilayah, durasi, harga, fasilitas)
rental_mobils       - Rental mobil (jenis, transmisi, kapasitas)
pemesanans          - Data pemesanan (morphs ke wisata/rental)
ulasans             - Ulasan dari user setelah selesai
blogs               - Artikel blog
testimonials        - Testimoni pelanggan
pengaturans         - Key-value settings website
```

---

## 🔧 Form Search Logic (Homepage)

Sesuai flowchart:
- **Wisata**: Filter by `wilayah` + `durasi` → tampilkan paket sesuai
- **Rental**: Filter by `nama_mobil` + `transmisi` → tampilkan mobil yang ada

---

## 📱 Alur WhatsApp Order

1. User isi form pemesanan (homepage / detail page)
2. Data tersimpan ke database dengan kode booking
3. User di-redirect ke Thank You page
4. Tombol "Konfirmasi via WhatsApp" membuka WA dengan pesan otomatis berisi detail pemesanan

---

## 🎨 Kustomisasi

### Ganti No WhatsApp
Via Admin → Pengaturan Website → Nomor WhatsApp

### Ganti Nama Website
Edit `APP_NAME` di `.env`

### Ganti Warna Utama
Edit `tailwind.config` di `layouts/app.blade.php` bagian `primary`

---

## 🏗️ Struktur Folder

```
app/
├── Filament/
│   ├── Resources/
│   │   ├── PaketWisataResource.php
│   │   ├── RentalMobilResource.php
│   │   ├── BlogResource.php
│   │   └── PemesananResource.php
│   └── Pages/
│       └── PengaturanWebsite.php
├── Http/Controllers/
│   ├── HomeController.php
│   ├── PaketWisataController.php
│   ├── RentalMobilController.php
│   ├── BlogController.php
│   └── DashboardController.php
└── Models/
    ├── User.php
    ├── PaketWisata.php
    ├── RentalMobil.php
    ├── Pemesanan.php
    └── Blog.php

resources/views/
├── layouts/app.blade.php
├── home/index.blade.php
├── paket-wisata/index.blade.php
├── rental-mobil/index.blade.php
├── detail/paket-wisata.blade.php
├── detail/rental-mobil.blade.php
├── blog/index.blade.php
├── dashboard/user.blade.php
└── auth/login.blade.php
```
# Nusa-Travel-Laravel-Blade
