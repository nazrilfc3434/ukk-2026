@extends('layouts.app')

@section('content')
<h1>Edit Pengguna</h1>

<form action="{{ route('pengguna.update', ['pengguna' => $siswa->id_siswa]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group mb-3">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ $siswa->nama }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="nis">NIS</label>
        <input type="text" class="form-control" id="nis" name="nis" value="{{ $siswa->nis }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="kelas">Kelas</label>
        <input type="text" class="form-control" id="kelas" name="kelas" value="{{ $siswa->kelas }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection