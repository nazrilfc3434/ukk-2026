@extends('layouts.app')
@section('content')

<div class="container py-4" style="max-width: 560px;">
    <div class="mb-3">
        <h3 class="mb-0">Edit Kategori</h3>
        <small class="text-secondary">Perubahan nama langsung berlaku di semua pengaduan.</small>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('kategori.update', ['id' => $data->id_kategori]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="nama_kategori" class="form-label fw-semibold">Nama kategori</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" class="form-control"
                           value="{{ old('nama_kategori', $data->nama_kategori) }}" maxlength="100" required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection