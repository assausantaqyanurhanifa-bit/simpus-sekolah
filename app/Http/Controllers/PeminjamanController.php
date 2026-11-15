<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    // 1. Daftar semua transaksi
    public function index()
    {
        // with() memuat relasi sekaligus agar query lebih efisien
        $peminjamans = Peminjaman::with(['anggota', 'buku'])->latest()->paginate(10);
        return view('peminjaman.index', compact('peminjamans'));
    }

    // 2. Form transaksi baru (dropdown anggota dan buku)
    public function create()
    {
        $anggotas = Anggota::orderBy('nama')->get();
        $bukus    = Buku::where('stok', '>', 0)->orderBy('judul')->get(); // hanya buku yang masih ada stok
        return view('peminjaman.create', compact('anggotas', 'bukus'));
    }

    // 3. Simpan peminjaman baru
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'buku_id'    => 'required|exists:bukus,id',
            'tgl_pinjam' => 'required|date',
        ]);

        // [Penyempurnaan] Transaksi database: simpan peminjaman dan kurangi stok
        // harus berhasil bersama-sama, atau dibatalkan bersama-sama.
        try {
            DB::transaction(function () use ($request) {
                $buku = Buku::lockForUpdate()->findOrFail($request->buku_id);

                if ($buku->stok < 1) {
                    throw new \RuntimeException('Stok buku habis, transaksi tidak dapat diproses.');
                }

                Peminjaman::create([
                    'anggota_id' => $request->anggota_id,
                    'buku_id'    => $request->buku_id,
                    'tgl_pinjam' => $request->tgl_pinjam,
                    'status'     => 'Dipinjam',
                ]);

                $buku->decrement('stok'); // stok berkurang 1
            });
        } catch (\RuntimeException $e) {
            return back()->withErrors(['buku_id' => $e->getMessage()])->withInput();
        }

        return redirect()->route('peminjaman.index')->with('msg', 'Transaksi peminjaman berhasil dicatat!');
    }

    // 4. Proses pengembalian buku (tombol "Kembalikan")
    public function kembalikanBuku($id)
    {
        $sudahDikembalikan = false;

        DB::transaction(function () use ($id, &$sudahDikembalikan) {
            $peminjaman = Peminjaman::lockForUpdate()->findOrFail($id);

            // [Penyempurnaan] cegah pengembalian ganda (stok bertambah dua kali)
            if ($peminjaman->status === 'Dikembalikan') {
                $sudahDikembalikan = true;
                return;
            }

            $peminjaman->update([
                'status'      => 'Dikembalikan',
                'tgl_kembali' => date('Y-m-d'),
            ]);

            Buku::findOrFail($peminjaman->buku_id)->increment('stok'); // stok bertambah 1
        });

        if ($sudahDikembalikan) {
            return redirect()->route('peminjaman.index')->with('msg', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        return redirect()->route('peminjaman.index')->with('msg', 'Buku telah berhasil dikembalikan!');
    }

    // 5. Halaman laporan
    public function laporan()
    {
        $peminjamans   = Peminjaman::with(['anggota', 'buku'])->latest()->get();
        $total_pinjam  = Peminjaman::where('status', 'Dipinjam')->count();
        $total_kembali = Peminjaman::where('status', 'Dikembalikan')->count();

        return view('peminjaman.laporan', compact('peminjamans', 'total_pinjam', 'total_kembali'));
    }
}