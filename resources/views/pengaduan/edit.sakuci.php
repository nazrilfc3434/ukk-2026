@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Edit Pengaduan</h3>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pengaduan.update', ['id' => $data->id_pengaduan]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $data->judul) }}" maxlength="255" required>

                <label>Isi Pengaduan</label>
                <textarea name="isi" rows="5" class="form-control" required>{{ old('isi', $data->isi) }}</textarea>

                <label>Foto saat ini</label><br>
                @if ($data->foto)
                    <img src="/uploads/pengaduan/{{ $data->foto }}" width="120" alt="Foto pengaduan"><br>
                @else
                    <span>Belum ada foto</span><br>
                @endif

                <label>Ganti foto (opsional)</label>
                <input type="file" name="foto" class="form-control" accept="image/*">

                <button type="submit" class="btn btn-primary mt-2">Perbarui</button>
                <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection