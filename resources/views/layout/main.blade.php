<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPUS-Sekolah - Sistem Informasi Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; min-height: 100vh; }
        .sidebar { background-color: #343a40; color: white; min-height: 100vh; }
        .sidebar a {
            color: #c2c7d0;
            text-decoration: none;
            padding: 12px 15px;
            display: block;
            transition: all 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
            color: white;
            border-radius: 4px;
        }
        .content-area { background-color: #f8f9fa; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar menu -->
        <div class="col-md-2 sidebar p-3 shadow">
            <h4 class="text-center text-white my-3 fw-bold">SIMPUS-Sekolah</h4>
            <hr class="text-secondary">
            <nav class="nav flex-column gap-1">
                <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">📊 Dashboard</a>
                <a href="{{ route('buku.index') }}" class="nav-link {{ Request::is('buku*') ? 'active' : '' }}">📚 Data Buku</a>
                <a href="{{ route('anggota.index') }}" class="nav-link {{ Request::is('anggota*') ? 'active' : '' }}">👥 Data Anggota</a>
                <a href="{{ route('peminjaman.index') }}" class="nav-link {{ Request::is('peminjaman*') ? 'active' : '' }}">🔄 Transaksi Perpus</a>
                <a href="{{ route('laporan') }}" class="nav-link {{ Request::is('laporan*') ? 'active' : '' }}">📋 Laporan</a>
            </nav>
            <hr class="text-secondary">
            <div class="px-2">
                <div class="text-white-50 small mb-2">👤 {{ auth()->user()->name ?? 'Admin' }}</div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm w-100">🚪 Logout</button>
                </form>
            </div>
        </div>

        <!-- Area isi halaman -->
        <div class="col-md-10 content-area p-4">
            @if(session('msg'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    {{ session('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>