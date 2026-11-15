@extends('layout.main')

@section('content')
<div class="mb-3">
    <h2>➕ Tambah Koleksi Buku Baru</h2>
    <p class="text-muted">Masukkan detail informasi buku secara lengkap.</p>
</div>

<div class="card shadow-sm col-md-8">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('buku.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Kode Buku</label>
                    <input type="text" name="kode_buku" class="form-control" placeholder="Contoh: BKV-001" value="{{ old('kode_buku') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" name="judul" class="form-control" placeholder="Contoh: Belajar Laravel 10" value="{{ old('judul') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Penulis / Pengarang</label>
                    <input type="text" name="penulis" class="form-control" placeholder="Nama penulis" value="{{ old('penulis') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" placeholder="Nama penerbit" value="{{ old('penerbit') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" name="tahun" class="form-control" placeholder="Contoh: 2024" value="{{ old('tahun') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Stok Buku (Eksemplar)</label>
                    <input type="number" name="stok" class="form-control" placeholder="Jumlah stok awal" value="{{ old('stok') }}">
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('buku.index') }}" class="btn btn-secondary">🔙 Kembali</a>
                <button type="submit" class="btn btn-success">💾 Simpan Data Buku</button>
            </div>
        </form>
    </div>
</div>
@endsection