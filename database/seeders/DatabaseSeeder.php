<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::firstOrCreate(
            ['email' => 'admin@simpus.test'],
            ['name' => 'Admin Perpustakaan', 'password' => Hash::make('password123')]
        );

        // Data buku contoh
        $bukus = [
            ['BK-001', 'Pemrograman Web dengan Laravel', 'Budi Raharjo', 'Informatika', 2022, 5],
            ['BK-002', 'Basis Data MySQL', 'Abdul Kadir', 'Andi', 2020, 4],
            ['BK-003', 'Rekayasa Perangkat Lunak', 'Rosa A.S.', 'Informatika', 2018, 3],
            ['BK-004', 'Algoritma dan Pemrograman', 'Rinaldi Munir', 'Informatika', 2016, 6],
            ['BK-005', 'Dasar-Dasar Scrum', 'Ken Schwaber', 'Warkop Agile', 2020, 2],
        ];
        foreach ($bukus as [$kode, $judul, $penulis, $penerbit, $tahun, $stok]) {
            Buku::firstOrCreate(
                ['kode_buku' => $kode],
                compact('judul', 'penulis', 'penerbit', 'tahun', 'stok')
            );
        }

        // Data anggota contoh
        $anggotas = [
            ['Anggota Contoh Satu', 'Yogyakarta', '081234567890', 'anggota1@contoh.test'],
            ['Anggota Contoh Dua', 'Sleman', '081298765432', 'anggota2@contoh.test'],
            ['Anggota Contoh Tiga', 'Bantul', '085612345678', 'anggota3@contoh.test'],
        ];
        foreach ($anggotas as [$nama, $alamat, $no_hp, $email]) {
            Anggota::firstOrCreate(['email' => $email], compact('nama', 'alamat', 'no_hp'));
        }
    }
}