<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $total_buku    = Buku::count();
        $total_anggota = Anggota::count();
        $total_pinjam  = Peminjaman::where('status', 'Dipinjam')->count();
        $buku_tersedia = Buku::where('stok', '>', 0)->count();

        return view('dashboard.index', compact('total_buku', 'total_anggota', 'total_pinjam', 'buku_tersedia'));
    }
}