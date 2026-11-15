<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // 1. Tabel semua buku (dengan pencarian dan pagination)
    public function index(Request $request)
    {
        $search = $request->get('search');

        $bukus = Buku::query()
            ->when($search, function ($query) use ($search) {
                $query->where('judul', 'LIKE', "%{$search}%")
                      ->orWhere('kode_buku', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // [Penyempurnaan] kata kunci tetap terbawa saat pindah halaman

        return view('buku.index', compact('bukus', 'search'));
    }

    // 2. Form tambah buku
    public function create()
    {
        return view('buku.create');
    }

    // 3. Simpan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|unique:bukus,kode_buku',
            'judul'     => 'required',
            'penulis'   => 'required',
            'penerbit'  => 'required',
            'tahun'     => 'required|numeric',
            'stok'      => 'required|numeric|min:0',
        ]);

        Buku::create($request->all());
        return redirect()->route('buku.index')->with('msg', 'Buku baru berhasil ditambahkan!');
    }

    // 4. Form edit buku
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    // 5. Simpan perubahan buku
    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'kode_buku' => 'required|unique:bukus,kode_buku,' . $id,
            'judul'     => 'required',
            'penulis'   => 'required',
            'penerbit'  => 'required',
            'tahun'     => 'required|numeric',
            'stok'      => 'required|numeric|min:0',
        ]);

        $buku->update($request->all());
        return redirect()->route('buku.index')->with('msg', 'Data buku berhasil diperbarui!');
    }

    // 6. Hapus buku
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('buku.index')->with('msg', 'Buku berhasil dihapus!');
    }
}