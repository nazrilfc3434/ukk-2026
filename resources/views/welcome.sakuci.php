@extends('layouts.app')

@section('title', config('app.name') . ' -- Kerangka PHP Ringan')

@section('content')

    {{-- Hero --}}
    <section class="text-center py-4 py-lg-5">

        <h1 class="display-5 fw-bold mb-3">
            Pengaduan Sarana & Prasarana,<br class="d-none d-md-inline">
            <span class="text-brand">masjid</span>
        </h1>

        <p class="lead text-secondary mx-auto mb-4" style="max-width: 620px;">
            "Laporkan kerusakan atau permasalahan
   fasilitas sekolah dengan mudah dan cepat."
        </p>

        <div class="d-flex flex-wrap gap-2 justify-content-center">
            <a class="btn btn-brand btn-lg px-4" href="{{ route('login') }}">Login untuk Membuat Pengaduan</a>
            <a class="btn btn-brand btn-lg px-4" href="{{ route('kategori.index') }}">Katergori</a>
        </div>
    </section>

    {{-- Instalasi --}}
    <section class="row g-4 align-items-start mb-5">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
                <Aplikasi class="card-body p-4">
                    <h2 class="h5 fw-semibold mb-3">ℹ️ Tentang Aplikasi</h2>

                    <p>Pengaduan Sarana & Prasarana Sekolah merupakan aplikasi yang digunakan untuk memudahkan siswa dalam melaporkan kerusakan atau permasalahan pada fasilitas sekolah. Melalui aplikasi ini, siswa dapat menyampaikan pengaduan dengan informasi yang jelas, sementara admin dapat mengelola, memproses, dan memperbarui status pengaduan hingga selesai.</p>
                      
<p>Aplikasi ini bertujuan untuk membuat proses pelaporan sarana dan prasarana menjadi lebih mudah, terorganisir, dan transparan, sehingga permasalahan fasilitas sekolah dapat ditangani dengan lebih baik.</p>
                </div>
            </div>
        </div>
    </section>

@endsection