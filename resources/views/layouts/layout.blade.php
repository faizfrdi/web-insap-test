<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INSAP | PT Adhi Karya (Persero) Tbk.</title>
    <link rel="icon" href="{{ asset('images/logo-insap.png') }}" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        /* Loading overlay styles */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #f5f6fa;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.8s ease-in-out, visibility 0.8s ease-in-out;
        }

        .loading-content {
            text-align: center;
            position: relative;
        }

        .loading-logo-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin-bottom: 20px;
        }

        .loading-logo {
            width: 100px;
            height: 100px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .loading-progress {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .loading-progress svg {
            width: 150px;
            height: 150px;
            transform: rotate(-90deg);
        }

        .loading-progress circle {
            fill: none;
            stroke: #ec1c24;
            stroke-width: 3;
            stroke-linecap: round;
            stroke-dasharray: 440;
            stroke-dashoffset: 440;
            animation: progress 2s ease-out infinite;
        }

        .loading-text {
            font-size: 18px;
            color: #ec1c24;
            font-weight: 500;
            margin-top: 20px;
        }

        @keyframes progress {
            0% {
                stroke-dashoffset: 440;
            }
            50% {
                stroke-dashoffset: 0;
            }
            50.1% {
                stroke-dashoffset: 880;
            }
            100% {
                stroke-dashoffset: 440;
            }
        }

        /* Text fade animation */
        @keyframes fadeInOut {
            0% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        /* Hide loading screen */
        .loading-overlay.hidden {
            opacity: 0;
            visibility: hidden;
        }

        /* Ensure content is hidden during loading */
        body.is-loading .container {
            opacity: 0;
        }

        /* Show content after loading */
        body:not(.is-loading) .container {
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }
    </style>

</head>
<body class="d-flex flex-column min-vh-100 is-loading">
    <!-- Loading overlay -->
    <div class="loading-overlay">
        <div class="loading-content">
            <div class="loading-logo-container">
                <img src="{{ asset('images/adhi-karya.png') }}" alt="Logo" class="loading-logo">
                <div class="loading-progress">
                    <svg>
                        <circle cx="75" cy="75" r="60"></circle>
                    </svg>
                </div>
            </div>
            <div class="loading-text">Mohon tunggu...</div>
        </div>
    </div>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top" style="padding: 1rem 1.5rem;">
        <style>
            /* Styling untuk hamburger icon */
            .navbar-toggler {
                padding: 0;
                border: none;
                background: transparent;
                width: 30px;
                height: 30px;
                position: relative;
                outline: none !important;
                box-shadow: none !important;
            }

            /* Menghilangkan icon default bootstrap */
            .navbar-toggler-icon {
                display: none;
            }

            /* Membuat garis hamburger */
            .navbar-toggler span {
                width: 30px;
                height: 2px;
                background-color: #000;
                display: block;
                position: absolute;
                transition: all 0.3s ease;
            }

            /* Posisi garis-garis hamburger */
            .navbar-toggler span:nth-child(1) {
                top: 7px;
            }

            .navbar-toggler span:nth-child(2) {
                top: 15px;
            }

            .navbar-toggler span:nth-child(3) {
                top: 23px;
            }

            /* Animasi saat button active/expanded */
            .navbar-toggler[aria-expanded="true"] span:nth-child(1) {
                transform: rotate(45deg);
                top: 15px;
            }

            .navbar-toggler[aria-expanded="true"] span:nth-child(2) {
                opacity: 0;
            }

            .navbar-toggler[aria-expanded="true"] span:nth-child(3) {
                transform: rotate(-45deg);
                top: 15px;
            }

            /* Desktop styles (> 768px) */
            @media screen and (min-width: 769px) {
                .nav-item.dropdown:hover .dropdown-menu {
                    display: block;
                    visibility: visible;
                    opacity: 1;
                    transition: opacity 0.3s ease;
                }

                .dropdown-menu {
                    display: none;
                    visibility: hidden;
                    opacity: 0;
                    transition: opacity 0.3s ease;
                    position: absolute;
                }
            }

            /* Mobile styles (≤ 768px) */
            @media screen and (max-width: 768px) {
                .dropdown-menu {
                    position: static !important;
                    float: none;
                    width: 100%;
                    padding: 0;
                    margin: 0;
                    border: none;
                    box-shadow: none;
                    background-color: transparent;
                    max-height: 0;
                    overflow: hidden;
                    opacity: 0;
                    transition: max-height 0.3s ease, opacity 0.3s ease;
                }

                .dropdown-menu.show {
                    max-height: 500px;
                    opacity: 1;
                }

                .dropdown-item {
                    padding: .5rem 1.5rem;
                    color: inherit;
                }
            }

            /* Search form styling */
            .search-form {
                display: flex;
                align-items: stretch;
            }

            .search-form .form-control {
                border-top-right-radius: 0;
                border-bottom-right-radius: 0;
                border-top-left-radius: 10px;
                border-bottom-left-radius: 10px;
                border: 1px solid black;
                border-right: none;
                transition: all 0.15s ease-in-out;
                -webkit-appearance: none;
                appearance: none;
            }

            .search-form .search-btn {
                border-top-left-radius: 0;
                border-bottom-left-radius: 0;
                border-top-right-radius: 10px;
                border-bottom-right-radius: 10px;
                background-color: #ec1c24;
                border: none;
                color: white;
                padding: 0.375rem 0.75rem;
            }

            .search-form .form-control:hover {
                border-color: black;
            }

            .search-form .form-control:focus {
                border-color: black;
                border-right: none;
                box-shadow: none;
                outline: none;
            }

            .search-form .search-btn:hover,
            .search-form .search-btn:focus {
                background-color: #ec1c24;
                border: none;
                outline: none;
            }

            .search-form .search-btn::before {
                content: "";
                position: absolute;
                left: -1px;
                top: 1px;
                bottom: 1px;
                width: 1px;
                background-color: #ec1c24;
            }

            @media screen and (max-width: 768px) {
                .search-form .form-control {
                    border-width: 1px;
                    font-size: 16px;
                }
                
                .search-form .search-btn::before {
                    left: -1px;
                }
            }
        </style>

        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo-insap.png') }}" alt="Logo" style="height: 40px; margin-right: 15px;">
            </a>

            <!-- Hamburger Menu Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Navbar Items -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Beranda Section -->
                    <li class="nav-item me-1">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    
                    <!-- Scenario Section -->
                    <li class="nav-item dropdown me-1">
                        <a class="nav-link dropdown-toggle {{ Request::is('jasa-konstruksi*','jasa_konstruksi*', 'manufacturing*', 'jasa-non-konstruksi*', 'capex-procurement*', 'internal-project*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Scenario
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="nav-link dropdown-item {{ Request::is('jasa-konstruksi*', 'jasa_konstruksi*') ? 'active' : '' }}" href="{{ url('/jasa-konstruksi') }}">Jasa Konstruksi</a></li>
                            <!-- <li><a class="nav-link dropdown-item {{ Request::is('manufacturing') ? 'active' : '' }}" href="{{ url('/manufacturing') }}">Manufacturing</a></li>
                            <li><a class="nav-link dropdown-item {{ Request::is('jasa-non-konstruksi') ? 'active' : '' }}" href="{{ url('/jasa-non-konstruksi') }}">Jasa Non Konstruksi</a></li>
                            <li><a class="nav-link dropdown-item {{ Request::is('capex-procurement') ? 'active' : '' }}" href="{{ url('/capex-procurement') }}">Capex Procurement</a></li>
                            <li><a class="nav-link dropdown-item {{ Request::is('internal-project') ? 'active' : '' }}" href="{{ url('/internal-project') }}">Internal Project</a></li>
                             -->                            
                        </ul>
                    </li>

                    <!-- Info Section as Dropdown -->
                    <li class="nav-item dropdown me-1">
                        <a class="nav-link dropdown-toggle {{ Request::is('info/*') ? 'active' : '' }}" href="#" id="infoDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Information Updates
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="infoDropdown">
                            <li><a class="nav-link dropdown-item {{ Request::is('info/info-general*') ? 'active' : '' }}" href="{{ url('info/info-general') }}">General</a></li>
                            <li><a class="nav-link dropdown-item {{ Request::is('info/fico-fm*') ? 'active' : '' }}" href="{{ url('info/fico-fm') }}">FICO/FM Module</a></li>
                            <li><a class="nav-link dropdown-item {{ Request::is('info/ps*') ? 'active' : '' }}" href="{{ url('info/ps') }}">PS Module</a></li>
                            <li><a class="nav-link dropdown-item {{ Request::is('info/sd*') ? 'active' : '' }}" href="{{ url('info/sd') }}">SD Module</a></li>
                            <li><a class="nav-link dropdown-item {{ Request::is('info/mm*') ? 'active' : '' }}" href="{{ url('info/mm') }}">MM Module</a></li>
                        </ul>
                    </li>
                                        
                    <!-- FAQ Section -->
                    <li class="nav-item me-1">
                        <a class="nav-link {{ Request::is('faq*') ? 'active' : '' }}" href="{{ url('/faq') }}">FAQ</a>
                    </li>
                </ul>
                <!-- Search Form -->
                <form class="search-form" role="search" method="GET" action="{{ route('search') }}" style="border-radius: 15px; border: 1px solid #ddd; background-color: #fbfbfd; padding: 5px;">
                    <input class="form-control" type="search" name="q" placeholder="Cari di sini..." aria-label="Search" value="{{ request('q') }}" required style="border: none; outline: none; background: transparent; width: calc(100% - 45px); margin-right: 5px; height: 38px;">
                    <button class="btn search-btn" type="submit" style="border-radius: 5px; background-color: #ec1c24; border: none; color: white; height: 38px; width: 38px; display: flex; justify-content: center; align-items: center;">
                        <i class="bi bi-search" style="color: white;"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5 flex-grow-1">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-red text-white text-center py-6 mt-auto">
        <div class="container">
            <!-- Footer Row with Flexbox -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start text-start text-md-start">
                <!-- Copyright Section -->
                <div class="mb-2 mb-md-0 first-row">
                    <p class="mb-0 small-text">
                        &copy; {{ date('Y') }} Copyright by
                        <a href="{{ url('https://adhi.co.id/') }}" target="_blank" style="color: white; font-weight: bold; text-decoration: none;">
                            PT Adhi Karya (Persero) Tbk.
                        </a> 
                    </p>
                </div>

                <!-- Terms Section -->
                <div>
                    <p class="mb-0 small-text">
                        <span style="margin-right: 10px;">Terms</span> • 
                        <span style="margin-left: 10px; margin-right: 10px;">Privacy</span> • 
                        <span style="margin-left: 10px;">Support</span>
                    </p>
                </div>
            </div>

            <!-- Chat Widget (Chatbot) -->
            <div class="chat-widget mt-3">
                <a href="{{ url('/chatbot') }}" class="chat-icon">
                    <img src="{{ asset('images/chat-bot.png') }}" alt="Chat on Bot">
                </a>
            </div>

            <!-- Back to Top Button -->
            <div class="progress-btn-container">
                <div class="progress-circle">
                    <svg class="progress-ring" width="50" height="50">
                        <circle class="progress-ring-circle" stroke-width="4" fill="transparent" r="21" cx="25" cy="25"/>
                    </svg>
                    <button class="btn btn-back-to-top rounded-circle progress-btn" id="backToTop">
                        <i class="bi bi-arrow-up"></i>
                    </button>
                </div>
            </div>
        </div>
    </footer>

    <!-- Media Query CSS -->
    <style>
        /* Default font size for desktop (16px) */
        .small-text {
            font-size: 16px;
        }

        /* Font size for small screens (mobile) */
        @media screen and (max-width: 768px) {
            .small-text {
                font-size: 16px; /* Ukuran font sama untuk di mobile */
            }

            .first-row {
                margin-bottom: 17px !important; /* Berikan jarak bawah untuk baris pertama */
            }
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        if (window.innerWidth <= 768) {
            // Hapus event Bootstrap default
            const dropdownToggle = document.querySelector('.dropdown-toggle');
            dropdownToggle.setAttribute('data-bs-toggle', '');
            
            // Tambah event listener untuk toggle
            dropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                const dropdownMenu = this.nextElementSibling;
                dropdownMenu.classList.toggle('show');
            });
        }
    });
    </script>

    <style>
        .horizontal-divider {
            width: 100%; /* Membuat garis selebar container */
            border-top: 1px solid rgba(255, 255, 255, 0.8); /* Warna putih transparan */
            margin: 20px 0; /* Spasi di atas dan bawah garis */
        }

        .hover-underline {
            text-decoration: none;
            color: inherit;
        }

        .hover-underline:hover {
            text-decoration: underline;
        }

        /* Custom Styles for the Footer */
        footer {
            background-color: #ec1c24;
            color: #ffffff;
            padding: 40px 0;
        }

        footer a {
            color: #ffffff !important;
            text-decoration: none;
            transition: none; /* Menghapus efek hover */
        }

        footer a:hover {
            color: #ffffff !important; /* Menghapus perubahan warna saat hover */
        }

        footer h5 {
            color: #ffffff;
            font-size: 1.2rem;
            margin-bottom: 15px;
            font-weight: bold;
            text-transform: uppercase;
        }

        footer ul {
            padding-left: 0;
            list-style-type: none;
        }

        footer ul li {
            margin-bottom: 10px;
        }

        footer .col-md-3, footer .col-md-6 {
            padding: 20px;
            transition: none; /* Menghapus efek hover */
        }

        /* Menghapus perubahan latar belakang saat hover */
        footer .col-md-3:hover, footer .col-md-6:hover {
            background-color: transparent;
        }

        /* Social Media */
        footer .social-container {
            display: flex;
            justify-content: flex-start;
            gap: 15px;
        }

        footer .social-icon img {
            width: 20px;
            height: 20px;
            transition: none; /* Menghapus efek hover */
        }

        /* Menghapus efek perbesaran ikon saat hover */
        footer .social-icon:hover img {
            transform: none;
        }

        /* Chat Widget and Back to Top */
        .chat-widget {
            position: fixed;
            bottom: 80px;
            right: 20px;
            z-index: 1001;
        }

        .chat-widget .chat-icon img {
            width: 50px; /* Lebar gambar */
            height: 50px; /* Tinggi gambar */
            object-fit: cover; /* Memastikan gambar tidak terdistorsi */
            border-radius: 50%; /* Membuat gambar berbentuk lingkaran */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); /* Bayangan */
            background-color: #25D366; /* Warna latar belakang hijau */
            padding: 3px; /* Menambahkan jarak di sekitar gambar */
            transition: transform 0.3s ease, background-color 0.3s ease; /* Efek hover */
        }

        /* Efek hover */
        .chat-widget .chat-icon img:hover {
            transform: scale(1.1); /* Memperbesar gambar */
            background-color: #1eae59; /* Warna latar belakang saat hover */
        }

        /* Styles untuk progress button */
        .progress-btn-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            display: none;
        }

        .progress-circle {
            position: relative;
            width: 50px;
            height: 50px;
        }

        .progress-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40px;
            height: 40px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #0056b3;
            border: none;
        }

        .btn-back-to-top {
            background-color: #0056b3;
            border: 2px solid #0056b3;
            color: white;
        }

        .btn-back-to-top:hover,
        .btn-back-to-top:focus,
        .btn-back-to-top:active,
        .btn-back-to-top.active {
            background-color: #007bff !important;
            border-color: #007bff !important;
            color: white !important;
            box-shadow: none !important;
        }

        .progress-ring {
            position: absolute;
            top: 0;
            left: 0;
            transform: rotate(-90deg);
        }

        .progress-ring-circle {
            transition: stroke-dashoffset 0.1s;
            transform-origin: 50% 50%;
            stroke: #007bff;
        }

        /* Responsive */
        @media (max-width: 768px) {
            footer .col-md-3, footer .col-md-6 {
                padding: 15px;
                margin-bottom: 15px;
            }

            footer .text-md-start, 
            footer .text-md-end,
            footer .col-md-3,
            footer .col-md-6 {
                text-align: left !important;
            }

            footer .social-container {
                justify-content: flex-start;
            }

            .chat-widget {
                bottom: 70px;
            }

            .back-to-top {
                bottom: 15px;
            }
        }
    </style>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const progressBtn = document.querySelector('.progress-btn-container');
        const circle = document.querySelector('.progress-ring-circle');
        const radius = circle.r.baseVal.value;
        const circumference = radius * 2 * Math.PI;

        // Set initial properties
        circle.style.strokeDasharray = `${circumference} ${circumference}`;
        circle.style.strokeDashoffset = circumference;

        function setProgress(percent) {
            const offset = circumference - (percent / 100 * circumference);
            circle.style.strokeDashoffset = offset;
        }

        function calculateScrollPercentage() {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            return (scrollTop / docHeight) * 100;
        }

        // Show/hide button and update progress dengan scroll yang lebih pendek
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) { // Diubah dari 300 menjadi 100
                progressBtn.style.display = 'block';
                const percentage = calculateScrollPercentage();
                setProgress(percentage);
            } else {
                progressBtn.style.display = 'none';
            }
        });

        // Scroll to top when clicked
        document.getElementById('backToTop').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Tunggu semua konten dimuat
        window.addEventListener('load', function() {
            setTimeout(function() {
                // Hapus class is-loading dari body
                document.body.classList.remove('is-loading');
                
                // Tambahkan class hidden ke loading overlay
                const loadingOverlay = document.querySelector('.loading-overlay');
                loadingOverlay.classList.add('hidden');
                
                // Hapus loading overlay setelah animasi selesai
                setTimeout(function() {
                    loadingOverlay.style.display = 'none';
                }, 800); // Sesuaikan dengan durasi transition di CSS
            }, 1500); // Waktu minimum loading screen ditampilkan (1.5 detik)
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <!-- Font Awesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>