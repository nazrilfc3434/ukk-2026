@extends('layouts.app')
@section('content')

<div class="mx-auto" style="max-width: 860px;">
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-3">
        <div>
            <h3 class="mb-0">Detail Pengaduan</h3>
            <small class="text-secondary">Pantau status dan tanggapan untuk laporanmu.</small>
        </div>
        <a href="{{ route('siswa.pengaduan.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                <h4 class="mb-0">{{ $pengaduan->judul }}</h4>
                @if(in_array($pengaduan->status, ['0', 'pending', 'menunggu']))
                    <span class="badge rounded-pill bg-secondary-subtle text-secondary-emphasis">Menunggu</span>
                @elseif($pengaduan->status == 'proses')
                    <span class="badge rounded-pill bg-info-subtle text-info-emphasis">Proses</span>
                @elseif($pengaduan->status == 'selesai')
                    <span class="badge rounded-pill bg-success-subtle text-success-emphasis">Selesai</span>
                @endif
            </div>

            <p class="text-secondary mb-1">Lokasi</p>
            <p>{{ $pengaduan->lokasi ?: '-' }}</p>

            <p class="text-secondary mb-1">Isi pengaduan</p>
            <p style="white-space: pre-line;">{{ $pengaduan->isi }}</p>

            @if ($pengaduan->foto)
                <p class="text-secondary mb-1">Foto</p>
                <img src="/uploads/pengaduan/{{ $pengaduan->foto }}" alt="Foto pengaduan"
                     class="img-fluid rounded border" style="max-height: 320px;">
            @endif
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h5 class="mb-3">Tanggapan</h5>
            @if (!empty($pengaduan->tanggapan))
                <p style="white-space: pre-line;" class="mb-0">{{ $pengaduan->tanggapan }}</p>
            @else
                <p class="text-secondary mb-0">Belum ada tanggapan dari admin.</p>
            @endif
        </div>
    </div>
</div>
@endsection