@extends('layouts.app')

@section('title', config('app.name') . ' -- Pengaduan Sarana & Prasarana Masjid')

@section('content')
@php
    $wUser = \App\Models\User::current();
    $wRole = $wUser ? $wUser->role : null;
    $wDashboard = $wRole === 'admin' ? route('admin.dashboard') : ($wRole === 'siswa' ? route('siswa.dashboard') : null);

    $fitur = [
        ['ikon' => '📝', 'judul' => 'Pengaduan Mudah',    'desk' => 'Sampaikan laporan kerusakan fasilitas masjid dengan cepat, lengkap dengan kategori, lokasi, dan foto.', 'warna' => '#10b981'],
        ['ikon' => '⚙️', 'judul' => 'Diproses Admin',     'desk' => 'Setiap pengaduan dikelola dan ditindaklanjuti oleh admin masjid secara terorganisir.',                'warna' => '#f59e0b'],
        ['ikon' => '✅', 'judul' => 'Status Transparan',  'desk' => 'Pantau perkembangan pengaduan dari menunggu, diproses, sampai selesai ditangani.',                    'warna' => '#0ea5e9'],
    ];

    $langkah = [
        ['no' => '1', 'judul' => 'Login',     'desk' => 'Masuk atau daftar akun terlebih dahulu.'],
        ['no' => '2', 'judul' => 'Laporkan',  'desk' => 'Isi judul, kategori, lokasi, dan foto kerusakan.'],
        ['no' => '3', 'judul' => 'Diproses',  'desk' => 'Admin memeriksa dan menindaklanjuti laporanmu.'],
        ['no' => '4', 'judul' => 'Selesai',   'desk' => 'Pantau statusnya sampai masalah teratasi.'],
    ];
@endphp

