@extends('layouts.app')

@section('content')
<div class="container">
    <h1>kategori</h1>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3 btn-sm">Tambah Kategori</a>
    <table class="table table-bordered table-striped">
        <thead> 
            <tr>
                <th>NO</th>
                <th>keterangan</th>
                <th>Aksi</th>
            </tr>   
        </thead>
        <tbody>
            @php 
            $no = 1;
            @endphp
            @foreach ($data as $items)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $items->keterangan }}</td>
                <td>
                    <a href="{{ route('kategori.edit', ['id_kategori' => $items->id_kategori]) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('kategori.destroy', ['id_kategori' => $items->id_kategori]) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>

                </td>
            </tr>     
            @endforeach
        </tbody>
    </table>
    
    {!! $data->links() !!}
</div>
@endsection