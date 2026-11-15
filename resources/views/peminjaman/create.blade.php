@extends('layout.main')

@section('content')
<div class="mb-3">
    <h2>➕ Catat Transaksi Peminjaman Baru</h2>
    <p class="text-muted">Pilih nama anggota dan buku yang akan dipinjam.</p>
</div>

<div class="card shadow-sm col-md-6">
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

        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Anggota (Peminjam)</label>
                <select name="anggota_id" class="form-select" required>
                    <option value="">-- Pilih Anggota --</option>
                    @foreach($anggotas as $agt)
                        <option value="{{ $agt->id }}" {{ old('anggota_id') == $agt->id ? 'selected' : '' }}>{{ $agt->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Buku yang Dipinjam</label>
                <select name="buku_id" class="form-select" required>
                    <option value="">-- Pilih Buku (Stok Tersedia) --</option>
                    @foreach($bukus as $bk)
                        <option value="{{ $bk->id }}" {{ old('buku_id') == $bk->id ? 'selected' : '' }}>{{ $bk->judul }} (Stok: {{ $bk->stok }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Pinjam</label>
                <input type="date" name="tgl_pinjam" class="form-control" value="{{ old('tgl_pinjam', date('Y-m-d')) }}" required>
            </div>

            <hr>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">🔙 Kembali</a>
                <button type="submit" class="btn btn-primary">💾 Proses Pinjam</button>
            </div>
        </form>
    </div>
</div>
@endsection