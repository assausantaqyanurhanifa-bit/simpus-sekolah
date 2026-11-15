@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2 class="fw-bold text-dark">Dashboard Perpustakaan</h2>
        <p class="text-muted">Selamat datang di Sistem Informasi Perpustakaan (SIMPUS-Sekolah).</p>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card bg-primary text-white border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center py-4">
                <div>
                    <h3 class="fw-bold mb-1">{{ $total_buku }}</h3>
                    <div class="small opacity-75">Total Koleksi Buku</div>
                </div>
                <div style="font-size: 2.5rem; opacity: 0.8;">📚</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center py-4">
                <div>
                    <h3 class="fw-bold mb-1">{{ $total_anggota }}</h3>
                    <div class="small opacity-75">Anggota Terdaftar</div>
                </div>
                <div style="font-size: 2.5rem; opacity: 0.8;">👥</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center py-4">
                <div>
                    <h3 class="fw-bold mb-1">{{ $total_pinjam }}</h3>
                    <div class="small opacity-75">Buku Dipinjam</div>
                </div>
                <div style="font-size: 2.5rem; opacity: 0.8;">🔄</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center py-4">
                <div>
                    <h3 class="fw-bold mb-1">{{ $buku_tersedia }}</h3>
                    <div class="small opacity-75">Buku Tersedia</div>
                </div>
                <div style="font-size: 2.5rem; opacity: 0.8;">✅</div>
            </div>
        </div>
    </div>
</div>
@endsection