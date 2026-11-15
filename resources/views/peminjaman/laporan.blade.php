@extends('layout.main')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📋 Laporan Peminjaman Buku</h2>
</div>

{{-- Kartu ringkasan --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card bg-warning text-dark border-0 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center py-4">
                <div>
                    <h3 class="fw-bold mb-1">{{ $total_pinjam }}</h3>
                    <div class="small">Sedang Dipinjam</div>
                </div>
                <div style="font-size: 2.5rem; opacity: 0.7;">🔄</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white border-0 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center py-4">
                <div>
                    <h3 class="fw-bold mb-1">{{ $total_kembali }}</h3>
                    <div class="small">Sudah Dikembalikan</div>
                </div>
                <div style="font-size: 2.5rem; opacity: 0.7;">✅</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-primary text-white border-0 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center py-4">
                <div>
                    <h3 class="fw-bold mb-1">{{ $total_pinjam + $total_kembali }}</h3>
                    <div class="small">Total Semua Transaksi</div>
                </div>
                <div style="font-size: 2.5rem; opacity: 0.7;">📊</div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel riwayat --}}
<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">📄 Riwayat Semua Transaksi Peminjaman</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-3">No</th>
                    <th>Nama Anggota</th>
                    <th>Judul Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $key => $pj)
                <tr>
                    <td class="ps-3">{{ $key + 1 }}</td>
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
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-4 text-muted">Belum ada data transaksi peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection