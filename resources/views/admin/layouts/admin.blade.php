<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background-color: #f8f9fa;
            width: 220px;
            transition: all 0.3s;
        }
        .sidebar-sticky {
            position: relative;
            top: 0;
            height: 100vh;
            padding-top: 1rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
        .navbar {
            z-index: 1030;
            height: 60px;
            margin-left: 220px;
            width: calc(100% - 220px);
            position: fixed;
            left: 0;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid #e9ecef;
            transition: all 0.3s;
        }
        .navbar-brand {
            margin-left: auto;
            color: #333333;
        }
        .navbar .nav-link {
            color: #333333;
        }
        .main-content {
            margin-left: 260px;
            padding: 20px;
            padding-top: 70px;
            transition: all 0.3s;
        }
        .nav-link {
            color: #333333;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .nav-link:hover, .nav-link.active {
            background-color: #ec1c24;
            color: white;
        }
        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border: none;
            margin-bottom: 20px;
        }
        .card .card-body {
            text-align: center;
        }
        .card h5 {
            font-weight: bold;
            color: #333333;
        }
        .card p {
            font-size: 2rem;
            font-weight: bold;
            color: #ec1c24;
        }
        .sidebar-logo {
            text-align: center;
            padding: 20px;
        }
        .sidebar-logo img {
            height: 80px;
        }
        
        /* Spinner CSS */
        .spinner-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #f8f9fa; /* Warna latar belakang spinner */
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 1;
            visibility: visible;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            color: #ec1c24; /* Warna animasi spinner */
            animation: spin 1s linear infinite;
        }

        .spinner-text {
            margin-top: 10px;
            color: #ec1c24; /* Warna teks spinner */
            font-weight: 500;
        }

        /* Efek rotasi spinner */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Menyembunyikan spinner ketika loading selesai */
        body:not(.loading) .spinner-container {
            opacity: 0;
            visibility: hidden;
        }

        /* Sembunyikan konten saat spinner tampil */
        body.loading .container {
            visibility: hidden;
        }

        /* Tampilkan konten saat loading selesai */
        body:not(.loading) .container {
            visibility: visible;
        }

        .chart-container {
            position: relative;
            margin: auto;
            height: 300px;
            width: 100%;
        }
        .navbar .nav-item .nav-link:hover,
        .navbar .nav-item .nav-link:focus,
        .navbar .nav-item.show .nav-link {
            color: white !important;
            background-color: #ec1c24;
        }
        .navbar .nav-item .dropdown-toggle::after {
            transition: transform 0.3s ease;
        }
        .navbar .nav-item.show .dropdown-toggle::after {
            transform: rotate(180deg);
        }
        .navbar .nav-item .dropdown-toggle {
            transition: background-color 0.3s ease;
        }
        .navbar .nav-item.show .dropdown-toggle {
            background-color: #ec1c24;
        }
        .search-form .form-control:focus {
            box-shadow: 0px 0px 10px 2px rgba(236, 28, 36, 0.5);
            border-color: #ec1c24;
        }
        .search-form .form-control {
            border: 1px solid #000;
        }
        .navbar .profile-icon {
            margin-right: 8px;
        }
        .download-csv {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }
        .toast-container {
            position: fixed;
            top: 70px;
            right: 20px;
            z-index: 1050;
        }
        .btn-custom-outline {
            color: #000;
            border: 1px solid #000;
            background-color: transparent;
        }
        .btn-custom-outline:hover {
            color: white;
            background-color: #ec1c24;
        }
        #sidebarCollapse {
            background: none;
            border: none;
            font-size: 1.5rem;
            padding: 0 15px;
            cursor: pointer;
        }
        .sidebar.active {
            margin-left: -220px;
        }
        #sidebarToggleIcon {
            transition: transform 0.3s ease, opacity 0.3s ease;  /* Animasi perpindahan smooth */
        }

        .sidebar-collapsed #sidebarToggleIcon {
            transform: rotate(180deg);  /* Efek rotasi saat sidebar ditutup */
        }

        body.sidebar-collapsed .navbar,
        body.sidebar-collapsed .main-content {
            margin-left: 0;
            width: 100%;
        }
        
        /* SIDEBAR default hidden (off-canvas) in mobile */
        @media (max-width: 768px) {
            .sidebar {
                transition: all 0.2s ease-in-out; /* Tambah transisi smooth */
            }

            .sidebar.active {
                transform: translateX(-210px); /* Tampilkan sidebar ketika active */
                transition: all 0.2s ease-in-out; /* Tambah transisi smooth */
            }

            .navbar {
                margin-left: 0;
                width: 100%;
            }

            /* Mengatur ulang navbar agar elemen tidak turun */
            .navbar .navbar-nav {
                width: 100%;
                text-align: center;
                display: flex;
                justify-content: space-between;
            }

            .navbar .nav-item {
                flex: 1;
            }

            /* Mengatur dropdown agar tidak berantakan */
            .navbar .nav-item.dropdown {
                position: relative;
            }

            .navbar .dropdown-menu {
                position: absolute;
                top: 60px; /* Pastikan dropdown muncul di bawah navbar */
                left: auto;
                right: 10px; /* Agar dropdown tidak meluber */
                z-index: 1051;
                width: 90%; /* Menyesuaikan lebar dropdown di mobile */
            }

            /* Menyesuaikan padding untuk dropdown item agar rapi */
            .navbar .dropdown-menu .dropdown-item {
                padding: 10px 15px;
            }

            /* Sesuaikan jarak dan padding item lainnya di navbar */
            .navbar .nav-link {
                padding-left: 10px;
                padding-right: 10px;
            }

            /* Sesuaikan tampilan ikon profil */
            .navbar .profile-icon {
                margin-right: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .overlay-active .main-content {
                margin-left: 0; /* Tetap penuh meskipun sidebar terbuka */
            }

            /* Mengatur jarak sidebar agar logo Adhi Karya tidak tertutup */
            .sidebar-logo {
                margin-top: 50px;
            }
        }
        
        .search-btn {
            background-color: #ec1c24;
            color: white;
            border: 1px solid #ec1c24;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .search-btn:hover {
            background-color: #c4161c;
            border-color: #c4161c;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .search-btn i {
            color: white;
        }
        .search-container {
            position: absolute;
            top: 60px; /* Updated */
            right: 10px;
            width: 300px;
            padding: 0;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .search-container.show {
            display: block !important;
        }
        .search-form {
            display: flex;
        }
        .search-form .form-control {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .search-btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            margin-left: -1px;
        }

        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 999;
            width: 50px;
            height: 50px;
            background-color: #ec1c24;
            border: none;
            color: white;
            padding: 0;
            transition: background-color 0.3s;
            border-radius: 50%;
            cursor: pointer;
            display: none;
            justify-content: center;
            align-items: center;
        }

        .back-to-top:hover {
            background-color: #d11a20;
            transform: scale(1.05) rotateY(5deg) rotateX(5deg);
        }

        .back-to-top svg {
            width: 24px;
            height: 24px;
            fill: currentColor; /* Menggunakan warna teks saat ini (putih) */
        }

        body {
            background-color: #ffffff;
            color: #333333;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Sidebar Menu Styling */
        .nav-item > .nav-link {
            color: #333;
            padding: 10px 15px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-item > .nav-link:hover {
            background-color: #ec1c24;
            color: #fff;
        }

        .nav-item > .nav-link.active,
        .nav-item > .nav-link[aria-expanded="true"] {
            background-color: #ec1c24;
            color: #fff;
        }

        /* Rotate icon saat expanded */
        .nav-item > .nav-link[aria-expanded="true"] .rotate-icon {
            transform: rotate(90deg);
            transition: transform 0.3s ease;
        }

        /* Override posisi modal logout agar muncul lebih ke atas */
        #logoutModal .modal-dialog {
            bottom: 100px; /* Posisikan modal lebih dekat ke atas layar */
            transform: translateY(0); /* Hilangkan efek vertikal tengah */
        }
    </style>
    @yield('additional_css')
</head>
<body class="loading">
    <!-- Spinner Section -->
    <div class="spinner-container">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-text">Mohon tunggu...</div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light fixed-top">
        <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="hamburger">
                <i id="sidebarToggleIcon" class="bi bi-list"></i>
            </button>

            <div class="ms-auto d-flex align-items-center">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle profile-icon"></i> Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}" id="logoutLink">
                                    <i class="bi bi-box-arrow-right me-2 logout-icon"></i>
                                    <span class="logout-text">Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="sidebar-sticky pt-3">
                    <!-- Sidebar Logo -->
                    <div class="sidebar-logo">
                        <a href="{{ route('admin.dashboard') }}">
                            <img src="{{ asset('images/adhi-karya.png') }}" alt="Adhi Karya">
                        </a>
                    </div>
                    <ul class="nav flex-column">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>DASHBOARD
                            </a>
                        </li>

                        <!-- SCENARIO Section -->
                        <li class="nav-item">
                            <!-- Include all relevant routes in the conditional for proper highlighting -->
                            <a class="nav-link collapsed 
                            {{ request()->is('admin/jasa-konstruksi*') || request()->is('admin/manufacturing*') || request()->is('admin/jasa-non-konstruksi*') || request()->is('admin/capex-procurement*') || request()->is('admin/internal-project*') ? '' : 'collapsed' }}" 
                            data-bs-toggle="collapse" 
                            href="#scenarioMenu" 
                            role="button" 
                            aria-expanded="{{ request()->is('admin/jasa-konstruksi*') || request()->is('admin/manufacturing*') || request()->is('admin/jasa-non-konstruksi*') || request()->is('admin/capex-procurement*') || request()->is('admin/internal-project*') ? 'true' : 'false' }}" 
                            aria-controls="scenarioMenu">
                                <i class="bi bi-folder me-2"></i>SCENARIO
                                <i class="bi bi-chevron-right float-end rotate-icon"></i>
                            </a>
                            <div class="collapse 
                            {{ request()->is('admin/jasa-konstruksi*') || request()->is('admin/manufacturing*') || request()->is('admin/jasa-non-konstruksi*') || request()->is('admin/capex-procurement*') || request()->is('admin/internal-project*') ? 'show' : '' }}" id="scenarioMenu">
                                <ul class="nav flex-column ps-3">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/jasa-konstruksi*') ? 'active' : '' }}" href="{{ route('jasa-konstruksi.index') }}">
                                            <i></i>Jasa Konstruksi
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/manufacturing*') ? 'active' : '' }}" href="{{ route('manufacturing.index') }}">
                                            <i></i>Manufacturing
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/jasa-non-konstruksi*') ? 'active' : '' }}" href="{{ route('jasa-non-konstruksi.index') }}">
                                            <i></i>Jasa Non Konstruksi
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/capex-procurement*') ? 'active' : '' }}" href="{{ route('capex-procurement.index') }}">
                                            <i></i>Capex Procurement
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/internal-project*') ? 'active' : '' }}" href="{{ route('internal-project.index') }}">
                                            <i></i>Internal Project
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <!-- INFO Section -->
                        <li class="nav-item">
                            <a class="nav-link collapsed 
                            {{ request()->is('admin/info-general*') || request()->is('admin/fico-fm*') || request()->is('admin/mm*') || request()->is('admin/ps*') || request()->is('admin/sd*') ? '' : 'collapsed' }}" 
                            data-bs-toggle="collapse" 
                            href="#infoMenu" 
                            role="button" 
                            aria-expanded="{{ request()->is('admin/info-general*') || request()->is('admin/fico-fm*') || request()->is('admin/mm*') || request()->is('admin/ps*') || request()->is('admin/sd*') ? 'true' : 'false' }}" 
                            aria-controls="infoMenu">
                                <i class="bi bi-info-circle me-2"></i>INFORMATION UPDATES
                                <i class="bi bi-chevron-right float-end rotate-icon"></i>
                            </a>
                            <div class="collapse 
                            {{ request()->is('admin/info-general*') || request()->is('admin/fico-fm*') || request()->is('admin/mm*') || request()->is('admin/ps*') || request()->is('admin/sd*') ? 'show' : '' }}" id="infoMenu">
                                <ul class="nav flex-column ps-3">                                    
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/info-general*') ? 'active' : '' }}" href="{{ route('info-general.index') }}">
                                            <i></i>Info General
                                        </a>
                                    </li>                                  
                                </ul>
                                <ul class="nav flex-column ps-3">                                    
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/fico-fm*') ? 'active' : '' }}" href="{{ route('fico-fm.index') }}">
                                            <i></i>FICO/FM Module
                                        </a>
                                    </li>                                  
                                </ul>
                                <ul class="nav flex-column ps-3">                                    
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/ps*') ? 'active' : '' }}" href="{{ route('ps.index') }}">
                                            <i></i>PS Module
                                        </a>
                                    </li>                                  
                                </ul>
                                <ul class="nav flex-column ps-3">                                    
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/sd*') ? 'active' : '' }}" href="{{ route('sd.index') }}">
                                            <i></i>SD Module
                                        </a>
                                    </li>                                  
                                </ul>
                                <ul class="nav flex-column ps-3">                                    
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/mm*') ? 'active' : '' }}" href="{{ route('mm.index') }}">
                                            <i></i>MM Module
                                        </a>
                                    </li>                                  
                                </ul>
                            </div>
                        </li>

                        <!-- FAQ Section -->
                        <li class="nav-item">
                            <a class="nav-link 
                            {{ request()->is('admin/faq/faq-general*') || request()->is('admin/faq/faq-jasa-konstruksi/*') || request()->is('admin/faq/faq-manufacturing/*') || request()->is('admin/faq/faq-jasa-non-konstruksi/*') || request()->is('admin/faq/faq-capex-procurement/*') || request()->is('admin/faq/faq-internal-project/*') ? '' : 'collapsed' }}" 
                            data-bs-toggle="collapse" 
                            href="#faqMenu" 
                            role="button" 
                            aria-expanded="{{ request()->is('admin/faq/faq-general*') || request()->is('admin/faq/faq-jasa-konstruksi/*') || request()->is('admin/faq/faq-manufacturing/*') || request()->is('admin/faq/faq-jasa-non-konstruksi/*') || request()->is('admin/faq/faq-capex-procurement/*') || request()->is('admin/faq/faq-internal-project/*') ? 'true' : 'false' }}"
                            aria-controls="faqMenu">
                                <i class="bi bi-question-circle me-2"></i>FAQ
                                <i class="bi bi-chevron-right float-end rotate-icon"></i>
                            </a>
                            <div class="collapse 
                            {{ request()->is('admin/faq/faq-general*') || request()->is('admin/faq/faq-jasa-konstruksi/*') || request()->is('admin/faq/faq-manufacturing/*') || request()->is('admin/faq/faq-jasa-non-konstruksi/*') || request()->is('admin/faq/faq-capex-procurement/*') || request()->is('admin/faq/faq-internal-project/*') ? 'show' : '' }}" id="faqMenu">
                                <ul class="nav flex-column ps-3">
                                    <!-- FAQ General -->
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/faq/faq-general*') ? 'active' : '' }}" href="{{ route('faq-general.index') }}">
                                            <i></i>General
                                        </a>
                                    </li>

                                    <!-- FAQ Jasa Konstruksi -->
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/faq/faq-jasa-konstruksi/*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#faqJasaKonstruksiMenu" role="button" aria-expanded="{{ request()->is('admin/faq/faq-jasa-konstruksi/*') ? 'true' : 'false' }}" aria-controls="faqJasaKonstruksiMenu">
                                            <i></i>Jasa Konstruksi
                                            <i class="bi bi-chevron-right float-end rotate-icon"></i>
                                        </a>
                                        <div class="collapse {{ request()->is('admin/faq/faq-jasa-konstruksi/*') ? 'show' : '' }}" id="faqJasaKonstruksiMenu">
                                            <ul class="nav flex-column ps-3">
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-jasa-konstruksi/general*') ? 'active' : '' }}" href="{{ route('faq-jasa-konstruksi.general.index') }}"><i></i>General</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-jasa-konstruksi/fi-module*') ? 'active' : '' }}" href="{{ route('faq-jasa-konstruksi.fi-module.index') }}"><i></i>FI Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-jasa-konstruksi/sd-module*') ? 'active' : '' }}" href="{{ route('faq-jasa-konstruksi.sd-module.index') }}"><i></i>SD Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-jasa-konstruksi/ps-module*') ? 'active' : '' }}" href="{{ route('faq-jasa-konstruksi.ps-module.index') }}"><i></i>PS Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-jasa-konstruksi/co-fm-module*') ? 'active' : '' }}" href="{{ route('faq-jasa-konstruksi.co-fm-module.index') }}"><i></i>CO/FM Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-jasa-konstruksi/mm-module*') ? 'active' : '' }}" href="{{ route('faq-jasa-konstruksi.mm-module.index') }}"><i></i>MM Module</a></li>
                                            </ul>
                                        </div>
                                    </li>

                                    <!-- FAQ Manufacturing -->
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/faq/faq-manufacturing/*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#faqManufacturingMenu" role="button" aria-expanded="{{ request()->is('admin/faq/faq-manufacturing/*') ? 'true' : 'false' }}" aria-controls="faqManufacturingMenu">
                                            <i></i>Manufacturing
                                            <i class="bi bi-chevron-right float-end rotate-icon"></i>
                                        </a>
                                        <div class="collapse {{ request()->is('admin/faq/faq-manufacturing/*') ? 'show' : '' }}" id="faqManufacturingMenu">
                                            <ul class="nav flex-column ps-3">
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-manufacturing/general*') ? 'active' : '' }}" href="{{ route('faq-manufacturing.general.index') }}"><i></i>General</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-manufacturing/fi-module*') ? 'active' : '' }}" href="{{ route('faq-manufacturing.fi-module.index') }}"><i></i>FI Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-manufacturing/sd-module*') ? 'active' : '' }}" href="{{ route('faq-manufacturing.sd-module.index') }}"><i></i>SD Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-manufacturing/ps-module*') ? 'active' : '' }}" href="{{ route('faq-manufacturing.ps-module.index') }}"><i></i>PS Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-manufacturing/co-fm-module*') ? 'active' : '' }}" href="{{ route('faq-manufacturing.co-fm-module.index') }}"><i></i>CO/FM Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-manufacturing/mm-module*') ? 'active' : '' }}" href="{{ route('faq-manufacturing.mm-module.index') }}"><i></i>MM Module</a></li>
                                            </ul>
                                        </div>
                                    </li>

                                    <!-- FAQ Jasa Non Konstruksi -->
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/faq/faq-jasa-non-konstruksi/*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#faqJasaNonKonstruksiMenu" role="button" aria-expanded="{{ request()->is('admin/faq/faq-jasa-non-konstruksi/*') ? 'true' : 'false' }}" aria-controls="faqJasaNonKonstruksiMenu">
                                            <i></i>Jasa Non Konstruksi
                                            <i class="bi bi-chevron-right float-end rotate-icon"></i>
                                        </a>
                                        <div class="collapse {{ request()->is('admin/faq/faq-jasa-non-konstruksi/*') ? 'show' : '' }}" id="faqJasaNonKonstruksiMenu">
                                            <ul class="nav flex-column ps-3">
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-jasa-non-konstruksi/general*') ? 'active' : '' }}" href="{{ route('faq-jasa-non-konstruksi.general.index') }}"><i></i>General</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-jasa-non-konstruksi/fi-module*') ? 'active' : '' }}" href="{{ route('faq-jasa-non-konstruksi.fi-module.index') }}"><i></i>FI Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-jasa-non-konstruksi/sd-module*') ? 'active' : '' }}" href="{{ route('faq-jasa-non-konstruksi.sd-module.index') }}"><i></i>SD Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-jasa-non-konstruksi/ps-module*') ? 'active' : '' }}" href="{{ route('faq-jasa-non-konstruksi.ps-module.index') }}"><i></i>PS Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-jasa-non-konstruksi/co-fm-module*') ? 'active' : '' }}" href="{{ route('faq-jasa-non-konstruksi.co-fm-module.index') }}"><i></i>CO/FM Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-jasa-non-konstruksi/mm-module*') ? 'active' : '' }}" href="{{ route('faq-jasa-non-konstruksi.mm-module.index') }}"><i></i>MM Module</a></li>
                                            </ul>
                                        </div>
                                    </li>

                                    <!-- FAQ Capex Procurement -->
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/faq/faq-capex-procurement/*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#faqCapexProcurementMenu" role="button" aria-expanded="{{ request()->is('admin/faq/faq-capex-procurement/*') ? 'true' : 'false' }}" aria-controls="faqCapexProcurementMenu">
                                            <i></i>Capex Procurement
                                            <i class="bi bi-chevron-right float-end rotate-icon"></i>
                                        </a>
                                        <div class="collapse {{ request()->is('admin/faq/faq-capex-procurement/*') ? 'show' : '' }}" id="faqCapexProcurementMenu">
                                            <ul class="nav flex-column ps-3">
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-capex-procurement/general*') ? 'active' : '' }}" href="{{ route('faq-capex-procurement.general.index') }}"><i></i>General</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-capex-procurement/fi-module*') ? 'active' : '' }}" href="{{ route('faq-capex-procurement.fi-module.index') }}"><i></i>FI Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-capex-procurement/sd-module*') ? 'active' : '' }}" href="{{ route('faq-capex-procurement.sd-module.index') }}"><i></i>SD Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-capex-procurement/ps-module*') ? 'active' : '' }}" href="{{ route('faq-capex-procurement.ps-module.index') }}"><i></i>PS Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-capex-procurement/co-fm-module*') ? 'active' : '' }}" href="{{ route('faq-capex-procurement.co-fm-module.index') }}"><i></i>CO/FM Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-capex-procurement/mm-module*') ? 'active' : '' }}" href="{{ route('faq-capex-procurement.mm-module.index') }}"><i></i>MM Module</a></li>
                                            </ul>
                                        </div>
                                    </li>

                                    <!-- FAQ Internal Project -->
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('admin/faq/faq-internal-project/*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#faqInternalProjectMenu" role="button" aria-expanded="{{ request()->is('admin/faq/faq-internal-project/*') ? 'true' : 'false' }}" aria-controls="faqInternalProjectMenu">
                                            <i></i>Internal Project
                                            <i class="bi bi-chevron-right float-end rotate-icon"></i>
                                        </a>
                                        <div class="collapse {{ request()->is('admin/faq/faq-internal-project/*') ? 'show' : '' }}" id="faqInternalProjectMenu">
                                            <ul class="nav flex-column ps-3">
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-internal-project/general*') ? 'active' : '' }}" href="{{ route('faq-internal-project.general.index') }}"><i></i>General</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-internal-project/fi-module*') ? 'active' : '' }}" href="{{ route('faq-internal-project.fi-module.index') }}"><i></i>FI Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-internal-project/sd-module*') ? 'active' : '' }}" href="{{ route('faq-internal-project.sd-module.index') }}"><i></i>SD Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-internal-project/ps-module*') ? 'active' : '' }}" href="{{ route('faq-internal-project.ps-module.index') }}"><i></i>PS Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-internal-project/co-fm-module*') ? 'active' : '' }}" href="{{ route('faq-internal-project.co-fm-module.index') }}"><i></i>CO/FM Module</a></li>
                                                <li class="nav-item"><a class="nav-link {{ request()->is('admin/faq/faq-internal-project/mm-module*') ? 'active' : '' }}" href="{{ route('faq-internal-project.mm-module.index') }}"><i></i>MM Module</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                @yield('content')
            </main>
            
            <!-- Modal Konfirmasi Logout -->
            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin logout dari dashboard admin?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger" id="confirmLogout" autofocus="false">Logout</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Back to Top Button -->
    <button class="back-to-top btn btn-danger rounded-circle">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 24 24">
            <path d="M12 5l7 7-1.41 1.41L12 7.83l-5.59 5.58L5 12z"/>
        </svg>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        // Spinner hide function
        window.addEventListener('load', function() {
            document.body.classList.remove('loading');
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Bind the logout link to open the modal instead of submitting the form directly
            const logoutLink = document.getElementById('logoutLink');
            const logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
            const confirmLogoutButton = document.getElementById('confirmLogout');

            // Trigger modal saat logout link diklik
            logoutLink.addEventListener('click', function(event) {
                event.preventDefault();  // Mencegah submit langsung
                logoutModal.show();      // Buka modal konfirmasi
            });

            // Submit form setelah confirm logout
            confirmLogoutButton.addEventListener('click', function() {
                document.getElementById('logout-form').submit();  // Submit form setelah dikonfirmasi
            });
  

            var loginSuccessToast = document.getElementById('loginSuccessToast');
            if (loginSuccessToast) {
                var toast = new bootstrap.Toast(loginSuccessToast);
                toast.show();
            }

            // Sidebar toggle
            var sidebarCollapse = document.getElementById('sidebarCollapse');
            var sidebar = document.getElementById('sidebarMenu');
            var sidebarToggleIcon = document.getElementById('sidebarToggleIcon');
            var body = document.body;

            var overlay = document.createElement('div');
            overlay.classList.add('overlay');
            document.body.appendChild(overlay);

            // Cek status sidebar dari localStorage saat halaman dimuat
            var sidebarStatus = localStorage.getItem('sidebarStatus');

            // When the page loads, check if we are in mobile view and close the sidebar automatically
            if (window.innerWidth <= 768) {
                sidebar.classList.add('active');  // Force sidebar to close by default
                sidebarToggleIcon.classList.remove('bi-x');
                sidebarToggleIcon.classList.add('bi-list');
                body.classList.add('sidebar-collapsed');
            } else if (sidebarStatus === 'closed') {
                sidebar.classList.add('active');  // Tetap tertutup
                sidebarToggleIcon.classList.remove('bi-x');
                sidebarToggleIcon.classList.add('bi-list');
                body.classList.add('sidebar-collapsed');
            } else {
                sidebar.classList.remove('active');  // Tetap terbuka
                sidebarToggleIcon.classList.remove('bi-list');
                sidebarToggleIcon.classList.add('bi-x');
                body.classList.remove('sidebar-collapsed');
            }

            sidebarCollapse.addEventListener('click', function () {
                sidebar.classList.toggle('active');
                body.classList.toggle('sidebar-collapsed');

                overlay.classList.toggle('show');
                body.classList.toggle('overlay-active');

                if (sidebar.classList.contains('active')) {
                    sidebarToggleIcon.classList.remove('bi-x');
                    sidebarToggleIcon.classList.add('bi-list');
                    localStorage.setItem('sidebarStatus', 'closed');
                } else {
                    sidebarToggleIcon.classList.remove('bi-list');
                    sidebarToggleIcon.classList.add('bi-x');
                    localStorage.setItem('sidebarStatus', 'open');
                }

                if (window.innerWidth <= 768) {
                    body.classList.toggle('sidebar-active');
                }
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth <= 768) {
                    sidebar.classList.add('active');
                    body.classList.remove('sidebar-collapsed');
                    body.classList.remove('sidebar-active');
                    sidebarToggleIcon.classList.remove('bi-x');
                    sidebarToggleIcon.classList.add('bi-list');
                } else {
                    sidebar.classList.remove('active');
                    body.classList.remove('sidebar-collapsed');
                    body.classList.remove('sidebar-active');
                    sidebarToggleIcon.classList.remove('bi-list');
                    sidebarToggleIcon.classList.add('bi-x');
                }
            });

            // Overlay hide sidebar in mobile mode
            overlay.addEventListener('click', function () {
                sidebar.classList.remove('active');
                overlay.classList.remove('show');
                body.classList.remove('overlay-active');
                sidebarToggleIcon.classList.replace('bi-x', 'bi-list');
            });

            // Make sure on mobile, the sidebar is hidden after page loads
            if (window.innerWidth <= 768) {
                sidebar.classList.add('active');
                body.classList.add('sidebar-collapsed');
                sidebarToggleIcon.classList.add('bi-list');
                sidebarToggleIcon.classList.remove('bi-x');
            }

            // Dark Mode Toggle
            const darkModeToggle = document.getElementById('darkModeToggle');
            const darkModeIcon = document.getElementById('darkModeIcon');

            // Cek status mode gelap di localStorage
            const isDarkMode = localStorage.getItem('darkMode') === 'enabled';

            if (isDarkMode) {
                body.classList.add('dark-mode');
                darkModeIcon.classList.replace('bi-moon', 'bi-sun');
            }

            // Toggle mode gelap/terang saat tombol di-klik
            darkModeToggle.addEventListener('click', function() {
                body.classList.toggle('dark-mode');
                const darkModeEnabled = body.classList.contains('dark-mode');

                // Ubah ikon sesuai mode
                if (darkModeEnabled) {
                    darkModeIcon.classList.replace('bi-moon', 'bi-sun');
                    localStorage.setItem('darkMode', 'enabled');
                } else {
                    darkModeIcon.classList.replace('bi-sun', 'bi-moon');
                    localStorage.setItem('darkMode', 'disabled');
                }
            });

            // Search toggle functionality
            const searchToggle = document.getElementById('searchToggle');
            const searchContainer = document.getElementById('searchContainer');

            searchToggle.addEventListener('click', function() {
                searchContainer.classList.toggle('d-none');
                searchContainer.classList.toggle('show');
            });

            // Close search bar when clicking outside
            document.addEventListener('click', function(event) {
                if (!searchContainer.contains(event.target) && !searchToggle.contains(event.target)) {
                    searchContainer.classList.add('d-none');
                    searchContainer.classList.remove('show');
                }
            });
        });

        // Back to Top functionality
        window.onscroll = function() {
            var backToTop = document.querySelector('.back-to-top');
            if (window.pageYOffset > 150) {
                backToTop.style.display = 'block';
            } else {
                backToTop.style.display = 'none';
            }
        };

        document.querySelector('.back-to-top').addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({top: 0, behavior: 'smooth'});
        });
    
    </script>
    @yield('additional_js')
</body>
</html>