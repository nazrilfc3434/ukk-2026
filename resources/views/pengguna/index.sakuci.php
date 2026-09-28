@extends('layouts.app')

@section('content')
<h1>Pengguna</h1>
<a href="{{ route('pengguna.create') }}" class="btn btn-primary mb-3">Tambah Pengguna</a>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($data as $d)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->nis }}</td>
            <td>{{ $d->kelas }}</td>
            <td>
                <a href="{{ route('pengguna.edit', ['pengguna' => $d->id_siswa]) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('pengguna.destroy', ['pengguna' => $d->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{!! $data->links() !!}
@endsection