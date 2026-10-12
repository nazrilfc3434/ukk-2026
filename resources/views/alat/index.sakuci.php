@extends('layouts.app')
@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Alat &amp; Fasilitas</h3>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Kode</th>
                        <th>Nama Alat</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($data as $alat)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $alat->kategori->nama_kategori ?? '-' }}</td>
                        <td>{{ $alat->kode_alat }}</td>
                        <td>{{ $alat->nama_alat }}</td>
                        <td>{{ $alat->stok }}</td>
                    </tr>
                    @endforeach

                    @if ($no === 1)
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data alat.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {!! $data->links() !!}
        </div>
    </div>
</div>
@endsection