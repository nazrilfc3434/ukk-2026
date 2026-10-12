@extends('layouts.app')
@section('content')

<div class="mx-auto" style="max-width: 560px;">
    <div class="mb-3">
        <h3 class="mb-0">Tambah Siswa</h3>
        <small class="text-secondary">Akun login dibuat otomatis dengan password awal 123456.</small>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form class="form-pengaduan" action="{{ route('pengguna.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control"
                           value="{{ old('nama') }}" maxlength="255" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="text" id="nis" name="nis" class="form-control"
                           value="{{ old('nis') }}" maxlength="20" required>
                </div>

                <div class="mb-4">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" id="kelas" name="kelas" class="form-control"
                           value="{{ old('kelas') }}" maxlength="10" placeholder="Contoh: XII RPL 1" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-brand">Simpan siswa</button>
                    <a href="{{ route('pengguna.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection