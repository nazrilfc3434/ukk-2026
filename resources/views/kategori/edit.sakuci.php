@extends('layouts.app')

@section('content')
<form action="{{ route('kategori.update', ['id_kategori' => $kategori->id_kategori]) }}" method="post" class="d-flex flex-column form-horizontal">
    @csrf
    @method('PUT')
    <label>Nama Kategori</label>    
    <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" class="form-control mb-3" required>
    <label>Keterangan</label>    
    <input type="text" name="keterangan" value="{{ old('keterangan', $kategori->keterangan) }}" class="form-control mb-3" required>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection