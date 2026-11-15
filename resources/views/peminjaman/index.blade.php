@extends('layout.main')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>🔄 Transaksi Peminjaman Buku</h2>
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">+ Catat Transaksi Baru</a>
</div>

<form action="{{ route('peminjaman.index') }}" method="GET" class="row g-2 mb-3">
    <div class="col-md-5">
        <input type="text" name="search" class="form-control" placeholder="Cari nama peminjam atau judul buku..." value="{{ $search ?? '' }}">
    </div>
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">Semua Status</option>
            <option value="Dipinjam" {{ ($status ?? '') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
            <option value="Dikembalikan" {{ ($status ?? '') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
        </select>
    </div>
    <div class="col-md-4">
        <button class="btn btn-outline-secondary" type="submit">🔍 Cari</button>
        @if(!empty($search) || !empty($status))
            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-danger">Reset</a>
        @endif
    </div>
</form>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-3">No</th>
                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $key => $pj)
                <tr>
                    <td class="ps-3">{{ $peminjamans->firstItem() + $key }}</td>
                    <td><strong>{{ $pj->anggota->nama ?? 'Anggota Terhapus' }}</strong></td>
                    <td>{{ $pj->buku->judul ?? 'Buku Terhapus' }}</td>
                    <td>{{ date('d-m-Y', strtotime($pj->tgl_pinjam)) }}</td>
                    <td>{{ $pj->tgl_kembali ? date('d-m-Y', strtotime($pj->tgl_kembali)) : '-' }}</td>
                    <td>
                        @if($pj->status == 'Dipinjam')
                            <span class="badge bg-warning text-dark">Dipinjam</span>
                        @else
                            <span class="badge bg-success">Dikembalikan</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($pj->status == 'Dipinjam')
                        <form action="{{ route('peminjaman.kembali', $pj->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Proses pengembalian buku ini?')">↩️ Kembalikan</button>
                        </form>
                        @else
                            <span class="text-muted small">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center p-4 text-muted">Belum ada riwayat transaksi peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    {{ $peminjamans->links() }}
</div>
@endsection