<style>
    /* ===== Welcome: warna mengikuti tema terang/gelap ===== */
    .wl { max-width: 1100px; margin: 0 auto; }

    /* Hero */
    .wl-hero {
        position: relative; overflow: hidden; text-align: center; color: #fff;
        background: linear-gradient(135deg, #064e3b 0%, #047857 60%, #0d9668 100%);
        border: 1px solid rgba(250, 204, 21, .25);
        border-radius: clamp(20px, 4vw, 40px);
        padding: clamp(2rem, 7vw, 4.5rem) clamp(1rem, 4vw, 2.5rem);
        box-shadow: 0 1rem 2.5rem rgba(6, 78, 59, .3);
    }
    .wl-hero::before {
        content: ''; position: absolute; right: -70px; top: -70px;
        width: 280px; height: 280px; border-radius: 50%;
        background: radial-gradient(circle, rgba(250, 204, 21, .3) 0%, rgba(250, 204, 21, 0) 70%);
        pointer-events: none;
    }
    .wl-hero::after {
        content: ''; position: absolute; left: -60px; bottom: -90px;
        width: 260px; height: 260px; border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 255, 255, .12) 0%, rgba(255, 255, 255, 0) 70%);
        pointer-events: none;
    }
    .wl-hero > * { position: relative; z-index: 1; }

    .wl-mosque {
        font-size: clamp(56px, 12vw, 84px); line-height: 1;
        display: inline-block;
        filter: drop-shadow(0 .5rem 1rem rgba(0, 0, 0, .3));
        animation: wl-melayang 4s ease-in-out infinite;
    }
    .wl-badge {
        display: inline-flex; align-items: center; gap: .5rem;
        padding: .4rem .9rem; border-radius: 999px; margin-bottom: 1rem;
        font-size: .78rem; font-weight: 600; color: #fde68a;
        background: rgba(250, 204, 21, .15);
        border: 1px solid rgba(250, 204, 21, .4);
    }
    .wl-hero h1 {
        font-weight: 800; line-height: 1.15;
        font-size: clamp(1.7rem, 5.5vw, 3.2rem);
        margin: 0 0 1rem;
    }
    .wl-hero h1 span { color: #facc15; }
    .wl-hero .wl-lead {
        max-width: 640px; margin: 0 auto 1.75rem;
        color: #d1fae5; font-size: clamp(1rem, 2.4vw, 1.2rem);
    }

    .wl-btn-gold {
        background: #facc15; color: #064e3b; border: 0; font-weight: 700;
        box-shadow: 0 .5rem 1.2rem rgba(250, 204, 21, .3);
        transition: transform .2s ease, box-shadow .2s ease, background-color .2s ease;
    }
    .wl-btn-gold:hover { background: #fde047; color: #064e3b; transform: translateY(-2px); }
    .wl-btn-glass {
        background: rgba(255, 255, 255, .12); color: #fff; font-weight: 600;
        border: 1px solid rgba(255, 255, 255, .35);
        transition: background-color .2s ease, transform .2s ease;
    }
    .wl-btn-glass:hover { background: rgba(255, 255, 255, .22); color: #fff; transform: translateY(-2px); }

    .wl-points {
        display: flex; flex-wrap: wrap; justify-content: center; gap: .5rem 1.25rem;
        margin: 1.75rem 0 0; padding: 0; list-style: none;
        font-size: .88rem; color: #bbf7d0;
    }
    .wl-points li::before { content: '✔'; margin-right: .4rem; color: #facc15; }

    /* Judul bagian */
    .wl-title { text-align: center; margin: clamp(2.5rem, 7vw, 4rem) 0 1.5rem; }
    .wl-title small {
        display: block; margin-bottom: .4rem;
        font-size: .75rem; font-weight: 800; letter-spacing: .12em; text-transform: uppercase;
        color: #d4a90f;
    }
    .wl-title h2 {
        margin: 0 0 .5rem; font-weight: 800; color: var(--bs-emphasis-color);
        font-size: clamp(1.4rem, 4vw, 2.1rem);
    }
    .wl-title p { margin: 0 auto; max-width: 560px; color: var(--bs-secondary-color); }
    .wl-title .garis {
        width: 70px; height: 4px; border-radius: 10px; background: #facc15; margin: .9rem auto 0;
    }

    /* Tentang */
    .wl-about-art {
        height: 100%; text-align: center;
        padding: clamp(1.5rem, 5vw, 3rem);
        border-radius: 24px;
        background: linear-gradient(160deg, rgba(16, 185, 129, .14), rgba(250, 204, 21, .10));
        border: 1px solid rgba(16, 185, 129, .25);
    }
    .wl-about-art .emoji { font-size: clamp(64px, 14vw, 100px); line-height: 1; }
    .wl-about-art h3 { font-weight: 800; color: #10b981; margin: 1rem 0 .5rem; font-size: clamp(1.2rem, 3.5vw, 1.5rem); }
    .wl-about-art p { margin: 0; color: var(--bs-secondary-color); }

    .wl-card {
        background: var(--bs-body-bg); color: var(--bs-body-color);
        border: 1px solid var(--bs-border-color); border-radius: 24px;
        box-shadow: 0 .125rem .5rem rgba(0, 0, 0, .05);
    }
    .wl-about-card { padding: clamp(1.25rem, 4vw, 2.5rem); height: 100%; }
    .wl-about-card h2 {
        font-weight: 800; margin: 0 0 .75rem; color: var(--bs-emphasis-color);
        font-size: clamp(1.4rem, 4vw, 2rem);
    }
    .wl-about-card p { color: var(--bs-secondary-color); }
    .wl-about-card p:last-child { margin-bottom: 0; }

    /* Fitur */
    .wl-fitur {
        --accent: #10b981;
        position: relative; overflow: hidden; height: 100%; text-align: center;
        padding: 1.75rem 1.25rem;
        background: var(--bs-body-bg);
        border: 1px solid var(--bs-border-color); border-radius: 22px;
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .wl-fitur::before {
        content: ''; position: absolute; left: 0; right: 0; top: 0; height: 4px;
        background: var(--accent);
    }
    .wl-fitur:hover {
        transform: translateY(-5px); border-color: var(--accent);
        box-shadow: 0 1rem 2rem color-mix(in srgb, var(--accent) 22%, transparent);
    }
    .wl-fitur .ikon {
        width: 68px; height: 68px; margin: 0 auto 1rem;
        display: grid; place-items: center; font-size: 34px;
        border-radius: 20px;
        background: color-mix(in srgb, var(--accent) 15%, transparent);
        transition: transform .25s ease;
    }
    .wl-fitur:hover .ikon { transform: rotate(-6deg) scale(1.08); }
    .wl-fitur h3 { font-size: 1.1rem; font-weight: 700; margin: 0 0 .5rem; color: var(--bs-emphasis-color); }
    .wl-fitur p { margin: 0; font-size: .92rem; color: var(--bs-secondary-color); }

    /* Alur */
    .wl-langkah {
        position: relative; height: 100%; text-align: center;
        padding: 1.5rem 1rem;
        background: var(--bs-body-bg);
        border: 1px solid var(--bs-border-color); border-radius: 20px;
    }
    .wl-langkah .no {
        width: 46px; height: 46px; margin: 0 auto .85rem;
        display: grid; place-items: center;
        border-radius: 50%; font-weight: 800; font-size: 1.15rem;
        color: #064e3b; background: #facc15;
        box-shadow: 0 .4rem 1rem rgba(250, 204, 21, .35);
    }
    .wl-langkah h3 { font-size: 1.02rem; font-weight: 700; margin: 0 0 .35rem; color: var(--bs-emphasis-color); }
    .wl-langkah p { margin: 0; font-size: .88rem; color: var(--bs-secondary-color); }

    /* Ajakan bawah */
    .wl-cta {
        position: relative; overflow: hidden; text-align: center; color: #fff;
        margin: clamp(2.5rem, 7vw, 4rem) 0 .5rem;
        padding: clamp(1.75rem, 5vw, 3rem) 1.25rem;
        background: linear-gradient(135deg, #064e3b, #047857);
        border: 1px solid rgba(250, 204, 21, .25);
        border-radius: clamp(20px, 4vw, 32px);
    }
    .wl-cta h2 { font-weight: 800; font-size: clamp(1.3rem, 4vw, 1.9rem); margin: 0 0 .5rem; }
    .wl-cta p { color: #d1fae5; margin: 0 auto 1.25rem; max-width: 520px; }

    /* Animasi */
    @keyframes wl-melayang {
        0%, 100% { transform: translateY(0); }
        50%      { transform: translateY(-8px); }
    }
    @keyframes wl-masuk {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .wl-hero > *, .wl-fitur, .wl-langkah { animation: wl-masuk .6s ease both; }
    .wl-hero > *:nth-child(2) { animation-delay: .08s; }
    .wl-hero > *:nth-child(3) { animation-delay: .16s; }
    .wl-hero > *:nth-child(4) { animation-delay: .24s; }
    .wl-hero > *:nth-child(5) { animation-delay: .32s; }
    .wl-hero > *:nth-child(6) { animation-delay: .4s; }

    @media (prefers-reduced-motion: reduce) {
        .wl-mosque, .wl-hero > *, .wl-fitur, .wl-langkah { animation: none; }
        .wl-fitur, .wl-btn-gold, .wl-btn-glass { transition: none; }
    }

    /* Mode gelap */
    [data-bs-theme="dark"] .wl-card,
    [data-bs-theme="dark"] .wl-fitur,
    [data-bs-theme="dark"] .wl-langkah { background: var(--bs-tertiary-bg); box-shadow: none; }
    [data-bs-theme="dark"] .wl-hero,
    [data-bs-theme="dark"] .wl-cta { box-shadow: 0 1rem 2.5rem rgba(0, 0, 0, .45); }
    [data-bs-theme="dark"] .wl-title small { color: #facc15; }
    [data-bs-theme="dark"] .wl-about-art h3 { color: #34d399; }
</style>

<div class="wl">

    {{-- Hero --}}
    <section class="wl-hero">
        <div class="wl-mosque" aria-hidden="true">🕌</div>

        <div><span class="wl-badge">Layanan Aduan Jamaah</span></div>

        <h1>
            Pengaduan Sarana & Prasarana
            <br>
            <span>Masjid</span>
        </h1>

        <p class="wl-lead">
            Laporkan kerusakan atau permasalahan fasilitas masjid
            dengan mudah, cepat, dan terorganisir.
        </p>

        <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
            @if ($wDashboard)
                <a class="btn btn-lg rounded-pill px-4 wl-btn-gold" href="{{ $wDashboard }}">
                    🏠 Ke Dashboard
                </a>
            @else
                <a class="btn btn-lg rounded-pill px-4 wl-btn-gold" href="{{ route('login') }}">
                    🔐 Login untuk Membuat Pengaduan
                </a>
            @endif

            <a class="btn btn-lg rounded-pill px-4 wl-btn-glass" href="#fitur">
                Pelajari Fitur ↓
            </a>
        </div>

        <ul class="wl-points">
            <li>Mudah digunakan</li>
            <li>Dipantau admin</li>
            <li>Status transparan</li>
        </ul>
    </section>


    {{-- Tentang Aplikasi --}}
    <div class="wl-title">
        <small>Tentang</small>
        <h2>Mengenal Aplikasi</h2>
        <div class="garis"></div>
    </div>

    <section>
        <div class="row g-4 align-items-stretch">

            <div class="col-lg-5">
                <div class="wl-about-art">
                    <div class="emoji" aria-hidden="true">🕌</div>
                    <h3>Masjid Bersih & Nyaman</h3>
                    <p>
                        Bersama menjaga dan merawat fasilitas masjid
                        agar tetap nyaman digunakan oleh jamaah.
                    </p>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="wl-card wl-about-card">
                    <h2>🕌 Tentang Aplikasi</h2>

                    <p>
                        Pengaduan Sarana & Prasarana Masjid merupakan
                        aplikasi yang digunakan untuk memudahkan jamaah
                        dalam melaporkan kerusakan atau permasalahan
                        pada fasilitas masjid.
                    </p>

                    <p>
                        Melalui aplikasi ini, pengguna dapat menyampaikan
                        pengaduan dengan informasi yang jelas. Admin dapat
                        mengelola, memproses, dan memperbarui status
                        pengaduan hingga selesai.
                    </p>

                    <p>
                        Dengan adanya aplikasi ini, proses pelaporan
                        sarana dan prasarana masjid menjadi lebih mudah,
                        terorganisir, dan transparan sehingga fasilitas
                        masjid dapat dirawat dengan lebih baik.
                    </p>
                </div>
            </div>

        </div>
    </section>


    {{-- Fitur --}}
    <div class="wl-title" id="fitur">
        <small>Keunggulan</small>
        <h2>Fitur Pengaduan</h2>
        <p>Membantu pengelolaan fasilitas masjid dengan lebih mudah.</p>
        <div class="garis"></div>
    </div>

    <section>
        <div class="row g-3 g-lg-4 row-cols-1 row-cols-md-3">
            @foreach ($fitur as $f)
                <div class="col">
                    <div class="wl-fitur" style="--accent: {{ $f['warna'] }};">
                        <div class="ikon" aria-hidden="true">{{ $f['ikon'] }}</div>
                        <h3>{{ $f['judul'] }}</h3>
                        <p>{{ $f['desk'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>


    {{-- Alur --}}
    <div class="wl-title">
        <small>Cara Kerja</small>
        <h2>Alur Pengaduan</h2>
        <p>Empat langkah sederhana dari laporan sampai selesai.</p>
        <div class="garis"></div>
    </div>

    <section>
        <div class="row g-3 g-lg-4 row-cols-1 row-cols-sm-2 row-cols-lg-4">
            @foreach ($langkah as $l)
                <div class="col">
                    <div class="wl-langkah">
                        <div class="no">{{ $l['no'] }}</div>
                        <h3>{{ $l['judul'] }}</h3>
                        <p>{{ $l['desk'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>


    {{-- Ajakan bawah --}}
    <section class="wl-cta">
        <h2>Ada fasilitas masjid yang rusak?</h2>
        <p>Laporkan sekarang agar segera ditangani dan masjid tetap nyaman untuk semua jamaah.</p>

        @if ($wDashboard)
            <a class="btn btn-lg rounded-pill px-4 wl-btn-gold" href="{{ $wDashboard }}">Ke Dashboard</a>
        @else
            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                <a class="btn btn-lg rounded-pill px-4 wl-btn-gold" href="{{ route('login') }}">Login</a>
                <a class="btn btn-lg rounded-pill px-4 wl-btn-glass" href="{{ route('register') }}">Daftar Akun</a>
            </div>
        @endif
    </section>

</div>
@endsection