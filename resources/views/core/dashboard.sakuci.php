@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@if ($user->role === 'siswa')

@php
    $jam  = (int) date('H');
    $sapa = $jam < 11 ? 'Selamat pagi' : ($jam < 15 ? 'Selamat siang' : ($jam < 18 ? 'Selamat sore' : 'Selamat malam'));
@endphp

<style>
    .dash-hero {
        border: 0;
        border-radius: 1.25rem;
        color: #fff;
        background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-info) 100%);
        position: relative;
        overflow: hidden;
    }
    .dash-hero::after {
        content: "";
        position: absolute;
        width: 220px; height: 220px;
        right: -60px; top: -80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .15);
    }
    .dash-hero::before {
        content: "";
        position: absolute;
        width: 140px; height: 140px;
        right: 90px; bottom: -70px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .10);
    }
    .dash-hero .hero-body { position: relative; z-index: 1; }
    .dash-hero .hero-chip {
        background: rgba(255, 255, 255, .22);
        color: #fff;
        font-weight: 600;
    }
    .dash-hero .btn-hero {
        background: #fff;
        color: var(--bs-primary);
        font-weight: 600;
        border: 0;
    }
    .dash-hero .btn-hero:hover { background: rgba(255, 255, 255, .88); }

    .dash-action {
        display: block;
        height: 100%;
        text-decoration: none;
        color: inherit;
        background: var(--bs-body-bg);
        border: 1px solid var(--bs-border-color);
        border-radius: 1rem;
        padding: 1.25rem;
        transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease;
    }
    .dash-action:hover {
        color: inherit;
        transform: translateY(-3px);
        border-color: var(--bs-primary);
        box-shadow: 0 .5rem 1.25rem rgba(var(--bs-primary-rgb), .18);
    }
    .dash-action .ikon {
        width: 52px; height: 52px;
        display: grid; place-items: center;
        font-size: 1.6rem;
        border-radius: .9rem;
        margin-bottom: .9rem;
    }
    .dash-action .panah {
        color: var(--bs-primary);
        font-weight: 600;
        font-size: .9rem;
    }

    .dash-step {
        display: flex;
        gap: .9rem;
        align-items: flex-start;
    }
    .dash-step .nomor {
        flex: 0 0 34px;
        width: 34px; height: 34px;
        display: grid; place-items: center;
        border-radius: 50%;
        font-weight: 700;
        background: var(--bs-primary-bg-subtle);
        color: var(--bs-primary-text-emphasis);
    }
    .dash-card {
        border: 1px solid var(--bs-border-color);
        border-radius: 1rem;
        background: var(--bs-body-bg);
    }

    @media (max-width: 575.98px) {
        .dash-hero::after, .dash-hero::before { display: none; }
    }
</style>

<div class="card dash-hero shadow-sm mb-4">
    <div class="card-body hero-body p-4 p-md-5">
        <span class="badge rounded-pill hero-chip px-3 py-2 mb-3">Siswa</span>
        <h1 class="h3 fw-bold mb-2">{{ $sapa }}, {{ $user->username }} 👋</h1>
        <p class="mb-4 opacity-75" style="max-width: 520px;">
            Ada masalah di sekolah? Laporkan di sini, pantau statusnya,
            dan lihat tanggapan dari admin kapan saja.
        </p>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('siswa.pengaduan.create') }}" class="btn btn-hero px-4">+ Buat pengaduan</a>
            <a href="{{ route('siswa.pengaduan.index') }}" class="btn btn-outline-light px-4">Pengaduan saya</a>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-12 col-md-4">
        <a href="{{ route('siswa.pengaduan.create') }}" class="dash-action">
            <div class="ikon bg-primary-subtle">📝</div>
            <h2 class="h6 fw-bold mb-1">Buat Pengaduan</h2>
            <p class="text-secondary small mb-3">Tulis laporan baru, lengkapi dengan lokasi dan foto bila perlu.</p>
            <span class="panah">Mulai melapor &rarr;</span>
        </a>
    </div>
    <div class="col-12 col-md-4">
        <a href="{{ route('siswa.pengaduan.index') }}" class="dash-action">
            <div class="ikon bg-success-subtle">📋</div>
            <h2 class="h6 fw-bold mb-1">Pengaduan Saya</h2>
            <p class="text-secondary small mb-3">Lihat riwayat laporan, status terbaru, dan tanggapan admin.</p>
            <span class="panah">Lihat riwayat &rarr;</span>
        </a>
    </div>
    <div class="col-12 col-md-4">
        <a href="{{ route('siswa.alat.index') }}" class="dash-action">
            <div class="ikon bg-warning-subtle">🛠️</div>
            <h2 class="h6 fw-bold mb-1">Alat &amp; Fasilitas</h2>
            <p class="text-secondary small mb-3">Cek daftar alat dan fasilitas sekolah beserta stoknya.</p>
            <span class="panah">Lihat daftar &rarr;</span>
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-7">
        <div class="dash-card p-4 h-100">
            <h2 class="h6 fw-bold mb-3">Cara membuat pengaduan</h2>
            <div class="d-flex flex-column gap-3">
                <div class="dash-step">
                    <div class="nomor">1</div>
                    <div>
                        <div class="fw-semibold">Tulis laporanmu</div>
                        <small class="text-secondary">Isi judul dan ceritakan masalahnya sejelas mungkin.</small>
                    </div>
                </div>
                <div class="dash-step">
                    <div class="nomor">2</div>
                    <div>
                        <div class="fw-semibold">Tambahkan lokasi dan foto</div>
                        <small class="text-secondary">Opsional, tapi membantu admin memahami masalahnya lebih cepat.</small>
                    </div>
                </div>
                <div class="dash-step">
                    <div class="nomor">3</div>
                    <div>
                        <div class="fw-semibold">Pantau statusnya</div>
                        <small class="text-secondary">Buka "Pengaduan Saya" untuk melihat perkembangan dan tanggapan.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-5">
        <div class="dash-card p-4 h-100">
            <h2 class="h6 fw-bold mb-3">Arti status pengaduan</h2>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center gap-3">
                    <span class="badge rounded-pill bg-secondary-subtle text-secondary-emphasis px-3 py-2" style="min-width: 88px;">Menunggu</span>
                    <small class="text-secondary">Laporan sudah masuk dan belum diproses.</small>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge rounded-pill bg-info-subtle text-info-emphasis px-3 py-2" style="min-width: 88px;">Proses</span>
                    <small class="text-secondary">Sedang ditangani oleh admin.</small>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge rounded-pill bg-success-subtle text-success-emphasis px-3 py-2" style="min-width: 88px;">Selesai</span>
                    <small class="text-secondary">Sudah ditindaklanjuti, cek tanggapannya.</small>
                </div>
            </div>
        </div>
    </div>
</div>

@else

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">Role: {{ $user->role }}</span>
            <h1 class="h4 mb-2">Halo, {{ $user->username }}</h1>
            <p class="text-secondary mb-0">Ini halaman dashboard umum, bisa diakses semua role yang sudah login.</p>
        </div>
    </div>

@endif

@endsection