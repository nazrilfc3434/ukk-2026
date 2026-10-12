<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>

    {{-- Terapkan tema tersimpan sebelum apa pun dirender, supaya tidak ada flash warna --}}
    <script>
        (function () {
            var saved = localStorage.getItem('sakuci-theme');
            var theme = saved || (matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-bs-theme', theme);
        })();
    </script>

    {{-- Bootstrap 5.3.8 -- file lokal, tidak butuh internet --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- DIUBAH: layout ditulis ulang, tidak bergantung pada CSS lain --}}
    <style>
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            width: 100%;
            max-width: 100%;
        }
        body {
            display: block !important;
            min-height: 100vh;
            overflow-x: clip;
        }

        /* Area konten + footer */
        .app-shell {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            min-width: 0;
            margin: 0 !important;
            padding: 0 !important;
            box-sizing: border-box;
        }

        /* Desktop + sudah login: sisihkan ruang untuk sidebar (satu-satunya geseran) */
        @media (min-width: 992px) {
            body:has(.app-sidebar) .app-shell {
                margin-left: var(--sidebar-w, 272px) !important;
                width: calc(100% - var(--sidebar-w, 272px));
            }
        }

        /* Isi halaman: selebar area konten, tabel yang terlalu lebar bisa digeser di dalamnya */
        .app-shell > main {
            flex: 1 0 auto;
            width: 100%;
            max-width: none !important;
            min-width: 0;
            margin: 0 !important;
            padding: 1.5rem;
            box-sizing: border-box;
            overflow-x: auto;
        }

        .app-shell > footer {
            flex-shrink: 0;
            width: 100%;
            margin: 0 !important;
        }

        img, svg, video, iframe { max-width: 100%; }
    </style>
</head>
<body class="bg-body-tertiary">

@include('partials.navbar')

<div class="app-shell">

    <main>
        @include('partials.flash')

        @yield('content')
    </main>

    @include('partials.footer')

</div>

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/theme.js') }}"></script>
@yield('scripts')

</body>
</html>