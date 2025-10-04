<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Kepegawaian')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            z-index: 1050;
        }
        .navbar .dropdown-menu {
            position: absolute !important;
            top: 100%;   /* muncul di bawah icon/profile */
            right: 0;    /* sejajar kanan */
            left: auto;
            margin-top: 0.5rem; /* beri sedikit jarak */
            z-index: 2000; /* supaya di atas konten lain */
        }
        .sidebar {
            position: fixed;
            top: 56px;
            left: 0;
            height: calc(100% - 56px);
            width: 220px;
            background-color: #212529;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            margin: 6px 12px;
            padding: 10px 16px;
            border-radius: 6px;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover {
            background-color: #495057;
            color: #fff;
        }
        .sidebar .nav-link.active {
            background-color: #fff;
            color: #000;
            font-weight: bold;
        }
        .content {
            margin-left: 220px;
            margin-top: 56px;
            padding: 25px;
        }
        @media (max-width: 991px) {
            .content {
                margin-left: 0;
            }
            .sidebar {
                display: none; /* hide fixed sidebar on small screens */
            }
        }
    </style>
</head>
<body>
    {{-- 🔹 Navbar Fixed --}}
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <!-- Tombol Hamburger hanya muncul di layar kecil -->
            <button class="btn btn-dark d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
                <i class="bi bi-list fs-4"></i>
            </button>

            <a class="navbar-brand" href="{{ route('dashboard') }}">Arsip Surat</a>

            {{-- 🔹 Nama User + Dropdown Profile (selalu menyamping) --}}
            @auth
            <ul class="navbar-nav ms-auto mb-0 d-flex align-items-center flex-row">
                <li class="nav-item me-2 d-none d-sm-inline">
                    <span class="text-white">{{ auth()->user()->name }}</span>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-5"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            @endauth
        </div>
    </nav>

    {{-- 🔹 Sidebar untuk layar besar --}}
    <div class="sidebar d-none d-lg-block">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-house-heart-fill"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('suratmasuk.index') ? 'active' : '' }}" href="{{ route('suratmasuk.index') }}">
                    <i class="bi bi-envelope-arrow-down-fill"></i> Surat Masuk
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('suratkeluar') ? 'active' : '' }}" href="{{ route('suratkeluar') }}">
                    <i class="bi bi-envelope-arrow-up-fill"></i> Surat Keluar
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('laporan') ? 'active' : '' }}" href="{{ route('laporan') }}">
                    <i class="bi bi-file-text-fill"></i> Laporan
                </a>
            </li>
        </ul>
    </div>

    {{-- 🔹 Offcanvas Sidebar untuk layar kecil --}}
    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="offcanvasSidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('suratmasuk.index') ? 'active' : '' }}" href="{{ route('suratmasuk.index') }}">
                        Surat Masuk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('suratkeluar') ? 'active' : '' }}" href="{{ route('suratkeluar') }}">
                        Surat Keluar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('laporan') ? 'active' : '' }}" href="{{ route('laporan') }}">
                        Laporan
                    </a>
                </li>
            </ul>
        </div>
    </div>

    {{-- 🔹 Konten --}}
    <div class="content">
        @yield('content')
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>
