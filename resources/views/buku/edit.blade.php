@extends('layout.main')

@section('content')
<div class="mb-3">
    <h2>📝 Edit Data Koleksi Buku</h2>
    <p class="text-muted">Perbarui informasi buku dengan kode <strong>{{ $buku->kode_buku }}</strong>.</p>
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

        <form action="{{ route('buku.update', $buku->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Kode Buku</label>
                    <input type="text" name="kode_buku" class="form-control" value="{{ old('kode_buku', $buku->kode_buku) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $buku->judul) }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Penulis / Pengarang</label>
                    <input type="text" name="penulis" class="form-control" value="{{ old('penulis', $buku->penulis) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit', $buku->penerbit) }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $buku->tahun) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Stok Buku (Eksemplar)</label>
                    <input type="number" name="stok" class="form-control" value="{{ old('stok', $buku->stok) }}">
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('buku.index') }}" class="btn btn-secondary">🔙 Kembali</a>
                <button type="submit" class="btn btn-warning">🔄 Perbarui Data</button>
            </div>
        </form>
    </div>
</div>
@endsection