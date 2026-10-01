@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Tambah Pengaduan</h3>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" maxlength="255" required>

                <label>Isi Pengaduan</label>
                <textarea name="isi" rows="5" class="form-control" required>{{ old('isi') }}</textarea>

                <label>Foto (opsional)</label>
                <input type="file" name="foto" class="form-control" accept="image/*">

                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection