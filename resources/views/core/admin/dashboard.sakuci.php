@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
@php
    // Ikon gaya garis
    $ikon = [
        'pengaduan' => '<path d="M21 12a8 8 0 0 1-11.7 7.1L3 21l1.9-5.3A8 8 0 1 1 21 12z"/>',
        'alat'      => '<path d="M14.7 6.3a4 4 0 0 0-5.4 5.4L3 18l3 3 6.3-6.3a4 4 0 0 0 5.4-5.4l-2.6 2.6-2.4-.6-.6-2.4z"/>',
        'kategori'  => '<path d="M20 12l-8 8-9-9V3h8z"/><circle cx="7.5" cy="7.5" r="1.2"/>',
        'pengguna'  => '<circle cx="9" cy="8" r="3.2"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><path d="M16 5.2a3 3 0 0 1 0 5.6"/><path d="M18 14.3c1.8.8 3 2.6 3 4.7"/>',
        'role'      => '<path d="M12 3l8 3v6c0 4.5-3.2 8.2-8 9-4.8-.8-8-4.5-8-9V6z"/><path d="M9 12l2 2 4-4"/>',
        'user'      => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        'db'        => '<ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>',
    ];

    // Menu pengelolaan data
    $menuUtama = [
        ['judul' => 'Pengaduan',        'desk' => 'Lihat, proses, dan tanggapi laporan kerusakan dari jamaah.', 'rute' => 'pengaduan.index', 'ikon' => $ikon['pengaduan'], 'warna' => '#10b981', 'panah' => '→'],
        ['judul' => 'Alat & Fasilitas', 'desk' => 'Kelola data alat dan fasilitas yang ada di masjid.',          'rute' => 'alat.index',      'ikon' => $ikon['alat'],      'warna' => '#f59e0b', 'panah' => '→'],
        ['judul' => 'Kategori',         'desk' => 'Atur kategori agar laporan pengaduan lebih tertata.',        'rute' => 'kategori.index',  'ikon' => $ikon['kategori'],  'warna' => '#0ea5e9', 'panah' => '→'],
        ['judul' => 'Pengguna',         'desk' => 'Kelola data pengguna yang memakai aplikasi ini.',            'rute' => 'pengguna.index',  'ikon' => $ikon['pengguna'],  'warna' => '#8b5cf6', 'panah' => '→'],
    ];

    // Menu sistem
    $menuSistem = [
        ['judul' => 'Manage Role',     'desk' => 'Atur dan tambah hak akses peran baru untuk sistem.',      'rute' => 'admin.roles.index',     'ikon' => $ikon['role'], 'warna' => '#14b8a6', 'panah' => '→'],
        ['judul' => 'Manage User',     'desk' => 'Kelola akun, tambah user, dan tentukan perannya.',        'rute' => 'admin.users.index',     'ikon' => $ikon['user'], 'warna' => '#ec4899', 'panah' => '→'],
        ['judul' => 'Backup Database', 'desk' => 'Unduh cadangan data server dalam format .sql.',           'rute' => 'admin.database.export', 'ikon' => $ikon['db'],   'warna' => '#6366f1', 'panah' => '↓'],
    ];
@endphp

<style>
    /* ===== Dashboard Admin: warna mengikuti tema terang/gelap ===== */

    /* Hero */
    .dash-hero {
        position: relative;
        overflow: hidden;
        color: #fff;
        background: linear-gradient(135deg, #0d3b2e 0%, #155e48 55%, #1b7a5c 100%);
        border: 1px solid rgba(212, 175, 55, .25);
        border-radius: clamp(16px, 3vw, 26px);
        padding: clamp(1.25rem, 4vw, 2.5rem);
        box-shadow: 0 .75rem 2rem rgba(13, 59, 46, .25);
    }
    .dash-hero::before {
        content: '';
        position: absolute; right: -60px; top: -60px;
        width: 240px; height: 240px; border-radius: 50%;
        background: radial-gradient(circle, rgba(212, 175, 55, .28) 0%, rgba(212, 175, 55, 0) 70%);
        pointer-events: none;
    }
    .dash-hero::after {
        content: '';
        position: absolute; left: -50px; bottom: -80px;
        width: 220px; height: 220px; border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 255, 255, .10) 0%, rgba(255, 255, 255, 0) 70%);
        pointer-events: none;
    }
    .dash-hero > * { position: relative; z-index: 1; }

    .dash-badge {
        display: inline-flex; align-items: center; gap: .5rem;
        padding: .4rem .9rem; border-radius: 999px;
        font-size: .78rem; font-weight: 600;
        color: #fcd34d;
        background: rgba(212, 175, 55, .18);
        border: 1px solid rgba(212, 175, 55, .4);
    }
    .dash-hero h1 {
        font-weight: 800; line-height: 1.2;
        font-size: clamp(1.4rem, 4.5vw, 2.1rem);
        margin: .9rem 0 .5rem;
    }
    .dash-hero p {
        margin: 0; color: rgba(255, 255, 255, .78);
        font-size: clamp(.9rem, 2.2vw, 1.05rem);
        max-width: 640px;
    }
    .dash-mosque {
        font-size: clamp(64px, 9vw, 110px);
        line-height: 1;
        filter: drop-shadow(0 .5rem 1rem rgba(0, 0, 0, .3));
    }

    .btn-gold {
        background: #d4af37; color: #1f2d27; border: 0; font-weight: 700;
    }
    .btn-gold:hover { background: #e3c04e; color: #1f2d27; }
    .btn-glass {
        background: rgba(255, 255, 255, .12); color: #fff; font-weight: 600;
        border: 1px solid rgba(255, 255, 255, .3);
    }
    .btn-glass:hover { background: rgba(255, 255, 255, .22); color: #fff; }

    /* Judul bagian */
    .dash-section {
        display: flex; align-items: center; gap: .6rem;
        margin: 2rem 0 1rem;
        font-size: .78rem; font-weight: 800;
        letter-spacing: .1em; text-transform: uppercase;
        color: var(--bs-secondary-color);
    }
    .dash-section::before {
        content: ''; width: 4px; height: 18px; border-radius: 4px;
        background: #d4af37;
    }

    /* Kartu menu */
    .dash-card {
        --accent: #10b981;
        position: relative; overflow: hidden;
        display: flex; align-items: flex-start; gap: 1rem;
        height: 100%;
        padding: 1.15rem;
        color: var(--bs-body-color);
        background: var(--bs-body-bg);
        border: 1px solid var(--bs-border-color);
        border-radius: 18px;
        text-decoration: none;
        box-shadow: 0 .125rem .4rem rgba(0, 0, 0, .04);
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
        animation: dash-masuk .5s ease both;
    }
    .dash-card::before {
        content: ''; position: absolute; left: 0; right: 0; top: 0; height: 3px;
        background: var(--accent);
        transform: scaleX(0); transform-origin: left;
        transition: transform .3s ease;
    }
    .dash-card:hover {
        color: var(--bs-body-color);
        transform: translateY(-4px);
        border-color: var(--accent);
        box-shadow: 0 .9rem 1.8rem color-mix(in srgb, var(--accent) 22%, transparent);
    }
    .dash-card:hover::before { transform: scaleX(1); }

    .dash-icon {
        flex: 0 0 52px; width: 52px; height: 52px;
        display: grid; place-items: center;
        border-radius: 14px;
        color: var(--accent);
        background: color-mix(in srgb, var(--accent) 14%, transparent);
        transition: background-color .25s ease, color .25s ease, transform .25s ease;
    }
    .dash-icon svg {
        width: 26px; height: 26px; fill: none; stroke: currentColor;
        stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round;
    }
    .dash-card:hover .dash-icon { background: var(--accent); color: #fff; transform: rotate(-6deg) scale(1.05); }

    .dash-body { flex: 1 1 auto; min-width: 0; }
    .dash-title { font-weight: 700; font-size: 1.02rem; margin: 0 0 .25rem; }
    .dash-desc { margin: 0; font-size: .86rem; line-height: 1.45; color: var(--bs-secondary-color); }
    .dash-arrow {
        flex: 0 0 auto; font-size: 1.1rem; line-height: 1;
        color: var(--bs-secondary-color);
        transition: transform .25s ease, color .25s ease;
    }
    .dash-card:hover .dash-arrow { transform: translateX(4px); color: var(--accent); }

    /* Animasi masuk bertahap */
    @keyframes dash-masuk {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .row > .col:nth-child(1) .dash-card { animation-delay: .05s; }
    .row > .col:nth-child(2) .dash-card { animation-delay: .12s; }
    .row > .col:nth-child(3) .dash-card { animation-delay: .19s; }
    .row > .col:nth-child(4) .dash-card { animation-delay: .26s; }

    @media (prefers-reduced-motion: reduce) {
        .dash-card, .dash-card:hover { animation: none; transition: none; transform: none; }
    }

    /* Mode gelap: bayangan lebih halus, kartu sedikit terangkat dari latar */
    [data-bs-theme="dark"] .dash-card {
        background: var(--bs-tertiary-bg);
        box-shadow: none;
    }
    [data-bs-theme="dark"] .dash-hero {
        box-shadow: 0 .75rem 2rem rgba(0, 0, 0, .45);
    }
</style>

<div class="container-fluid px-0">

    {{-- Hero --}}
    <div class="dash-hero mb-2">
        <div class="row align-items-center g-3">
            <div class="col-md-9 col-lg-8">
                <span class="dash-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3l8 3v6c0 4.5-3.2 8.2-8 9-4.8-.8-8-4.5-8-9V6z"/></svg>
                    Panel Administrator Masjid
                </span>

                <h1>Assalamu’alaikum, {{ $user->username }} 👋</h1>
                <p>Selamat datang di pusat pengelolaan sarana, prasarana, serta manajemen sistem informasi masjid.</p>

                <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-gold rounded-pill px-4">
                        Lihat Pengaduan
                    </a>
                    <a href="{{ route('pengaduan.create') }}" class="btn btn-glass rounded-pill px-4">
                        + Buat Pengaduan
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-lg-4 d-none d-md-block text-end">
                <div class="dash-mosque" aria-hidden="true">🕌</div>
            </div>
        </div>
    </div>

    {{-- Menu pengelolaan data --}}
    <div class="dash-section">Pengelolaan Data</div>

    <div class="row g-3 g-lg-4 row-cols-1 row-cols-md-2 row-cols-xxl-4">
        @foreach ($menuUtama as $m)
            <div class="col">
                <a href="{{ route($m['rute']) }}" class="dash-card" style="--accent: {{ $m['warna'] }};">
                    <span class="dash-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true">{!! $m['ikon'] !!}</svg>
                    </span>
                    <span class="dash-body">
                        <h2 class="dash-title">{{ $m['judul'] }}</h2>
                        <p class="dash-desc">{{ $m['desk'] }}</p>
                    </span>
                    <span class="dash-arrow" aria-hidden="true">{{ $m['panah'] }}</span>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Menu sistem --}}
    <div class="dash-section">Pengelolaan Sistem</div>

    <div class="row g-3 g-lg-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
        @foreach ($menuSistem as $m)
            <div class="col">
                <a href="{{ route($m['rute']) }}" class="dash-card" style="--accent: {{ $m['warna'] }};">
                    <span class="dash-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true">{!! $m['ikon'] !!}</svg>
                    </span>
                    <span class="dash-body">
                        <h2 class="dash-title">{{ $m['judul'] }}</h2>
                        <p class="dash-desc">{{ $m['desk'] }}</p>
                    </span>
                    <span class="dash-arrow" aria-hidden="true">{{ $m['panah'] }}</span>
                </a>
            </div>
        @endforeach
    </div>

</div>
@endsection