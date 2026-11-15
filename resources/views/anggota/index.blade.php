@extends('layout.main')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>👥 Daftar Anggota Perpustakaan</h2>
    <a href="{{ route('anggota.create') }}" class="btn btn-primary">+ Register Anggota Baru</a>
</div>

<!-- Form pencarian -->
<form action="{{ route('anggota.index') }}" method="GET" class="mb-3">
    <div class="input-group" style="max-width: 400px;">
        <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ $search ?? '' }}">
        <button class="btn btn-outline-secondary" type="submit">🔍 Cari</button>
        @if($search)
            <a href="{{ route('anggota.index') }}" class="btn btn-outline-danger">Reset</a>
        @endif
    </div>
</form>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-3">No</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Email</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($anggotas as $key => $agt)
                <tr>
                    <td class="ps-3">{{ $anggotas->firstItem() + $key }}</td>
                    <td><strong>{{ $agt->nama }}</strong></td>
                    <td>{{ $agt->alamat }}</td>
                    <td>{{ $agt->no_hp }}</td>
                    <td>{{ $agt->email }}</td>
                    <td class="text-center">
                        <a href="{{ route('anggota.edit', $agt->id) }}" class="btn btn-warning btn-sm">📝 Edit</a>

                        <form action="{{ route('anggota.destroy', $agt->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau menghapus anggota ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-4 text-muted">Belum ada anggota terdaftar. Silakan tambah data baru!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    {{ $anggotas->links() }}
</div>
@endsection