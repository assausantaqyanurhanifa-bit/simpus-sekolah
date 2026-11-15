@extends('layout.main')

@section('content')
<div class="mb-3">
    <h2>📝 Edit Data Anggota</h2>
    <p class="text-muted">Perbarui data anggota bernama <strong>{{ $anggota->nama }}</strong>.</p>
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

        <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $anggota->nama) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Tinggal</label>
                <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $anggota->alamat) }}</textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">No. Handphone</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $anggota->no_hp) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $anggota->email) }}">
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('anggota.index') }}" class="btn btn-secondary">🔙 Kembali</a>
                <button type="submit" class="btn btn-warning">🔄 Perbarui Anggota</button>
            </div>
        </form>
    </div>
</div>
@endsection