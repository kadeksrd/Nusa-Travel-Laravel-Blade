<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        
        // Paket Wisata
        Schema::create('paket_wisatas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->string('slug')->unique();
            $table->string('wilayah');
            $table->integer('durasi'); // hari
            $table->decimal('harga', 15, 2);
            $table->string('gambar_utama');
            $table->json('gambar_detail')->nullable(); // 4 gambar kecil
            $table->json('fasilitas')->nullable(); // icon + label
            $table->text('rencana_perjalanan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->decimal('rating', 2, 1)->default(5.0);
            $table->integer('jumlah_ulasan')->default(0);
            $table->boolean('is_populer')->default(false);
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });

        // Rental Mobil
        Schema::create('rental_mobils', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->string('slug')->unique();
            $table->enum('jenis', ['terfavorit', 'besar', 'sendiri']); // kategori
            $table->enum('transmisi', ['manual', 'automatic', 'both']);
            $table->integer('kapasitas_penumpang');
            $table->string('cc_mesin')->nullable();
            $table->decimal('harga_per_hari', 15, 2);
            $table->string('gambar_utama');
            $table->json('gambar_detail')->nullable();
            $table->json('fasilitas')->nullable();
            $table->text('detail_rental')->nullable();
            $table->decimal('rating', 2, 1)->default(5.0);
            $table->integer('jumlah_ulasan')->default(0);
            $table->boolean('is_populer')->default(false);
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });

        // Pemesanan
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nama_pemesan');
            $table->string('email_pemesan');
            $table->string('no_hp');
            $table->enum('tipe', ['wisata', 'rental']);
            $table->nullableMorphs('paket'); // morphs ke paket_wisata or rental_mobil
            $table->date('tanggal_berangkat');
            $table->integer('jumlah_orang')->default(1);
            $table->text('catatan')->nullable();
            $table->enum('status', ['pending', 'dikonfirmasi', 'selesai', 'dibatalkan'])->default('pending');
            $table->string('kode_booking')->unique();
            $table->timestamps();
        });

        // Ulasan
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('pemesanan_id')->constrained()->cascadeOnDelete();
            $table->integer('rating')->default(5);
            $table->text('komentar')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });

        // Blog
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('gambar');
            $table->text('konten');
            $table->text('ringkasan')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // Testimonial
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('foto')->nullable();
            $table->integer('rating')->default(5);
            $table->text('komentar');
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });

        // Pengaturan Website
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('ulasans');
        Schema::dropIfExists('pemesanans');
        Schema::dropIfExists('rental_mobils');
        Schema::dropIfExists('paket_wisatas');
    }
};
