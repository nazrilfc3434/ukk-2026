@extends('layouts.app')
@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Pengaduan</h3>
        <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">Tambah Pengaduan</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th width="220">Aksi</th>
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
                                <img src="/uploads/pengaduan/{{ $p->foto }}" width="80" class="img-thumbnail" alt="Foto pengaduan">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($p->status == '0' || $p->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($p->status == 'proses')
                                <span class="badge bg-info text-dark">Proses</span>
                            @elseif($p->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-secondary">{{ $p->status }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('pengaduan.show', ['id' => $p->id_pengaduan]) }}" class="btn btn-info btn-sm text-white">Tanggapi</a>
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