<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            // Kunci asing: terhubung ke tabel anggotas dan bukus (sesuai ERD)
            $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
            $table->foreignId('buku_id')->constrained('bukus')->onDelete('cascade');
            $table->date('tgl_pinjam');
            // nullable: saat baru dipinjam, tanggal kembali belum ada
            $table->date('tgl_kembali')->nullable();
            // otomatis "Dipinjam" saat data pertama masuk
            $table->string('status')->default('Dipinjam');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};