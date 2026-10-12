@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    /* ===== Login: warna mengikuti tema terang/gelap ===== */
    .lg-page {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: clamp(1rem, 4vw, 2.5rem) .5rem;
        background:
            radial-gradient(circle at top left, rgba(16, 185, 129, .12), transparent 35%),
            radial-gradient(circle at bottom right, rgba(250, 204, 21, .12), transparent 35%);
    }

    .lg-card {
        width: 100%;
        max-width: 450px;
        overflow: hidden;
        color: var(--bs-body-color);
        background: var(--bs-body-bg);
        border: 1px solid var(--bs-border-color);
        border-radius: clamp(18px, 4vw, 26px);
        box-shadow: 0 1.25rem 3rem rgba(6, 78, 59, .15);
        animation: lg-masuk .5s ease both;
    }

    /* Header */
    .lg-header {
        position: relative;
        overflow: hidden;
        padding: clamp(1.5rem, 5vw, 2.25rem) 1.5rem 1.75rem;
        text-align: center;
        color: #fff;
        background: linear-gradient(135deg, #064e3b, #047857 60%, #0d9668);
    }
    .lg-header::before {
        content: "";
        position: absolute; right: -70px; top: -100px;
        width: 200px; height: 200px; border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, .14);
    }
    .lg-header::after {
        content: "";
        position: absolute; left: -60px; bottom: -90px;
        width: 180px; height: 180px; border-radius: 50%;
        background: radial-gradient(circle, rgba(250, 204, 21, .22), rgba(250, 204, 21, 0) 70%);
    }
    .lg-header > * { position: relative; z-index: 1; }

    .lg-icon {
        width: clamp(68px, 18vw, 85px); height: clamp(68px, 18vw, 85px);
        margin: 0 auto 1rem;
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%;
        font-size: clamp(34px, 9vw, 43px);
        background: rgba(255, 255, 255, .12);
        border: 2px solid rgba(250, 204, 21, .7);
        animation: lg-melayang 4s ease-in-out infinite;
    }
    .lg-title { margin: 0 0 .3rem; font-weight: 700; }
    .lg-subtitle { margin: 0; font-size: .88rem; color: #d1fae5; }

    /* Isi */
    .lg-body { padding: clamp(1.25rem, 5vw, 2rem); }

    .lg-ornamen {
        text-align: center; margin-bottom: 1.25rem;
        font-size: 12px; letter-spacing: 8px; color: #d4af37;
    }
    .lg-judul { color: var(--bs-emphasis-color); }

    /* Kotak akun demo */
    .lg-demo {
        padding: .75rem 1rem;
        font-size: .82rem;
        color: var(--bs-body-color);
        background: color-mix(in srgb, #10b981 12%, transparent);
        border: 1px solid color-mix(in srgb, #10b981 30%, transparent);
        border-radius: 14px;
    }
    .lg-demo code {
        padding: 2px 6px;
        color: #059669;
        background: color-mix(in srgb, #10b981 18%, transparent);
        border-radius: 6px;
    }
    [data-bs-theme="dark"] .lg-demo code { color: #6ee7b7; }

    /* Form (hanya berlaku di halaman login) */
    .lg-page .form-label { font-weight: 600; color: var(--bs-emphasis-color); }

    .lg-page .input-group-text {
        background: var(--bs-tertiary-bg);
        border-color: var(--bs-border-color);
        border-right: 0;
        border-radius: 12px 0 0 12px;
    }
    .lg-page .form-control {
        padding: .75rem .95rem;
        border-color: var(--bs-border-color);
        border-left: 0;
        border-radius: 0 12px 12px 0;
    }
    .lg-page .form-control:focus {
        border-color: #059669;
        box-shadow: 0 0 0 .2rem rgba(5, 150, 105, .15);
    }
    .lg-page .input-group:focus-within .input-group-text { border-color: #059669; }

    /* Input password + tombol mata */
    .lg-page .input-group .lg-mata {
        border: 1px solid var(--bs-border-color);
        border-left: 0;
        border-radius: 0 12px 12px 0;
        background: var(--bs-body-bg);
        color: var(--bs-secondary-color);
    }
    .lg-page .input-group .lg-mata:hover { color: var(--bs-body-color); background: var(--bs-tertiary-bg); }
    .lg-page .input-group .form-control.lg-has-eye { border-radius: 0; border-right: 0; }

    /* Tombol masuk */
    .lg-btn {
        padding: .8rem; font-weight: 700; color: #064e3b;
        border: 0; border-radius: 14px;
        background: linear-gradient(135deg, #facc15, #eab308);
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .lg-btn:hover { color: #064e3b; transform: translateY(-2px); box-shadow: 0 .6rem 1.4rem rgba(234, 179, 8, .3); }

    .lg-daftar { color: #059669; font-weight: 600; text-decoration: none; }
    .lg-daftar:hover { text-decoration: underline; }
    [data-bs-theme="dark"] .lg-daftar { color: #34d399; }

    .lg-home { color: var(--bs-secondary-color); font-size: .85rem; text-decoration: none; }
    .lg-home:hover { color: var(--bs-body-color); }

    /* Animasi */
    @keyframes lg-masuk {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes lg-melayang {
        0%, 100% { transform: translateY(0); }
        50%      { transform: translateY(-5px); }
    }
    @media (prefers-reduced-motion: reduce) {
        .lg-card, .lg-icon { animation: none; }
        .lg-btn { transition: none; }
    }

    /* Mode gelap */
    [data-bs-theme="dark"] .lg-card {
        background: var(--bs-tertiary-bg);
        box-shadow: 0 1.25rem 3rem rgba(0, 0, 0, .5);
    }
    [data-bs-theme="dark"] .lg-page .form-control { background: var(--bs-body-bg); }
    [data-bs-theme="dark"] .lg-page .input-group .lg-mata { background: var(--bs-body-bg); }
</style>


<div class="lg-page">

    <div class="lg-card">

        {{-- Header --}}
        <div class="lg-header">

            <div class="lg-icon" aria-hidden="true">🕌</div>

            <h1 class="h4 lg-title">Selamat Datang</h1>

            <p class="lg-subtitle">
                Sistem Pengaduan Sarana & Prasarana Masjid
            </p>

        </div>


        {{-- Form --}}
        <div class="lg-body">

            <div class="lg-ornamen" aria-hidden="true">✦ ─── ✦ ─── ✦</div>

            <div class="text-center mb-4">
                <h2 class="h5 fw-bold mb-1 lg-judul">Masuk ke Akun</h2>

                <p class="text-secondary small mb-0">
                    Silakan masuk untuk membuat dan mengelola pengaduan.
                </p>
            </div>


            {{-- Akun Demo --}}
            <div class="lg-demo mb-4">
                <div class="fw-semibold mb-1">🔑 Akun Demo</div>

                <div>
                    Username: <strong>admin</strong>
                    &nbsp;|&nbsp;
                    Password: <code>rahasia123</code>
                </div>
            </div>


            <form method="POST" action="{{ route('login.attempt') }}">
                @csrf

                {{-- Username --}}
                <div class="mb-3">

                    <label class="form-label" for="username">Username</label>

                    <div class="input-group">
                        <span class="input-group-text" aria-hidden="true">👤</span>

                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="{{ old('username') }}"
                            class="form-control {{ errors()->has('username') ? 'is-invalid' : '' }}"
                            placeholder="Masukkan username"
                            autocomplete="username"
                            autofocus
                        >
                    </div>

                    @error('username')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Password --}}
                <div class="mb-4">

                    <label class="form-label" for="password">Password</label>

                    <div class="input-group">
                        <span class="input-group-text" aria-hidden="true">🔒</span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control lg-has-eye {{ errors()->has('password') ? 'is-invalid' : '' }}"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                        >

                        <button type="button" class="btn lg-mata" id="lgToggle"
                                aria-label="Tampilkan atau sembunyikan password">
                            👁
                        </button>
                    </div>

                    @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Tombol Masuk --}}
                <button class="btn lg-btn w-100" type="submit">
                    🕌 Masuk ke Sistem
                </button>

            </form>


            {{-- Daftar --}}
            @php
                $canRegister = false;

                try {
                    $canRegister = \App\Models\Role::where('can_register', 1)->exists();
                } catch (\Throwable $e) {
                    $canRegister = false;
                }
            @endphp

            @if ($canRegister)

                <div class="text-center mt-4">

                    <p class="text-secondary small mb-0">
                        Belum punya akun?

                        <a href="{{ route('register') }}" class="lg-daftar">
                            Daftar di sini
                        </a>
                    </p>

                </div>

            @endif


            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="lg-home">← Kembali ke Home</a>
            </div>

            <div class="text-center mt-2">
                <small class="text-secondary">🌿 Bersama menjaga kenyamanan masjid</small>
            </div>

        </div>

    </div>

</div>
@endsection


@section('scripts')
<script>
    (function () {
        var tombol = document.getElementById('lgToggle');
        var input  = document.getElementById('password');
        if (!tombol || !input) return;

        tombol.addEventListener('click', function () {
            var tampil = input.type === 'password';
            input.type = tampil ? 'text' : 'password';
            tombol.textContent = tampil ? '🙈' : '👁';
        });
    })();
</script>
@endsection