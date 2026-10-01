<style>
    .register-page {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 15px;
        background:
            radial-gradient(circle at top right, rgba(16, 185, 129, 0.10), transparent 35%),
            radial-gradient(circle at bottom left, rgba(250, 204, 21, 0.10), transparent 35%);
    }

    .register-card {
        width: 100%;
        max-width: 480px;
        border: none;
        border-radius: 24px;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 20px 50px rgba(6, 78, 59, 0.15);
    }

    .register-header {
        position: relative;
        padding: 32px 30px;
        text-align: center;
        color: white;
        background: linear-gradient(135deg, #064e3b, #047857);
    }

    .register-header::before {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 50%;
        top: -100px;
        left: -70px;
    }

    .register-header::after {
        content: "";
        position: absolute;
        width: 130px;
        height: 130px;
        border: 1px solid rgba(250,204,21,0.15);
        border-radius: 50%;
        bottom: -80px;
        right: -40px;
    }

    .register-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
        border: 2px solid rgba(250,204,21,0.7);
        font-size: 40px;
    }

    .register-title {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .register-subtitle {
        color: #d1fae5;
        font-size: 14px;
        margin-bottom: 0;
    }

    .register-body {
        padding: 30px;
    }

    .form-label {
        font-weight: 600;
        color: #064e3b;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        padding: 11px 14px;
        border: 1px solid #d1d5db;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #059669;
        box-shadow: 0 0 0 0.2rem rgba(5,150,105,0.12);
    }

    .input-group-text {
        border-color: #d1d5db;
        color: #047857;
        font-size: 17px;
    }

    .btn-register {
        border: none;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        color: #064e3b;
        background: linear-gradient(135deg, #facc15, #eab308);
        transition: all 0.2s ease;
    }

    .btn-register:hover {
        color: #064e3b;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(234,179,8,0.25);
    }

    .login-link {
        color: #047857;
        font-weight: 600;
        text-decoration: none;
    }

    .login-link:hover {
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

    .info-box {
        background: #ecfdf5;
        border: 1px solid #d1fae5;
        border-radius: 12px;
        padding: 12px 15px;
        color: #065f46;
        font-size: 13px;
    }
</style>


<div class="register-page">

    <div class="register-card">

        {{-- Header --}}
        <div class="register-header">

            <div class="register-icon">
                🕌
            </div>

            <h1 class="h4 register-title">
                Buat Akun Baru
            </h1>

            <p class="register-subtitle">
                Bergabung dalam menjaga fasilitas masjid
            </p>

        </div>


        {{-- Form --}}
        <div class="register-body">

            <div class="mosque-decoration">
                ✦ ─── ✦ ─── ✦
            </div>

            <div class="text-center mb-4">

                <h2 class="h5 fw-bold mb-1" style="color: #064e3b;">
                    Daftar Akun
                </h2>

                <p class="text-secondary small mb-0">
                    Lengkapi data berikut untuk membuat akun.
                </p>

            </div>


            {{-- Login Link --}}
            <div class="info-box mb-4 text-center">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="login-link">
                    Masuk di sini
                </a>
            </div>


            <form method="POST" action="{{ route('register.attempt') }}">
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
                            placeholder="Buat username"
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
                            placeholder="Buat password"
                        >

                    </div>

                    @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Konfirmasi Password --}}
                <div class="mb-3">

                    <label class="form-label" for="password_confirmation">
                        Konfirmasi Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text bg-white border-end-0"
                            style="border-radius: 12px 0 0 12px;">
                            🔐
                        </span>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control border-start-0"
                            placeholder="Ulangi password"
                        >

                    </div>

                </div>


                {{-- Role --}}
                @if (count($roles) > 1)

                    <div class="mb-4">

                        <label class="form-label" for="role">
                            Daftar sebagai
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white border-end-0"
                                style="border-radius: 12px 0 0 12px;">
                                👥
                            </span>

                            <select
                                id="role"
                                name="role"
                                class="form-select border-start-0 {{ errors()->has('role') ? 'is-invalid' : '' }}"
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

                @endif


                {{-- Button --}}
                <button class="btn btn-register w-100" type="submit">
                    🕌 Buat Akun
                </button>

            </form>


            <div class="text-center mt-4">

                <small class="text-secondary">
                    🌿 Bersama menjaga kenyamanan dan fasilitas masjid
                </small>

            </div>

        </div>

    </div>

</div>
