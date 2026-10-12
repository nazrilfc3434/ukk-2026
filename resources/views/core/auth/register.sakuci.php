@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('content')
<style>
    /* ===== Daftar: warna mengikuti tema terang/gelap ===== */
    .rg-page {
        min-height: 75vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: clamp(1rem, 4vw, 2.5rem) .5rem;
        background:
            radial-gradient(circle at top right, rgba(16, 185, 129, .12), transparent 35%),
            radial-gradient(circle at bottom left, rgba(250, 204, 21, .12), transparent 35%);
    }

    .rg-card {
        width: 100%;
        max-width: 480px;
        overflow: hidden;
        color: var(--bs-body-color);
        background: var(--bs-body-bg);
        border: 1px solid var(--bs-border-color);
        border-radius: clamp(18px, 4vw, 26px);
        box-shadow: 0 1.25rem 3rem rgba(6, 78, 59, .15);
        animation: rg-masuk .5s ease both;
    }

    /* Header */
    .rg-header {
        position: relative;
        overflow: hidden;
        padding: clamp(1.5rem, 5vw, 2.25rem) 1.5rem 1.75rem;
        text-align: center;
        color: #fff;
        background: linear-gradient(135deg, #064e3b, #047857 60%, #0d9668);
    }
    .rg-header::before {
        content: "";
        position: absolute; left: -70px; top: -100px;
        width: 200px; height: 200px; border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, .14);
    }
    .rg-header::after {
        content: "";
        position: absolute; right: -50px; bottom: -90px;
        width: 180px; height: 180px; border-radius: 50%;
        background: radial-gradient(circle, rgba(250, 204, 21, .22), rgba(250, 204, 21, 0) 70%);
    }
    .rg-header > * { position: relative; z-index: 1; }

    .rg-icon {
        width: clamp(64px, 17vw, 80px); height: clamp(64px, 17vw, 80px);
        margin: 0 auto 1rem;
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%;
        font-size: clamp(32px, 8.5vw, 40px);
        background: rgba(255, 255, 255, .12);
        border: 2px solid rgba(250, 204, 21, .7);
        animation: rg-melayang 4s ease-in-out infinite;
    }
    .rg-title { margin: 0 0 .3rem; font-weight: 700; }
    .rg-subtitle { margin: 0; font-size: .88rem; color: #d1fae5; }

    /* Isi */
    .rg-body { padding: clamp(1.25rem, 5vw, 2rem); }

    .rg-ornamen {
        text-align: center; margin-bottom: 1.25rem;
        font-size: 12px; letter-spacing: 8px; color: #d4af37;
    }
    .rg-judul { color: var(--bs-emphasis-color); }

    /* Kotak info */
    .rg-info {
        padding: .75rem 1rem;
        font-size: .86rem;
        color: var(--bs-body-color);
        background: color-mix(in srgb, #10b981 12%, transparent);
        border: 1px solid color-mix(in srgb, #10b981 30%, transparent);
        border-radius: 14px;
    }

    /* Form (hanya berlaku di halaman daftar) */
    .rg-page .form-label { font-weight: 600; color: var(--bs-emphasis-color); }

    .rg-page .input-group-text {
        color: #059669;
        font-size: 1.05rem;
        background: var(--bs-tertiary-bg);
        border-color: var(--bs-border-color);
        border-right: 0;
        border-radius: 12px 0 0 12px;
    }
    .rg-page .form-control,
    .rg-page .form-select {
        padding: .7rem .95rem;
        border-color: var(--bs-border-color);
        border-left: 0;
        border-radius: 0 12px 12px 0;
    }
    .rg-page .form-control:focus,
    .rg-page .form-select:focus {
        border-color: #059669;
        box-shadow: 0 0 0 .2rem rgba(5, 150, 105, .15);
    }
    .rg-page .input-group:focus-within .input-group-text { border-color: #059669; }

    /* Input password + tombol mata */
    .rg-page .input-group .rg-mata {
        border: 1px solid var(--bs-border-color);
        border-left: 0;
        border-radius: 0 12px 12px 0;
        background: var(--bs-body-bg);
        color: var(--bs-secondary-color);
    }
    .rg-page .input-group .rg-mata:hover { color: var(--bs-body-color); background: var(--bs-tertiary-bg); }
    .rg-page .input-group .form-control.rg-has-eye { border-radius: 0; border-right: 0; }

    /* Tombol */
    .rg-btn {
        padding: .8rem; font-weight: 700; color: #064e3b;
        border: 0; border-radius: 14px;
        background: linear-gradient(135deg, #facc15, #eab308);
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .rg-btn:hover { color: #064e3b; transform: translateY(-2px); box-shadow: 0 .6rem 1.4rem rgba(234, 179, 8, .3); }

    .rg-link { color: #059669; font-weight: 600; text-decoration: none; }
    .rg-link:hover { text-decoration: underline; }
    [data-bs-theme="dark"] .rg-link { color: #34d399; }

    .rg-home { color: var(--bs-secondary-color); font-size: .85rem; text-decoration: none; }
    .rg-home:hover { color: var(--bs-body-color); }

    /* Animasi */
    @keyframes rg-masuk {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes rg-melayang {
        0%, 100% { transform: translateY(0); }
        50%      { transform: translateY(-5px); }
    }
    @media (prefers-reduced-motion: reduce) {
        .rg-card, .rg-icon { animation: none; }
        .rg-btn { transition: none; }
    }

    /* Mode gelap */
    [data-bs-theme="dark"] .rg-card {
        background: var(--bs-tertiary-bg);
        box-shadow: 0 1.25rem 3rem rgba(0, 0, 0, .5);
    }
    [data-bs-theme="dark"] .rg-page .form-control,
    [data-bs-theme="dark"] .rg-page .form-select,
    [data-bs-theme="dark"] .rg-page .input-group .rg-mata { background: var(--bs-body-bg); }
    [data-bs-theme="dark"] .rg-page .input-group-text { color: #34d399; }
</style>


<div class="rg-page">

    <div class="rg-card">

        {{-- Header --}}
        <div class="rg-header">

            <div class="rg-icon" aria-hidden="true">🕌</div>

            <h1 class="h4 rg-title">Buat Akun Baru</h1>

            <p class="rg-subtitle">
                Bergabung dalam menjaga fasilitas masjid
            </p>

        </div>


        {{-- Form --}}
        <div class="rg-body">

            <div class="rg-ornamen" aria-hidden="true">✦ ─── ✦ ─── ✦</div>

            <div class="text-center mb-4">

                <h2 class="h5 fw-bold mb-1 rg-judul">Daftar Akun</h2>

                <p class="text-secondary small mb-0">
                    Lengkapi data berikut untuk membuat akun.
                </p>

            </div>


            {{-- Tautan ke login --}}
            <div class="rg-info mb-4 text-center">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="rg-link">Masuk di sini</a>
            </div>


            <form method="POST" action="{{ route('register.attempt') }}">
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
                            placeholder="Buat username"
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
                <div class="mb-3">

                    <label class="form-label" for="password">Password</label>

                    <div class="input-group">

                        <span class="input-group-text" aria-hidden="true">🔒</span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control rg-has-eye {{ errors()->has('password') ? 'is-invalid' : '' }}"
                            placeholder="Buat password"
                            autocomplete="new-password"
                        >

                        <button type="button" class="btn rg-mata" data-target="password"
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


                {{-- Konfirmasi Password --}}
                <div class="mb-3">

                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>

                    <div class="input-group">

                        <span class="input-group-text" aria-hidden="true">🔐</span>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control rg-has-eye"
                            placeholder="Ulangi password"
                            autocomplete="new-password"
                        >

                        <button type="button" class="btn rg-mata" data-target="password_confirmation"
                                aria-label="Tampilkan atau sembunyikan konfirmasi password">
                            👁
                        </button>

                    </div>

                </div>


                {{-- Role --}}
                @if (count($roles) > 1)

                    <div class="mb-4">

                        <label class="form-label" for="role">Daftar sebagai</label>

                        <div class="input-group">

                            <span class="input-group-text" aria-hidden="true">👥</span>

                            <select
                                id="role"
                                name="role"
                                class="form-select {{ errors()->has('role') ? 'is-invalid' : '' }}"
                            >

                                @foreach ($roles as $role)

                                    <option
                                        value="{{ $role->name }}"
                                        {{ old('role') === $role->name ? 'selected' : '' }}
                                    >
                                        {{ $role->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        @error('role')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                @else

                    <input
                        type="hidden"
                        name="role"
                        value="{{ $roles[0]->name }}"
                    >

                    <div class="mb-4"></div>

                @endif


                {{-- Tombol --}}
                <button class="btn rg-btn w-100" type="submit">
                    🕌 Buat Akun
                </button>

            </form>


            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="rg-home">← Kembali ke Home</a>
            </div>

            <div class="text-center mt-2">
                <small class="text-secondary">
                    🌿 Bersama menjaga kenyamanan dan fasilitas masjid
                </small>
            </div>

        </div>

    </div>

</div>
@endsection


@section('scripts')
<script>
    (function () {
        document.querySelectorAll('.rg-mata').forEach(function (tombol) {
            tombol.addEventListener('click', function () {
                var input = document.getElementById(tombol.getAttribute('data-target'));
                if (!input) return;

                var tampil = input.type === 'password';
                input.type = tampil ? 'text' : 'password';
                tombol.textContent = tampil ? '🙈' : '👁';
            });
        });
    })();
</script>
@endsection