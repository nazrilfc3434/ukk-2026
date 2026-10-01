<style>
    .login-page {
        min-height: 75vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 15px;
        background:
            radial-gradient(circle at top left, rgba(16, 185, 129, 0.10), transparent 35%),
            radial-gradient(circle at bottom right, rgba(250, 204, 21, 0.10), transparent 35%);
    }

    .login-card {
        width: 100%;
        max-width: 450px;
        border: none;
        border-radius: 24px;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 20px 50px rgba(6, 78, 59, 0.15);
    }

    .login-header {
        position: relative;
        padding: 35px 30px 30px;
        text-align: center;
        color: white;
        background: linear-gradient(135deg, #064e3b, #047857);
    }

    .login-header::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 50%;
        top: -100px;
        right: -70px;
    }

    .login-icon {
        width: 85px;
        height: 85px;
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
        border: 2px solid rgba(250, 204, 21, 0.7);
        font-size: 43px;
    }

    .login-title {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .login-subtitle {
        color: #d1fae5;
        font-size: 14px;
        margin-bottom: 0;
    }

    .login-body {
        padding: 30px;
    }

    .form-label {
        font-weight: 600;
        color: #064e3b;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px 15px;
        border: 1px solid #d1d5db;
    }

    .form-control:focus {
        border-color: #059669;
        box-shadow: 0 0 0 0.2rem rgba(5, 150, 105, 0.12);
    }

    .btn-login {
        border: none;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        color: #064e3b;
        background: linear-gradient(135deg, #facc15, #eab308);
        transition: all 0.2s ease;
    }

    .btn-login:hover {
        color: #064e3b;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(234, 179, 8, 0.25);
    }

    .demo-box {
        background: #ecfdf5;
        border: 1px solid #d1fae5;
        border-radius: 12px;
        padding: 12px 15px;
        color: #065f46;
        font-size: 13px;
    }

    .demo-box code {
        color: #047857;
        background: #d1fae5;
        padding: 2px 6px;
        border-radius: 5px;
    }

    .register-link {
        color: #047857;
        font-weight: 600;
        text-decoration: none;
    }

    .register-link:hover {
        color: #064e3b;
        text-decoration: underline;
    }

    .mosque-decoration {
        text-align: center;
        color: #d4af37;
        letter-spacing: 8px;
        font-size: 12px;
        margin-bottom: 20px;
    }
</style>


<div class="login-page">

    <div class="login-card">

        {{-- Header --}}
        <div class="login-header">

            <div class="login-icon">
                🕌
            </div>

            <h1 class="h4 login-title">
                Selamat Datang
            </h1>

            <p class="login-subtitle">
                Sistem Pengaduan Sarana & Prasarana Masjid
            </p>

        </div>


        {{-- Form --}}
        <div class="login-body">

            <div class="mosque-decoration">
                ✦ ─── ✦ ─── ✦
            </div>

            <div class="text-center mb-4">
                <h2 class="h5 fw-bold mb-1" style="color: #064e3b;">
                    Masuk ke Akun
                </h2>

                <p class="text-secondary small mb-0">
                    Silakan masuk untuk membuat dan mengelola pengaduan.
                </p>
            </div>


            {{-- Demo Account --}}
            <div class="demo-box mb-4">
                <div class="fw-semibold mb-1">
                    🔑 Akun Demo
                </div>

                <div>
                    Username:
                    <strong>admin</strong>
                    &nbsp; | &nbsp;
                    Password:
                    <code>rahasia123</code>
                </div>
            </div>


            <form method="POST" action="{{ route('login.attempt') }}">
                @csrf

                {{-- Username --}}
                <div class="mb-3">

                    <label class="form-label" for="username">
                        Username
                    </label>

                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"
                            style="border-radius: 12px 0 0 12px;">
                            👤
                        </span>

                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="{{ old('username') }}"
                            class="form-control border-start-0 {{ errors()->has('username') ? 'is-invalid' : '' }}"
                            placeholder="Masukkan username"
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

                    <label class="form-label" for="password">
                        Password
                    </label>

                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"
                            style="border-radius: 12px 0 0 12px;">
                            🔒
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control border-start-0 {{ errors()->has('password') ? 'is-invalid' : '' }}"
                            placeholder="Masukkan password"
                        >
                    </div>

                    @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Login Button --}}
                <button class="btn btn-login w-100" type="submit">
                    🕌 Masuk ke Sistem
                </button>

            </form>


            {{-- Register --}}
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

                        <a href="{{ route('register') }}"
                           class="register-link">
                            Daftar di sini
                        </a>
                    </p>

                </div>

            @endif


            <div class="text-center mt-4">
                <small class="text-secondary">
                    🌿 Bersama menjaga kenyamanan masjid
                </small>
            </div>

        </div>

    </div>

</div>
