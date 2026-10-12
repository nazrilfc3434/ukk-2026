@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-3">
    <div>
        <h3 class="mb-0">Data Siswa</h3>
        <small class="text-secondary">Setiap siswa otomatis punya akun untuk login.</small>
    </div>
    <a href="{{ route('pengguna.create') }}" class="btn btn-brand">+ Tambah siswa</a>
</div>

<div class="card">
    <div class="card-header">
        <input id="cari" type="search" class="form-control" placeholder="Cari nama, NIS, atau kelas" aria-label="Cari siswa">
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-pengaduan align-middle mb-0" id="tabelSiswa">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Username login</th>
                    <th width="170">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @forelse ($data as $p)
                <tr>
                    <td class="text-secondary">{{ $no++ }}</td>
                    <td class="text-secondary">{{ $p->nis }}</td>
                    <td class="fw-semibold">{{ $p->nama }}</td>
                    <td><span class="badge rounded-pill bg-body-secondary text-body">{{ $p->kelas }}</span></td>
                    <td class="text-secondary">{{ $p->username ?: '-' }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('pengguna.edit', ['pengguna' => $p->id_siswa]) }}"
                               class="btn btn-outline-secondary btn-sm">Edit</a>
                            <form action="{{ route('pengguna.destroy', ['pengguna' => $p->id_siswa]) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('Hapus siswa ini beserta akunnya?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-secondary py-5">
                        Belum ada siswa. Klik "Tambah siswa" untuk memulai.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center flex-wrap gap-2">
        <small class="text-secondary">Menampilkan {{ $data->count() }} siswa</small>
        {!! $data->links() !!}
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('cari').addEventListener('input', function () {
        const k = this.value.toLowerCase();
        document.querySelectorAll('#tabelSiswa tbody tr').forEach(function (tr) {
            tr.style.display = tr.innerText.toLowerCase().includes(k) ? '' : 'none';
        });
    });
</script>
@endsection