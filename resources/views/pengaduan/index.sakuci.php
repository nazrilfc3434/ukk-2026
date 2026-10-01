@extends('layouts.app')
@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Pengaduan</h3>
        <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">Tambah Pengaduan</a>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($data as $p)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $p->judul }}</td>
                        <td>{{ mb_strimwidth($p->isi, 0, 60, '...') }}</td>
                        <td>
                            @if ($p->foto)
                                <img src="/uploads/pengaduan/{{ $p->foto }}" width="80" alt="Foto pengaduan">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $p->status }}</td>
                        <td>
                            <a href="{{ route('pengaduan.edit', ['id' => $p->id_pengaduan]) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pengaduan.destroy', ['id' => $p->id_pengaduan]) }}"
                                method="POST" class="d-inline" onsubmit="return confirm('Hapus pengaduan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $data->links() !!}
        </div>
    </div>
</div>
@endsection