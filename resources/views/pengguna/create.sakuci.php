@extends('layouts.app')

@section('content')

<h1>Tambah Pengguna</h1>
<form action="{{route('pengguna.store') }}" method="POST">
     @csrf
     <div class="form-groub mb-3">
          <label>Nama</label>
        <input type="text" name="nama" class="form-control">
          <label>NIS</label>
        <input type="text" name="nis" class="form-control">
          <label>Kelas</label>
        <input type="text" name="kelas" class="form-control">
     </div>
     <button type="submit" class="btn btn-primary">Simpan</button>
</form>

@endsection