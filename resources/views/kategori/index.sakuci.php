@extends('layouts.app')
@section('content')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-3">
        <div>
            <h3 class="mb-0">Data Kategori</h3>
            <small class="text-secondary">Kelompokkan pengaduan agar mudah dipilah.</small>
        </div>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary">+ Tambah kategori</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Nama kategori</th>
                        <th width="170">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($data as $k)
                    <tr>
                        <td class="text-secondary">{{ $no++ }}</td>
                        <td class="fw-semibold">{{ $k->nama_kategori }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('kategori.edit', ['id' => $k->id_kategori]) }}"
                                   class="btn btn-outline-secondary btn-sm">Edit</a>
                                <form action="{{ route('kategori.destroy', ['id' => $k->id_kategori]) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus kategori ini? Pengaduan yang memakainya akan jadi tanpa kategori.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">{!! $data->links() !!}</div>
    </div>
</div>
@endsection