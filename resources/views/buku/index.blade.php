@extends('layout.main')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>📚 Daftar Koleksi Buku</h2>
    <a href="{{ route('buku.create') }}" class="btn btn-primary">+ Tambah Buku Baru</a>
</div>

<!-- Form pencarian -->
<form action="{{ route('buku.index') }}" method="GET" class="mb-3">
    <div class="input-group" style="max-width: 400px;">
        <input type="text" name="search" class="form-control" placeholder="Cari kode atau judul buku..." value="{{ $search ?? '' }}">
        <button class="btn btn-outline-secondary" type="submit">🔍 Cari</button>
        @if($search)
            <a href="{{ route('buku.index') }}" class="btn btn-outline-danger">Reset</a>
        @endif
    </div>
</form>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-3">No</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bukus as $key => $buku)
                <tr>
                    <td class="ps-3">{{ $bukus->firstItem() + $key }}</td>
                    <td><span class="badge bg-secondary">{{ $buku->kode_buku }}</span></td>
                    <td><strong>{{ $buku->judul }}</strong></td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->penerbit }}</td>
                    <td>{{ $buku->tahun }}</td>
                    <td>{{ $buku->stok }} eks</td>
                    <td class="text-center">
                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning btn-sm">📝 Edit</a>

                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau menghapus buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center p-4 text-muted">Belum ada koleksi buku. Silakan tambah data baru!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    {{ $bukus->links() }}
</div>
@endsection