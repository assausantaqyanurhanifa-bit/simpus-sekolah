@extends('layout.main')

@section('content')
<div class="mb-3">
    <h2>➕ Registrasi Anggota Baru</h2>
    <p class="text-muted">Lengkapi data diri anggota untuk pembuatan kartu pustaka.</p>
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

        <form action="{{ route('anggota.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Contoh: Zedra Novianti" value="{{ old('nama') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Tinggal</label>
                <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">No. Handphone (WhatsApp)</label>
                    <input type="text" name="no_hp" class="form-control" placeholder="Contoh: 081234567890" value="{{ old('no_hp') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Contoh: nama@gmail.com" value="{{ old('email') }}">
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('anggota.index') }}" class="btn btn-secondary">🔙 Kembali</a>
                <button type="submit" class="btn btn-success">💾 Simpan Anggota</button>
            </div>
        </form>
    </div>
</div>
@endsection