@extends('layouts.app')

@section('title', config('app.name') . ' -- Pengaduan Sarana & Prasarana Masjid')

@section('content')

{{-- Hero --}}
<section class="py-5 text-center"
    style="background: linear-gradient(135deg, #064e3b, #047857); border-radius: 0 0 40px 40px; color: white;">

    <div class="container py-4">

        {{-- Icon Masjid --}}
        <div class="mb-3" style="font-size: 70px;">
            🕌
        </div>

        <h1 class="display-5 fw-bold mb-3">
            Pengaduan Sarana & Prasarana
            <br>
            <span style="color: #facc15;">Masjid</span>
        </h1>

        <p class="lead mx-auto mb-4"
            style="max-width: 650px; color: #d1fae5;">
            Laporkan kerusakan atau permasalahan fasilitas masjid
            dengan mudah, cepat, dan terorganisir.
        </p>

        <div class="d-flex flex-wrap gap-2 justify-content-center">

            <a class="btn btn-lg px-4 fw-semibold"
                href="{{ route('login') }}"
                style="background-color: #facc15; color: #064e3b; border: none;">
                🔐 Login untuk Membuat Pengaduan
            </a>

            <a class="btn btn-outline-light btn-lg px-4"
                href="{{ route('kategori.index') }}">
                📋 Kategori
            </a>

        </div>

    </div>
</section>


{{-- Tentang Aplikasi --}}
<section class="container py-5">

    <div class="row g-4 align-items-center">

        {{-- Ilustrasi --}}
        <div class="col-lg-5 text-center">

            <div class="p-5 rounded-4 shadow-sm"
                style="background: #ecfdf5;">

                <div style="font-size: 100px;">
                    🕌
                </div>

                <h3 class="fw-bold mt-3"
                    style="color: #065f46;">
                    Masjid Bersih & Nyaman
                </h3>

                <p class="text-secondary mb-0">
                    Bersama menjaga dan merawat fasilitas masjid
                    agar tetap nyaman digunakan oleh jamaah.
                </p>

            </div>

        </div>


        {{-- Informasi --}}
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4 p-lg-5">

                    <h2 class="fw-bold mb-3"
                        style="color: #065f46;">
                        🕌 Tentang Aplikasi
                    </h2>

                    <div style="width: 70px; height: 4px;
                                background-color: #facc15;
                                border-radius: 10px;"
                        class="mb-4">
                    </div>

                    <p class="text-secondary">
                        Pengaduan Sarana & Prasarana Masjid merupakan
                        aplikasi yang digunakan untuk memudahkan jamaah
                        dalam melaporkan kerusakan atau permasalahan
                        pada fasilitas masjid.
                    </p>

                    <p class="text-secondary">
                        Melalui aplikasi ini, pengguna dapat menyampaikan
                        pengaduan dengan informasi yang jelas. Admin dapat
                        mengelola, memproses, dan memperbarui status
                        pengaduan hingga selesai.
                    </p>

                    <p class="text-secondary mb-0">
                        Dengan adanya aplikasi ini, proses pelaporan
                        sarana dan prasarana masjid menjadi lebih mudah,
                        terorganisir, dan transparan sehingga fasilitas
                        masjid dapat dirawat dengan lebih baik.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- Keunggulan --}}
<section class="container pb-5">

    <div class="text-center mb-4">

        <h2 class="fw-bold" style="color: #065f46;">
            Fitur Pengaduan
        </h2>

        <p class="text-secondary">
            Membantu pengelolaan fasilitas masjid dengan lebih mudah.
        </p>

    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-center">
                <div class="card-body p-4">

                    <div style="font-size: 45px;">📝</div>

                    <h5 class="fw-bold mt-3">
                        Pengaduan Mudah
                    </h5>

                    <p class="text-secondary mb-0">
                        Sampaikan laporan kerusakan fasilitas masjid
                        dengan cepat dan mudah.
                    </p>

                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-center">
                <div class="card-body p-4">

                    <div style="font-size: 45px;">⚙️</div>

                    <h5 class="fw-bold mt-3">
                        Diproses Admin
                    </h5>

                    <p class="text-secondary mb-0">
                        Setiap pengaduan dapat dikelola dan diproses
                        oleh admin masjid.
                    </p>

                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-center">
                <div class="card-body p-4">

                    <div style="font-size: 45px;">✅</div>

                    <h5 class="fw-bold mt-3">
                        Status Transparan
                    </h5>

                    <p class="text-secondary mb-0">
                        Pantau perkembangan pengaduan hingga
                        permasalahan selesai ditangani.
                    </p>

                </div>
            </div>
        </div>

    </div>

</section>


@endsection