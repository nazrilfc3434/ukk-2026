@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Tambah Alat</h3>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('alat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label>Nama Kategori</label>
                <select name="id_kategori" id="id_kategori" class="form-control" required>
                    <option value="">Pilih kategori alat</option>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                <label>Nama Alat</label>
                <input type="text" name="nama_alat" id="nama_alat" class="form-control" value="{{ old('nama_alat') }}" required>
                <label>Kode Alat</label>
                <input type="text" name="kode_alat" id="kode_alat" class="form-control" value="{{ old('kode_alat') }}" required>
                <label>Stok</label>
                <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok') }}" required>
                
                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection