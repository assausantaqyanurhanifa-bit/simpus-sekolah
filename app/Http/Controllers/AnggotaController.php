<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    // 1. Tabel anggota (pencarian + pagination)
    public function index(Request $request)
    {
        $search = $request->get('search');

        $anggotas = Anggota::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('anggota.index', compact('anggotas', 'search'));
    }

    // 2. Form tambah anggota
    public function create()
    {
        return view('anggota.create');
    }

    // 3. Simpan anggota baru
    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->messages());

        Anggota::create($request->all());
        return redirect()->route('anggota.index')->with('msg', 'Anggota baru berhasil terdaftar!');
    }

    // 4. Form edit anggota
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    // 5. Simpan perubahan anggota
    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $request->validate($this->rules($anggota->id), $this->messages());

        $anggota->update($request->all());
        return redirect()->route('anggota.index')->with('msg', 'Data anggota berhasil diperbarui!');
    }

    // 6. Hapus anggota
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();
        return redirect()->route('anggota.index')->with('msg', 'Data anggota berhasil dihapus!');
    }

    // Aturan validasi dipakai bersama oleh store dan update
    private function rules($ignoreId = null): array
    {
        return [
            'nama'   => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/'],
            'alamat' => ['required', 'string'],
            'no_hp'  => ['required', 'regex:/^(\+62|08)[0-9]{8,11}$/'],
            'email'  => ['required', 'email', Rule::unique('anggotas', 'email')->ignore($ignoreId)],
        ];
    }

    private function messages(): array
    {
        return [
            'nama.regex'   => 'Nama lengkap hanya boleh berisi huruf dan spasi (tidak boleh mengandung angka).',
            'email.email'  => 'Format email tidak valid, pastikan menggunakan tanda @.',
            'email.unique' => 'Email ini sudah terdaftar sebagai anggota lain.',
            'no_hp.regex'  => 'Nomor telepon harus diawali 08 atau +62 dan panjang 10-13 digit.',
        ];
    }
}