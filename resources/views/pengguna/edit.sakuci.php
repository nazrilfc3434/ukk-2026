@extends('layouts.app')
@section('content')

<div class="mx-auto" style="max-width: 560px;">
    <div class="mb-3">
        <h3 class="mb-0">Edit Siswa</h3>
        <small class="text-secondary">Username login tidak ikut berubah saat nama diganti.</small>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form class="form-pengaduan"
                  action="{{ route('pengguna.update', ['pengguna' => $siswa->id_siswa]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control"
                           value="{{ old('nama', $siswa->nama) }}" maxlength="255" required>
                </div>

                <div class="mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="text" id="nis" name="nis" class="form-control"
                           value="{{ old('nis', $siswa->nis) }}" maxlength="20" required>
                </div>

                <div class="mb-4">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" id="kelas" name="kelas" class="form-control"
                           value="{{ old('kelas', $siswa->kelas) }}" maxlength="10" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-brand">Simpan perubahan</button>
                    <a href="{{ route('pengguna.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection