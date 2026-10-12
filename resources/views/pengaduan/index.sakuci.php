@extends('layouts.app')
@section('content')

<style>
    .table-pengaduan th { font-size: .85rem; font-weight: 600; white-space: nowrap; padding: .85rem 1rem; }
    .table-pengaduan td { padding: .9rem 1rem; vertical-align: middle; }
    .table-pengaduan .isi { max-width: 260px; color: var(--bs-secondary-color); }
    .table-pengaduan .thumb { width: 48px; height: 48px; object-fit: cover; border-radius: 8px; }
    .table-pengaduan .badge { font-weight: 600; padding: .4em .85em; }
</style>

<div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-3">
    <div>
        <h3 class="mb-0">Pengaduan Saya</h3>
        <small class="text-secondary">Laporan yang pernah kamu kirim beserta statusnya.</small>
    </div>
    <a href="{{ route('siswa.pengaduan.create') }}" class="btn btn-primary">+ Buat pengaduan</a>
</div>

<div class="card">
    <div class="card-header d-flex gap-2 flex-wrap">
        <input id="cari" type="search" class="form-control flex-grow-1" style="min-width:200px; flex-basis:240px"
               placeholder="Cari judul atau isi pengaduan" aria-label="Cari pengaduan">
        <select id="filterKategori" class="form-select" style="max-width:220px" aria-label="Filter kategori">
            <option value="">Semua kategori</option>
            @foreach ($kategori as $nama)
                <option>{{ $nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-pengaduan align-middle mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Isi</th>
                    <th>Lokasi</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($data as $p)
                <tr>
                    <td class="text-secondary">{{ $no++ }}</td>
                    <td class="fw-semibold">{{ $p->judul }}</td>
                    <td>
                        @if (!empty($p->id_kategori) && isset($kategori[$p->id_kategori]))
                            <span class="badge rounded-pill bg-primary-subtle text-primary-emphasis">{{ $kategori[$p->id_kategori] }}</span>
                        @else
                            <span class="text-secondary">-</span>
                        @endif
                    </td>
                    <td class="isi">{{ mb_strimwidth($p->isi, 0, 60, '...') }}</td>
                    <td class="text-secondary">{{ $p->lokasi ?: '-' }}</td>
                    <td>
                        @if ($p->foto)
                            <img src="/uploads/pengaduan/{{ $p->foto }}" class="thumb" alt="Foto pengaduan">
                        @else
                            <span class="text-secondary">-</span>
                        @endif
                    </td>
                    <td>
                        @if(in_array($p->status, ['0', 'pending', 'menunggu']))
                            <span class="badge rounded-pill bg-secondary-subtle text-secondary-emphasis">Menunggu</span>
                        @elseif($p->status == 'proses')
                            <span class="badge rounded-pill bg-info-subtle text-info-emphasis">Proses</span>
                        @elseif($p->status == 'selesai')
                            <span class="badge rounded-pill bg-success-subtle text-success-emphasis">Selesai</span>
                        @else
                            <span class="badge rounded-pill bg-secondary-subtle text-secondary-emphasis">{{ $p->status }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('siswa.pengaduan.show', ['id' => $p->id_pengaduan]) }}" class="btn btn-primary btn-sm">Lihat</a>
                    </td>
                </tr>
                @endforeach

                @if ($no === 1)
                <tr>
                    <td colspan="8" class="text-center text-secondary py-4">Kamu belum pernah mengirim pengaduan.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center flex-wrap gap-2">
        <small class="text-secondary">Menampilkan {{ $data->count() }} pengaduan</small>
        {!! $data->links() !!}
    </div>
</div>
@endsection

@section('scripts')
<script>
    const cari = document.getElementById('cari');
    const filter = document.getElementById('filterKategori');

    function terapkan() {
        const k = cari.value.toLowerCase();
        const kat = filter.value.toLowerCase();
        document.querySelectorAll('.table-pengaduan tbody tr').forEach(function (tr) {
            const teks = tr.innerText.toLowerCase();
            tr.style.display = teks.includes(k) && (!kat || teks.includes(kat)) ? '' : 'none';
        });
    }
    cari.addEventListener('input', terapkan);
    filter.addEventListener('change', terapkan);
</script>
@endsection