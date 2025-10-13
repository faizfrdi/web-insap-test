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

    <!-- Main Content -->
    <div class="container my-5 flex-grow-1">
        @yield('content')
    </div>



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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>