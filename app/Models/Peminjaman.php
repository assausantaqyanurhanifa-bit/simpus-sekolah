<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Nama tabel ditentukan manual (jangan biarkan Laravel menebak)
    protected $table = 'peminjamans';

    protected $fillable = ['anggota_id', 'buku_id', 'tgl_pinjam', 'tgl_kembali', 'status'];

    // Satu peminjaman dimiliki satu anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    // Satu peminjaman untuk satu buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}