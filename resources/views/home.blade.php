@extends('layouts.layout')

@section('content')

    <!-- Hero Section with Background, Arrows, and Enlarged Card -->
    <section id="hero" class="container-fluid text-center py-5 banner" onclick="window.location.href='{{ route('chatbot') }}'" class="text-decoration-none">>
        <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div> <!-- Overlay for darker background -->

        <!-- Left and Right Arrows -->
        <!-- <div class="arrow arrow-left" style="position: absolute; top: 50%; left: 20px; z-index: 3; cursor: pointer; font-size: 2rem; color: white; transform: translateY(-50%);">
            &#10094;
        </div>
        <div class="arrow arrow-right" style="position: absolute; top: 50%; right: 20px; z-index: 3; cursor: pointer; font-size: 2rem; color: white; transform: translateY(-50%);">
            &#10095;
        </div> -->

        <!-- Card with Enlarged Size and Adjustments -->
        <div class="p-5" style="border-radius: 15px; max-width: 800px; margin: auto; position: relative; z-index: 2; background-color: rgba(255, 255, 255, 0);">
            <style>
                .banner {
                    background-image: url('{{ asset('images/banner-chatbot.png') }}'); 
                    background-size: cover; 
                    background-position: center; 
                    position: relative; 
                    border-radius: 15px; 
                    overflow: hidden; 
                    margin: auto; 
                    transition: background-image 1s ease-in-out;
                    background-repeat: no-repeat;
                    height: 50vh; /* 100% dari tinggi viewport */
                    cursor: pointer;
                }
                .text-shadow {
                    color: white;
                    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7); Better contrast against background
                }
                .section-title-spacing {
                    margin-bottom: 10px; /* Mengurangi jarak antara dua teks */
                }
                .custom-flex {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-top: 20px;
                }
                .text-left {
                    max-width: 60%; /* Mengatur lebar teks kiri */
                    text-align: left;
                }

                /* Mobile responsiveness */
                @media (max-width: 768px) {
                    .custom-flex {
                        flex-direction: column; /* Susun elemen secara vertikal */
                        align-items: center; /* Rapatkan elemen di tengah */
                    }

                    .d-flex.flex-column {
                        align-items: center; /* Pastikan tombol berada di tengah */
                    }

                    .btn.play-video {
                        margin-bottom: 10px; /* Tambahkan sedikit jarak di antara tombol */
                        width: 60px; /* Pastikan tombol tetap berbentuk bulat dan tidak menjadi oval */
                        height: 60px; /* Sesuaikan tinggi agar tetap bulat */
                        padding: 5px; /* Atur padding */
                    }

                    .btn.btn-danger {
                        width: 100%; /* Membuat tombol Hubungi Kami melebar sesuai layar */
                        text-align: center; /* Teks tetap di tengah */
                    }

                    .banner {
                        height: auto;
                        padding-top: 56.25%; /* Rasio 16:9 */
                        background-size: cover;
                        background-position: center;
                    }
                }

                /* Navbar styling */
                .navbar {
                    position: fixed; /* Pastikan navbar tetap di atas halaman */
                    top: 0;
                    left: 0;
                    width: 100%; /* Buat navbar melebar penuh */
                    z-index: 999; /* Pastikan navbar berada di atas elemen lainnya */
                    background-color: rgba(0, 0, 0, 0.8); /* Tambahkan transparansi jika diperlukan */
                }

                body {
                    padding-top: 90px; /* Beri ruang untuk navbar agar tidak menutupi konten */
                }

                footer {
                    width: 100%; 
                    max-width: 100%;
                }
            </style>

            <!-- <h1 class="section-title section-title-spacing" style="font-size: 1.3rem; font-weight: bold; color: white">PT Adhi Karya (Persero) Tbk.</h1> 
            <h1 class="section-title" style="font-size: 1.3rem; font-weight: bold; color: white;">BEYOND CONSTRUCTION</h1>  -->

            <!-- <div class="custom-flex">
                <div class="text-left" style="max-width: 60%; text-align: left; font-weight: 500;">
                    <p style="color: white; line-height: 1.6;">
                    Selamat Datang di Website Pusat Informasi SAP<br>
                    PT Adhi Karya (Persero) Tbk.<br>
                    <br>
                    Website ini dirancang untuk menjadi sumber daya utama Anda
                    dalam memahami dan mengoptimalkan penggunaan SAP
                    di lingkungan PT Adhi Karya (Persero) Tbk.
                    </p>
                </div>

                <div class="d-flex flex-column align-items-center">
                    <button type="button" class="btn play-video mb-5" data-bs-toggle="modal" data-bs-target="#videoModal" style="background-color: red; border: 5px solid red; border-radius: 50%; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; padding: 0; cursor: pointer; transition: transform 0.3s ease, background-color 0.3s ease;">
                        <img src="{{ asset('images/play.png') }}" alt="Play Video" class="play-icon" style="width: 40px; height: 40px; object-fit: cover; display: block; transform: translateX(-0.5px);">
                    </button>
                    <a href="{{ url('/faq') }}" class="btn btn-danger" style="padding: 12px 40px; font-size: 1rem; border-radius: 10px; transition: background-color 0.3s ease, color 0.3s ease; color: white;">Selengkapnya</a>
                </div>
            </div> -->
        </div>
    </section>

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel" style="font-size: 1rem; font-weight: bold;">Profil Perusahaan PT Adhi Karya (Persero) Tbk.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/7vRfRB581QY?si=_Q8hSJfpwJpYJqcu" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes smooth-pulsate {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
            }
            50% {
                box-shadow: 0 0 0 15px rgba(255, 255, 255, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
            }
        }
        
        .play-video, .pulsate-contact {
            animation: smooth-pulsate 1.1s ease-out infinite;
        }

        .play-video:hover, .pulsate-contact:hover {
            transform: scale(1.1);
            background-color: rgba(255, 0, 0, 0.1);
        }

        .pulsate-contact:hover {
            background-color: #cc0000; /* Change to slightly darker red on hover */
            color: white;
        }
         
        .btn-close:focus {
            box-shadow: none;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var images = [
                "{{ asset('images/banner-chatbot.png') }}"
            ];
            var currentIndex = 0;

            function updateBackground() {
                $('#hero').css('background-image', 'url(' + images[currentIndex] + ')');
            }

            function nextImage() {
                currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
                updateBackground();
            }

            function prevImage() {
                currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
                updateBackground();
            }

            $('.arrow-left').on('click', function() {
                prevImage();
            });

            $('.arrow-right').on('click', function() {
                nextImage();
            });

            // Otomatis gambar berganti setiap 3 detik sekali
            setInterval(nextImage, 3000);

            $('#videoModal').on('hidden.bs.modal', function () {
                var iframe = $(this).find('iframe');
                var src = iframe.attr('src');
                iframe.attr('src', '');
                iframe.attr('src', src);
            });
        });
    </script>

    <!-- Jasa Konstruksi Section -->
    <div id="jasa-konstruksi-section" class="text-center p-3 p-md-5 mt-5" style="border-radius: 15px; border: 1px solid #ddd; background-color: #fbfbfd;">
        <h2 class="section-title mb-4" style="font-size: min(24px, 5vw);">JASA KONSTRUKSI</h2>

        <!-- Module Selection Button dengan ID Unik -->
        <div class="mb-4 d-flex justify-content-between">
            <button id="openModuleModalBtnJasaKonstruksi" class="btn btn-custom-red btn-sm" data-bs-toggle="modal" data-bs-target="#moduleSelectionModalJasaKonstruksi">
                <i class="bi bi-filter me-1"></i> Pilih Module
            </button>
        </div>

        <!-- Existing content container -->
        <div id="jasa-konstruksi-content">
            <div class="row">
                @foreach ($jasaKonstruksis as $jasa_konstruksi)
                    @php
                        $moduleColors = [
                            'FI Module' => '#ff0404',
                            'PS Module' => '#aeeff0', 
                            'SD Module' => '#90c44c',
                            'CO/FM Module' => '#ff9ccc',
                            'MM Module' => '#08b4f4'
                        ];

                        $backgroundColor = $moduleColors[$jasa_konstruksi->module] ?? '#ffffff';
                    @endphp

                    <div class="custom-col mb-4 jasa-card {{ $jasa_konstruksi->module == 'FI Module' ? 'fi-module' : '' }}" data-module="{{ $jasa_konstruksi->module }}">
                        <a href="{{ route('scenarios.jasa-konstruksi', $jasa_konstruksi->slug) }}" class="text-decoration-none">
                            <div class="card h-100 portfolio-card" style="border-radius: 10px; overflow: hidden; padding: 0; background-color: {{ $backgroundColor }}; background-size: cover; background-position: center;"> 
                                <div class="card-body" style="background: rgba(255,255,255,0.15); color: black;">
                                    <h5 class="card-number">- {{ $jasa_konstruksi->urutan }} -</h5>
                                    <h5 class="card-title">{{ $jasa_konstruksi->judul }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal dengan ID Unik untuk Jasa Konstruksi -->
    <div class="modal fade" id="moduleSelectionModalJasaKonstruksi" tabindex="-1" aria-labelledby="moduleSelectionModalLabelJasaKonstruksi" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="moduleSelectionModalLabelJasaKonstruksi">Pilih Module</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="module-filter-container">
                        <!-- Teks Jasa Konstruksi -->
                        <p class="text-muted">Jasa Konstruksi</p>

                        <!-- Checkbox untuk memilih semua module -->
                        <div class="form-check mb-3">
                            <input class="form-check-input module-checkbox" type="checkbox" id="selectAllModulesJasaKonstruksi">
                            <label class="form-check-label" for="selectAllModulesJasaKonstruksi">Semua Module</label>
                        </div>

                        <!-- Filter Checkbox untuk masing-masing module -->
                        @php
                            $modules = ['FI Module', 'SD Module', 'PS Module', 'CO/FM Module', 'MM Module'];
                        @endphp

                        @foreach($modules as $module)
                            <div class="form-check mb-2">
                                <input class="form-check-input module-checkbox" type="checkbox" value="{{ $module }}" id="{{ str_replace(' ', '_', $module) }}_JasaKonstruksi">
                                <label class="form-check-label" for="{{ str_replace(' ', '_', $module) }}_JasaKonstruksi">
                                    {{ $module }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="applyModuleFilterBtnJasaKonstruksi">Pilih</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="position-fixed" style="top: 103px; right: 20px; z-index: 2000;">
        <div id="toastAlertJasaKonstruksi" class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000" style="background-color: #ec1c24; display: none;">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-exclamation-circle-fill me-2"></i> Silakan pilih module terlebih dahulu.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Pilih Module pada Jasa Konstruksi, Manufacturing, Jasa Non Konstruksi, Capex Procurement, dan Internal Project -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk mengatur filter dengan parameter section spesifik
            function setupFilter(sectionId, cardClass, modalId, toastId) {
                const modal = document.getElementById(modalId);
                const checkboxes = modal.querySelectorAll('.module-checkbox');
                const selectAllCheckbox = modal.querySelector('input[id^="selectAllModules"]');
                const applyFilterBtn = modal.querySelector('.btn-primary');
                const cards = document.querySelectorAll(`#${sectionId} ${cardClass}`);
                const toastAlert = document.getElementById(toastId);

                // Event listener untuk select all
                selectAllCheckbox.addEventListener('change', function() {
                    checkboxes.forEach(checkbox => {
                        if (checkbox !== selectAllCheckbox) {
                            checkbox.checked = this.checked;
                        }
                    });
                });

                // Event listener untuk apply filter
                applyFilterBtn.addEventListener('click', function() {
                    const selectedModules = [];

                    checkboxes.forEach(checkbox => {
                        if (checkbox.checked && checkbox !== selectAllCheckbox) {
                            selectedModules.push(checkbox.value);
                        }
                    });

                    // Filter kartu
                    cards.forEach(card => {
                        const cardModule = card.getAttribute('data-module');
                        if (selectedModules.length === 0 || selectAllCheckbox.checked || selectedModules.includes(cardModule)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Tampilkan toast jika tidak ada module yang dipilih
                    if (selectedModules.length === 0) {
                        const toast = new bootstrap.Toast(toastAlert);
                        toastAlert.style.display = 'block';
                        toast.show();
                    } else {
                        // Tutup modal
                        bootstrap.Modal.getInstance(modal).hide();
                    }
                });
            }

            // Panggil setupFilter untuk setiap section
            setupFilter(
                'jasa-konstruksi-section', 
                '.jasa-card', 
                'moduleSelectionModalJasaKonstruksi', 
                'toastAlertJasaKonstruksi'
            );

        });
    </script>

    <!-- Custom CSS for Accordion Button Active State -->
    <style>
        /* Mengatur warna teks putih untuk card dengan FI Module */
        .fi-module .card-body {
            color: white !important; /* Mengubah warna teks menjadi putih */
        }

        /* Untuk card lainnya, warna teks tetap hitam */
        .card-body {
            color: black; /* Menjaga warna teks hitam pada card lainnya */
        }
        
        /* Custom select styling */
        .custom-select {
            min-width: 150px;
            padding: 0.375rem 2.25rem 0.375rem 0.75rem;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5;
            color: #ffffff;
            background-color: #ec1c24;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            border: 1px solid #ec1c24;
            border-radius: 5px;
            appearance: none;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .custom-select:focus {
            border-color: #b3161c;
            box-shadow: none;
            outline: none;
        }

        .custom-select option {
            background-color: white;
            color: black;
        }

        /* Existing styles */
        .form-check-input {
            border: 1px solid #ec1c24;
            border-radius: 5px;
            background-color: #ec1c24;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .form-check-input:checked {
            background-color: #b3161c;
            border-color: #b3161c;
        }

        .form-check-label {
            color: #333;
            font-weight: 500;
        }

        .form-check-input:focus {
            outline: none;
            box-shadow: none;
        }

        .btn-custom-red,
        .btn-custom-blue {
            border: none;
            font-size: 14px;
            padding: 8px 15px;
            border-radius: 5px;
            box-shadow: none;
            cursor: pointer;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
            transition: all 0.2s ease;
        }

        .btn-custom-red {
            background-color: #ec1c24;
            color: white;
        }

        .btn-custom-red:hover,
        .btn-custom-red:focus,
        .btn-custom-red:active,
        .btn-custom-red:focus-visible {
            background-color: #b3161c !important;
            color: white !important;
            box-shadow: none !important;
            outline: none !important;
            opacity: 0.9;
        }

        .btn-custom-blue {
            background-color: #007bff;
            color: white;
        }

        .btn-custom-blue:hover,
        .btn-custom-blue:focus,
        .btn-custom-blue:active,
        .btn-custom-blue:focus-visible {
            background-color: #0056b3 !important;
            color: white !important;
            box-shadow: none !important;
            outline: none !important;
        }

        .card-number {
            font-size: 13px;
            line-height: 1.2;
            margin-bottom: 3px;
            font-weight: 500;
        }

        .card-title {
            font-size: 11px;
            line-height: 1.2;
            font-weight: 500;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .card:hover {
            outline: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }

        .image-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 10px;
        }

        .img-fit {
            object-fit: contain;
            width: 100%;
            height: 150px;
            display: block;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .divider {
            border: none;
            border-top: 3px solid #000000;
            width: 100%;
            margin: 0;
        }

        .custom-col {
            flex: 0 0 12.5%;
            max-width: 12.5%;
            padding: 0 0.5rem;
            box-sizing: border-box;
        }

        @media (max-width: 768px) {
            .custom-col {
                flex: 0 0 25%;
                max-width: 25%;
            }
        }

        @media (max-width: 576px) {
            .custom-col {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (max-width: 768px) {
            .btn-custom-red,
            .btn-custom-blue {
                width: auto;
                min-width: 120px;
            }

            .image-container {
                margin-bottom: 1rem;
            }

            .text-end {
                padding-right: 1rem;
            }
        }

        /* Modal and Checkbox Styles */
        .modal-content {
            border-radius: 15px;
        }

        .module-checkbox {
            border: 1px solid #000;
            background-color: transparent;
        }

        .module-checkbox:checked {
            background-color: #ec1c24;
            border-color: #ec1c24;
        }

        .module-checkbox:checked::before {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3 6-6'/%3e%3c/svg%3e");
        }

        /* Mengatur border checkbox ketika tidak fokus dan tidak dicentang */
        .module-checkbox:focus {
            border-color: none; /* Set border menjadi hitam saat tidak dalam keadaan fokus */
            box-shadow: none !important; /* Menghapus box-shadow saat fokus */
        }

        /* Reset border ke warna hitam ketika checkbox tidak dicentang */
        .module-checkbox:not(:checked) {
            border-color: #000 !important; /* Set border menjadi hitam ketika checkbox tidak dicentang */
        }
    </style>
@endsection