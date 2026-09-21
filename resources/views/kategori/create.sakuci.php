@extends ('layouts.app')

@section ('content')

<div class="container">
    <h1>Tambah Kategori</h1>
    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf 
        <div class="form-group mb-3">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
         </div>
         <button type="sumbit" class="btn btn-primary">Simpan</button>
</form>
@endsection
