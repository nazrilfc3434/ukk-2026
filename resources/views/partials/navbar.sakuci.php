@php
    $navUser = \App\Models\User::current();
    $navRole = $navUser ? $navUser->role : null;
    $navPath = trim((string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');

    // Ikon (gaya garis) untuk tiap menu
    $ik = [
        'home'     => '<path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/>',
        'kategori' => '<path d="M20 12l-8 8-9-9V3h8z"/><circle cx="7.5" cy="7.5" r="1.2"/>',
        'alat'     => '<path d="M14.7 6.3a4 4 0 0 0-5.4 5.4L3 18l3 3 6.3-6.3a4 4 0 0 0 5.4-5.4l-2.6 2.6-2.4-.6-.6-2.4z"/>',
        'pengguna' => '<circle cx="9" cy="8" r="3.2"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><path d="M16 5.2a3 3 0 0 1 0 5.6"/><path d="M18 14.3c1.8.8 3 2.6 3 4.7"/>',
        'pengaduan'=> '<path d="M21 12a8 8 0 0 1-11.7 7.1L3 21l1.9-5.3A8 8 0 1 1 21 12z"/>',
        'role'     => '<path d="M12 3l8 3v6c0 4.5-3.2 8.2-8 9-4.8-.8-8-4.5-8-9V6z"/>',
        'db'       => '<ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v6c0 1.7 3.6 3 8 3s8-1.3 8-3V5"/><path d="M4 11v6c0 1.7 3.6 3 8 3s8-1.3 8-3v-6"/>',
        'keluar'   => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/>',
        // DITAMBAH: ikon panah kembali
        'kembali'  => '<path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/>',
    ];

    // [label, nama route, awalan URL untuk penanda aktif, ikon]
    $navMenu = [];
    $navSistem = [];
    if ($navRole === 'admin') {
        $navMenu = [
            ['Dashboard', 'admin.dashboard', 'admin',           $ik['home']],
            ['Pengaduan', 'pengaduan.index', 'admin/pengaduan', $ik['pengaduan']],
            ['Alat',      'alat.index',      'admin/alat',      $ik['alat']],
            ['Kategori',  'kategori.index',  'admin/kategori',  $ik['kategori']],
            ['Pengguna',  'pengguna.index',  'admin/pengguna',  $ik['pengguna']],
        ];
        $navSistem = [
            ['Role',           'admin.roles.index',     'admin/roles',  $ik['role']],
            ['Akun pengguna',  'admin.users.index',     'admin/users',  $ik['pengguna']],
            ['Ekspor database','admin.database.export', 'admin/database', $ik['db']],
        ];
    } elseif ($navRole === 'siswa') {
        $navMenu = [
            ['Dashboard',    'siswa.dashboard',       'siswa',           $ik['home']],
            ['Pengaduan Saya','siswa.pengaduan.index','siswa/pengaduan', $ik['pengaduan']],
            ['Alat & Fasilitas','siswa.alat.index',   'siswa/alat',      $ik['alat']],
        ];
    }
@endphp

<style>
    :root { --sidebar-w: 272px; }

    .nav-brand-mark {
        width: 40px; height: 40px; flex: 0 0 40px;
        display: grid; place-items: center;
        border-radius: 12px; color: #fff;
        background: linear-gradient(135deg, var(--bs-primary), var(--bs-info));
        box-shadow: 0 .25rem .6rem rgba(var(--bs-primary-rgb), .35);
    }
    .nav-brand-text { font-weight: 700; line-height: 1.15; font-size: .95rem; }
    .nav-brand-text small { display: block; font-weight: 500; font-size: .68rem; opacity: .65; }

    .btn-tema {
        width: 40px; height: 40px; flex: 0 0 40px;
        display: inline-grid; place-items: center; padding: 0;
        border-radius: 50%;
        border: 1px solid var(--bs-border-color);
        background: var(--bs-body-bg); color: var(--bs-body-color);
        transition: transform .35s ease, background-color .2s ease, border-color .2s ease;
    }
    .btn-tema:hover { background: var(--bs-tertiary-bg); border-color: var(--bs-primary); }
    .btn-tema.putar { transform: rotate(360deg) scale(.9); }
    .btn-tema svg { width: 20px; height: 20px; }
    .btn-tema .ikon-matahari { display: none; color: #f5b301; }
    .btn-tema .ikon-bulan { color: var(--bs-primary); }
    [data-bs-theme="dark"] .btn-tema .ikon-matahari { display: block; }
    [data-bs-theme="dark"] .btn-tema .ikon-bulan { display: none; }

    /* ---------- Sidebar ---------- */
    .app-sidebar {
        --bs-offcanvas-width: var(--sidebar-w);
        background: var(--bs-body-bg);
        border-right: 1px solid var(--bs-border-color) !important;
    }
    .app-sidebar .offcanvas-body { padding: 0 .9rem 1rem; display: flex; flex-direction: column; }
    .side-label {
        font-size: .68rem; font-weight: 700; letter-spacing: .08em;
        text-transform: uppercase; color: var(--bs-secondary-color);
        padding: 1rem .75rem .4rem;
    }
    .side-link {
        display: flex; align-items: center; gap: .75rem;
        padding: .65rem .8rem; margin-bottom: 2px;
        border-radius: .8rem; text-decoration: none;
        color: var(--bs-body-color); font-weight: 500;
        transition: background-color .15s ease, color .15s ease, transform .15s ease;
    }
    .side-link svg { width: 20px; height: 20px; flex: 0 0 20px; fill: none; stroke: currentColor; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; opacity: .8; }
    .side-link:hover { background: var(--bs-tertiary-bg); color: var(--bs-body-color); transform: translateX(2px); }
    .side-link.active {
        background: linear-gradient(135deg, var(--bs-primary), var(--bs-info));
        color: #fff; box-shadow: 0 .3rem .8rem rgba(var(--bs-primary-rgb), .3);
    }
    .side-link.active svg { opacity: 1; }

    .side-user {
        margin-top: auto; padding: .8rem;
        border: 1px solid var(--bs-border-color); border-radius: 1rem;
        background: var(--bs-tertiary-bg);
    }
    .side-avatar {
        width: 40px; height: 40px; flex: 0 0 40px; border-radius: 50%;
        display: grid; place-items: center; font-weight: 700; color: #fff;
        background: linear-gradient(135deg, var(--bs-primary), var(--bs-info));
    }
    .side-user .nama { font-weight: 600; line-height: 1.1; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

    /* Desktop: sidebar permanen di kiri, konten digeser */
    @media (min-width: 992px) {
        body { padding-left: var(--sidebar-w); }
        .app-sidebar {
            visibility: visible !important;
            transform: none !important;
            z-index: 1030;
        }
    }
    /* Ponsel: top bar kecil + sidebar sebagai panel geser */
    .app-topbar { background: var(--bs-body-bg); border-bottom: 1px solid var(--bs-border-color); }
</style>

@if ($navUser)

    {{-- Top bar khusus ponsel/tablet --}}
    <header class="app-topbar sticky-top d-lg-none">
        <div class="d-flex align-items-center gap-2 px-3 py-2">
            <button class="btn btn-outline-secondary border-0 p-2" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarUtama" aria-controls="sidebarUtama" aria-label="Buka menu">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
            </button>
            <span class="fw-bold text-truncate me-auto">Pengaduan Masjid</span>

            {{-- DITAMBAH: tombol Home di top bar ponsel --}}
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 d-inline-flex align-items-center gap-1">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $ik['kembali'] !!}</svg>
                Home
            </a>

            <button type="button" class="btn-tema" aria-label="Ganti mode terang atau gelap">
                <svg class="ikon-bulan" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
                <svg class="ikon-matahari" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="4.2" fill="currentColor"/><path d="M12 2v2.2M12 19.8V22M4.9 4.9l1.6 1.6M17.5 17.5l1.6 1.6M2 12h2.2M19.8 12H22M4.9 19.1l1.6-1.6M17.5 6.5l1.6-1.6"/></svg>
            </button>
        </div>
    </header>

    {{-- Sidebar --}}
    <aside class="offcanvas offcanvas-start app-sidebar" tabindex="-1" id="sidebarUtama" aria-label="Menu utama">
        <div class="offcanvas-header px-3 py-3">
            <a class="d-flex align-items-center gap-2 text-decoration-none text-body"
               href="{{ $navRole === 'admin' ? route('admin.dashboard') : route('siswa.dashboard') }}">
                <span class="nav-brand-mark" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v2"/><path d="M7 12a5 5 0 0 1 10 0"/><path d="M4 21V12h16v9"/><path d="M10 21v-4a2 2 0 0 1 4 0v4"/><path d="M2 21h20"/></svg>
                </span>
                <span class="nav-brand-text">Pengaduan Sarana Prasarana<small>Masjid</small></span>
            </a>
            <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" aria-label="Tutup"></button>
        </div>

        <div class="offcanvas-body">

            {{-- DITAMBAH: menu kembali ke Home di paling atas sidebar --}}
            <a href="{{ route('home') }}" class="side-link {{ $navPath === '' ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" aria-hidden="true">{!! $ik['kembali'] !!}</svg>
                <span>Kembali ke Home</span>
            </a>

            <div class="side-label">Menu</div>
            @foreach ($navMenu as $m)
                @php
                    $aktif = $navPath === $m[2] || strpos($navPath, $m[2] . '/') === 0;
                    if ($m[0] === 'Dashboard') { $aktif = $navPath === $m[2]; }
                @endphp
                <a href="{{ route($m[1]) }}" class="side-link {{ $aktif ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" aria-hidden="true">{!! $m[3] !!}</svg>
                    <span>{{ $m[0] }}</span>
                </a>
            @endforeach

            @if (count($navSistem))
                <div class="side-label">Sistem</div>
                @foreach ($navSistem as $m)
                    @php $aktif = $navPath === $m[2] || strpos($navPath, $m[2] . '/') === 0; @endphp
                    <a href="{{ route($m[1]) }}" class="side-link {{ $aktif ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" aria-hidden="true">{!! $m[3] !!}</svg>
                        <span>{{ $m[0] }}</span>
                    </a>
                @endforeach
            @endif

            <div class="side-user mt-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="side-avatar">{{ strtoupper(mb_substr($navUser->username, 0, 1)) }}</div>
                    <div class="flex-grow-1" style="min-width:0">
                        <div class="nama">{{ $navUser->username }}</div>
                        <small class="text-secondary text-capitalize">{{ $navRole }}</small>
                    </div>
                    <button type="button" class="btn-tema" aria-label="Ganti mode terang atau gelap" title="Ganti tema">
                        <svg class="ikon-bulan" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
                        <svg class="ikon-matahari" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="4.2" fill="currentColor"/><path d="M12 2v2.2M12 19.8V22M4.9 4.9l1.6 1.6M17.5 17.5l1.6 1.6M2 12h2.2M19.8 12H22M4.9 19.1l1.6-1.6M17.5 6.5l1.6-1.6"/></svg>
                    </button>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2 rounded-pill">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $ik['keluar'] !!}</svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </aside>

@else

    {{-- Belum login (halaman welcome/login/daftar): top bar sederhana tanpa sidebar --}}
    <header class="app-topbar sticky-top">
        <div class="container d-flex align-items-center gap-2 py-2">
            <a class="d-flex align-items-center gap-2 text-decoration-none text-body me-auto" href="{{ route('home') }}">
                <span class="nav-brand-mark" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v2"/><path d="M7 12a5 5 0 0 1 10 0"/><path d="M4 21V12h16v9"/><path d="M10 21v-4a2 2 0 0 1 4 0v4"/><path d="M2 21h20"/></svg>
                </span>
                <span class="nav-brand-text">
                    <span class="d-none d-sm-inline">Pengaduan Sarana Prasarana Masjid</span>
                    <span class="d-sm-none">Pengaduan Masjid</span>
                </span>
            </a>

            {{-- DIUBAH: tombol Home sekarang selalu tampil (termasuk di halaman welcome) --}}
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 d-inline-flex align-items-center gap-1">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $ik['kembali'] !!}</svg>
                Home
            </a>

            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Login</a>
            <a href="{{ route('register') }}" class="btn btn-sm btn-primary rounded-pill px-3 d-none d-sm-inline-block">Daftar</a>

            <button type="button" class="btn-tema" aria-label="Ganti mode terang atau gelap" title="Ganti tema">
                <svg class="ikon-bulan" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
                <svg class="ikon-matahari" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="4.2" fill="currentColor"/><path d="M12 2v2.2M12 19.8V22M4.9 4.9l1.6 1.6M17.5 17.5l1.6 1.6M2 12h2.2M19.8 12H22M4.9 19.1l1.6-1.6M17.5 6.5l1.6-1.6"/></svg>
            </button>
        </div>
    </header>

    <style>body { padding-left: 0 !important; }</style>

@endif

<script>
    (function () {
        var kunci = 'tema';
        var html = document.documentElement;

        function terapkan(tema) { html.setAttribute('data-bs-theme', tema); }

        var simpan = null;
        try { simpan = localStorage.getItem(kunci); } catch (e) {}
        var awal = simpan || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        terapkan(awal);

        document.querySelectorAll('.btn-tema').forEach(function (tombol) {
            tombol.addEventListener('click', function () {
                var baru = html.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
                terapkan(baru);
                try { localStorage.setItem(kunci, baru); } catch (e) {}

                tombol.classList.add('putar');
                setTimeout(function () { tombol.classList.remove('putar'); }, 350);
            });
        });
    })();
</script>