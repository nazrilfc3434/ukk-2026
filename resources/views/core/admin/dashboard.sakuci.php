@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    /* Styling Khusus Dashboard Tema Masjid */
    .hero-admin-card {
        background: linear-gradient(135deg, #0d3b2e 0%, #155e48 100%);
        border-radius: 16px;
        position: relative;
        overflow: hidden;
    }
    .hero-admin-card::after {
        content: '';
        position: absolute;
        right: -20px;
        bottom: -20px;
        width: 180px;
        height: 180px;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
    }
    .badge-gold {
        background-color: rgba(212, 175, 55, 0.2);
        color: #f1c40f;
        border: 1px solid rgba(212, 175, 55, 0.4);
    }
    .card-menu-admin {
        border-radius: 14px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        background: #ffffff;
    }
    .card-menu-admin:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(13, 59, 46, 0.12) !important;
        border-color: #d4af37 !important;
    }
    .icon-box-masjid {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        background-color: #f0f7f4;
        color: #0d3b2e;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .card-menu-admin:hover .icon-box-masjid {
        background-color: #0d3b2e;
        color: #d4af37;
    }
    .arrow-icon {
        color: #a0aec0;
        transition: transform 0.3s ease, color 0.3s ease;
    }
    .card-menu-admin:hover .arrow-icon {
        transform: translateX(5px);
        color: #0d3b2e;
    }
</style>

<div class="container-fluid px-0">
    <!-- Hero / Welcome Header Card -->
    <div class="hero-admin-card text-white p-4 p-md-5 mb-4 shadow-sm">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge rounded-pill badge-gold px-3 py-2 mb-3 d-inline-flex align-items-center gap-2">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2a4 4 0 0 1 4 4c0 2.2-1.8 4-4 4s-4-1.8-4-4a4 4 0 0 1 4-4z" fill="#D4AF37" stroke="none"/>
                        <path d="M12 10c-5 0-9 3.5-9 8v3h18v-3c0-4.5-4-8-9-8z" fill="currentColor"/>
                    </svg>
                    Panel Administrator Masjid
                </span>
                <h1 class="h3 fw-bold mb-2">Assalamu’alaikum, {{ $user->username }} 👋</h1>
                <p class="text-white-50 mb-0">Selamat datang di pusat pengelolaan sarana, prasarana, serta manajemen sistem informasi masjid.</p>
            </div>
            <div class="col-lg-4 d-none d-lg-block text-end">
                <div class="p-3 d-inline-block rounded-3" style="background: rgba(255,255,255,0.08); backdrop-filter: blur(4px);">
                    <small class="d-block text-white-50">Akses Hak Istimewa</small>
                    <span class="fw-semibold text-warning"><code class="text-warning fs-6">Middleware: admin</code></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Access Menu Grid -->
    <div class="mb-3">
        <h2 class="h6 text-uppercase fw-bold text-muted tracking-wide mb-3" style="letter-spacing: 1px;">
            Menu Pengelolaan
        </h2>
    </div>

    <div class="row g-4">
        <!-- Manage Role -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.roles.index') }}" class="card card-menu-admin shadow-sm text-decoration-none h-100 p-2">
                <div class="card-body p-3 d-flex align-items-start gap-3">
                    <div class="icon-box-masjid flex-shrink-0">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path d="M12 11a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                            <path d="M12 13c-2.7 0-5 1.3-5 3v1h10v-1c0-1.7-2.3-3-5-3z"/>
                        </svg>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <h2 class="h6 fw-bold text-dark mb-0">Manage Role</h2>
                            <span class="arrow-icon">→</span>
                        </div>
                        <p class="text-muted small mb-0">Atur & tambah hak akses peran baru untuk sistem.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Manage User -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.users.index') }}" class="card card-menu-admin shadow-sm text-decoration-none h-100 p-2">
                <div class="card-body p-3 d-flex align-items-start gap-3">
                    <div class="icon-box-masjid flex-shrink-0">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <h2 class="h6 fw-bold text-dark mb-0">Manage User</h2>
                            <span class="arrow-icon">→</span>
                        </div>
                        <p class="text-muted small mb-0">Kelola pengguna, tambah user, dan tentukan perannya.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Download Database -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.database.export') }}" class="card card-menu-admin shadow-sm text-decoration-none h-100 p-2">
                <div class="card-body p-3 d-flex align-items-start gap-3">
                    <div class="icon-box-masjid flex-shrink-0">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <ellipse cx="12" cy="5" rx="9" ry="3"/>
                            <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                            <path d="M12 12v7"/>
                            <path d="m9 16 3 3 3-3"/>
                        </svg>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <h2 class="h6 fw-bold text-dark mb-0">Backup Database</h2>
                            <span class="arrow-icon">↓</span>
                        </div>
                        <p class="text-muted small mb-0">Unduh cadangan data server dalam format `.sql`.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection