@extends('layouts.layout')
<?php
    function formatTextForHtml($text) {
    // 1. Ganti \\n (dua backslash) jadi \n (newline karakter)
    $text = preg_replace('/\\\\n/', "\n", $text);

    // 2. Ubah newline ke <br>
    // $text = nl2br($text); // otomatis convert \n ke <br>
    $text = str_replace("\n", "<br>", $text);
    // 3. Ubah **bold** markdown ke <strong>
    $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);

    // 4. Opsional: amankan HTML lain agar tidak dieksekusi
    // Jika kamu yakin teks ini aman dari XSS, kamu bisa lewati ini
    // Kalau tidak aman, encode semua lalu izinkan <br> dan <strong>
    $text = strip_tags($text, '<br><strong>');

   $text = str_replace('&lt;br&gt;', '<br>', $text);
   $text = str_replace('&lt;strong&gt;', '<br>', $text);
   $text = str_replace('&lt;/strong&gt;', '<br>', $text);

    return $text;
}
?>
@section('content')
<!-- FAQ SETIAP SCENARIO Section -->
<div class="p-5 mb-5" style="border-radius: 15px; border: 1px solid #ddd; background-color: #fbfbfd;">
    <h2 class="section-title mb-4 text-center" style="font-size: min(24px, 5vw);">FAQ SETIAP SCENARIO</h2>
    <div id="faqCarousel" class="carousel slide position-relative" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <!-- FAQ JASA KONSTRUKSI -->
            <div class="carousel-item active">
                <div class="card-wrapper position-relative">
                    <div class="card shadow-sm h-100 text-center" style="background-color: #007bff; color: white; border-radius: 15px; cursor: pointer;" onclick="showFilterModal('FAQ Jasa Konstruksi', 'jasa-konstruksi', event)">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="bi bi-building card-icon"></i>
                            <h5 class="card-title mb-3">FAQ JASA KONSTRUKSI</h5>
                            <p class="card-text">Klik di sini untuk menemukan jawaban tentang Jasa Konstruksi.</p>
                        </div>
                        
                        <!-- Inline Navigation Buttons -->
                        <div class="carousel-navigation">
                            <button class="carousel-control-prev" type="button" data-bs-target="#faqCarousel" data-bs-slide="prev" data-manual-slide="true">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#faqCarousel" data-bs-slide="next" data-manual-slide="true">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#faqCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <!-- <button type="button" data-bs-target="#faqCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#faqCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#faqCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#faqCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button> -->
        </div>
    </div>
</div>

<!-- FAQ GENERAL Section -->
<div class="p-5" style="border-radius: 15px; border: 1px solid #ddd; background-color: #fbfbfd;">

    <h2 class="section-title mb-4 text-center" style="font-size: min(24px, 5vw);">FAQ GENERAL</h2>
    <div class="row g-4">
         @foreach($faqJasaKonstruksis as $faq)
            <div class="col-md-6">
                <div class="accordion-item shadow-sm" style="border-radius: 10px;">
                    <h2 class="accordion-header" id="heading{{ $faq->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapse{{ $faq->id }}" 
                                aria-expanded="false" 
                                aria-controls="collapse{{ $faq->id }}">
                            {{ $faq->question }}
                        </button>
                    </h2>
                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}">
                        <div class="accordion-body">
                            <div id="faq-answer">{!! formatTextForHtml($faq->answer) !!}</div>
                            @if($faq->image)
                                <!-- <img src="{{ asset('images/faq-general/' . $faq->image) }}" alt="FAQ Image" class="img-fluid mb-3 faq-image"> -->
                                 <!--<img src="{{ asset('images/faq-jasa-konstruksi/' . $faq->image) }}" alt="FAQ Image" class="img-fluid mb-3 faq-image">
                            @else
                                <p class="mt-4 text-center">Tidak ada gambar</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal Filter -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true" data-url-base="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Pilih Module</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="selectedFaqTitle"></p>
                <!-- <div class="form-check">
                    <input class="form-check-input" type="radio" name="faqModule" id="general" value="/faq-jasa-konstruksi">
                    <label class="form-check-label" for="general">General</label>
                </div> -->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="faqModule" id="fi" value="/faq-jasa-konstruksi/fi">
                    <label class="form-check-label" for="fi">FI Module</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="faqModule" id="sd" value="/faq-jasa-konstruksi/sd">
                    <label class="form-check-label" for="sd">SD Module</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="faqModule" id="ps" value="/faq-jasa-konstruksi/ps">
                    <label class="form-check-label" for="ps">PS Module</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="faqModule" id="co-fm" value="/faq-jasa-konstruksi/co-fm">
                    <label class="form-check-label" for="co-fm">CO/FM Module</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="faqModule" id="mm" value="/faq-jasa-konstruksi/mm">
                    <label class="form-check-label" for="mm">MM Module</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="selectModule()">Pilih</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="position-fixed" style="top: 103px; right: 20px; z-index: 2000;">
    <div id="toastAlert" class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000" style="background-color: #ec1c24; display: none;">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-exclamation-circle-fill me-2"></i> Silakan pilih module terlebih dahulu.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    /* Mengubah warna radio button menjadi merah */
    .form-check-input[type="radio"]:checked {
        background-color: #ec1c24;  /* Warna latar belakang merah */
        border-color: #ec1c24;      /* Border merah */
    }

    /* Mengubah warna border radio button ketika tidak dicentang (normal state) */
    .form-check-input[type="radio"] {
        border: 1px solid #000;
    }

    /* Menambahkan efek ketika radio button sedang difokuskan */
    .form-check-input[type="radio"]:focus {
        border-color: #ec1c24;  /* Warna border merah saat fokus */
        box-shadow: none; /* Efek bayangan merah */
    }

    .accordion-button:not(.collapsed) {
        background-color: #ec1c24 !important;
        color: white !important;
        box-shadow: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        text-align: left;
        border-radius: 10px 10px 0 0;
    }

    .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='none' stroke='%23fff' stroke-width='2'%3e%3cpath d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-size: 1rem;
        transform: rotate(180deg);
        margin-top: auto;
        margin-bottom: auto;
        filter: brightness(0) invert(1);
    }

    .accordion-button:focus {
        box-shadow: none;
        outline: none;
    }

    .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='none' stroke='%23000' stroke-width='2'%3e%3cpath d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-size: 1rem;
        content: '';
        width: 1rem;
        height: 1rem;
        margin-top: auto;
        margin-bottom: auto;
        display: inline-block;
        transition: transform 0.3s ease;
    }

    .accordion-body {
        text-align: left;
        font-size: 0.95rem;
        line-height: 1.5;
        color: black;
        padding: 15px;
        background-color: #f9f9f9;
    }

    .accordion-body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 1px;
        background-color: #ddd;
    }

    .accordion-button {
        font-weight: bold;
        color: black !important;
        font-size: 0.95rem;
        padding: 15px;
        background-color: #f9f9f9;
    }

    .accordion-item {
        transition: all 0.3s ease;
        border: 1px solid #ddd;
        background-color: white;
        border-radius: 10px;
        margin-bottom: 15px;
        overflow: hidden;
    }

    .accordion-item:hover {
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
    }

    .accordion-item hr {
        border-top: 1px solid #ddd;
        margin: 0.5rem 0;
    }

    .accordion-item {
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .accordion-header .accordion-button {
        font-size: 0.95rem;
    }

    /* Tambahan CSS untuk Carousel Indicators */
    .carousel-navigation {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        transform: translateY(-50%);
        display: flex;
        justify-content: space-between;
        padding: 0 10px;
    }

    .carousel-navigation .carousel-control-prev,
    .carousel-navigation .carousel-control-next {
        position: static !important;
        width: 40px !important;
        height: 40px !important;
        background-color: #fff !important; /* Latar belakang terang */
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: none !important;
        opacity: 1 !important;
        filter: none !important;
    }

    .carousel-navigation .carousel-control-prev-icon,
    .carousel-navigation .carousel-control-next-icon {
        width: 20px;
        height: 20px;
        filter: brightness(0) invert(0) !important;
    }

    .carousel-indicators {
        position: static;
        margin-top: 15px;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .carousel-indicators button {
        width: 12px !important;
        height: 12px !important;
        border-radius: 50% !important;
        background-color: #A9A9A9 !important; /* Warna abu-abu yang lebih kontras */
        opacity: 1 !important;
        border: 2px solid #555 !important;
    }

    .carousel-indicators button.active {
        width: 16px !important;
        height: 16px !important;
        background-color: #ec1c24 !important;
        border: none !important;
    }

    .card-wrapper {
        width: 90%; 
        margin: 0 auto;
        height: 280px; 
        position: relative;
    }

    .card-wrapper .card {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .card-wrapper .card .card-title {
        font-size: 1.3rem; 
        margin-bottom: 1rem;
    }

    .card-wrapper .card .card-text {
        font-size: 1rem; 
        line-height: 1.6;
        padding: 0 15px;
    }

    .btn-close:focus {
        box-shadow: none;
    }

    @media (max-width: 768px) {
        /* Existing mobile styles */
        #faqCarousel .carousel-item .card-wrapper {
            position: relative;
        }
        
        #faqCarousel .carousel-item .carousel-navigation {
            position: absolute;
            top: 50%;
            left: -30px;
            right: -30px;
            transform: translateY(-50%);
            display: flex;
            justify-content: space-between;
            z-index: 10;
        }
        
        #faqCarousel .carousel-item .carousel-navigation .carousel-control-prev,
        #faqCarousel .carousel-item .carousel-navigation .carousel-control-next {
            background-color: rgba(0,0,0,0.3);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        #faqCarousel .carousel-item .carousel-navigation .carousel-control-prev-icon,
        #faqCarousel .carousel-item .carousel-navigation .carousel-control-next-icon {
            width: 20px;
            height: 20px;
        }

        /* New styles for modal positioning */
        .modal-dialog {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) !important;
            margin: 0;
            width: calc(100% - 20px);
            max-width: 500px;
        }

        #filterModal {
            padding-right: 0 !important;
        }

        .modal-content {
            margin: auto;
        }
    }

    /* Desktop Styles */
    @media (min-width: 769px) {
        #faqCarousel .card {
            position: relative;
            display: flex;
            flex-direction: column; /* Menempatkan konten secara vertikal */
            align-items: center; /* Mengatur ikon dan teks di tengah secara horizontal */
            justify-content: flex-start; /* Mengatur agar ikon berada di atas teks */
        }

        #faqCarousel .card-icon {
            position: static; /* Menghapus absolute positioning */
            color: white;
            font-size: 4rem; /* Ukuran ikon besar untuk desktop */
            margin-bottom: 15px; /* Menambahkan jarak antara ikon dan teks */
            opacity: 0.5; /* Transparansi untuk tampilan dekstop */
            z-index: 2; /* Tetap terlihat di atas */
        }

        #faqCarousel .card-body {
            position: relative;
            text-align: center; /* Mengatur teks agar tetap berada di tengah */
            z-index: 2;
        }
    }

    /* Mobile Styles */
    @media (max-width: 768px) {
        #faqCarousel .card {
            position: relative;
        }
        
        #faqCarousel .card-icon {
            position: static;
            color: white;
            font-size: 3rem; /* Ukuran lebih kecil untuk mobile */
            margin-bottom: 10px; /* Menambahkan jarak antara ikon dan teks */
            opacity: 0.5; /* Transparansi untuk tampilan mobile */
            z-index: 1;
        }
        
        #faqCarousel .card-body {
            position: relative;
            text-align: center; /* Mengatur teks agar tetap berada di tengah */
            z-index: 2;
        }

        /* Perkecil ukuran teks title dan deskripsi */
        .card-wrapper .card .card-title {
            font-size: 1.15rem; /* Ukuran judul diperkecil */
            margin-bottom: 0.8rem;
        }

        .card-wrapper .card .card-text {
            font-size: 0.9rem; /* Ukuran teks deskripsi diperkecil */
            line-height: 1.4; /* Sesuaikan tinggi baris untuk teks yang lebih kecil */
            padding: 0 10px; /* Kurangi padding untuk tampilan mobile */
        }
    }
</style>

<script>
    function selectModule() {
        const selectedOption = document.querySelector('input[name="faqModule"]:checked');
        const modal = document.getElementById('filterModal');
        const baseUrl = modal.getAttribute('data-url-base');

        if (selectedOption && baseUrl) {
            const modulePath = selectedOption.id !== 'general' ? `/${selectedOption.id}` : '';
            window.location.href = baseUrl + modulePath;
        } else {
            showToast();
        }
    }

    function showToast() {
        const toast = new bootstrap.Toast(document.getElementById('toastAlert'));
        document.getElementById('toastAlert').style.display = 'block';
        toast.show();
    }

    function showFilterModal(title, scenario, event) {
        if (event && event.target.closest('[data-manual-slide="true"]')) {
            return; // Hentikan jika berasal dari navigasi manual
        }

        document.getElementById('selectedFaqTitle').innerText = title;

        // Tetapkan URL dasar sesuai skenario
        const modal = document.getElementById('filterModal');
        let baseUrl = '';

        switch (scenario) {
            case 'jasa-konstruksi':
                baseUrl = '{{ url("/faq-jasa-konstruksi") }}';
                break;
            case 'manufacturing':
                baseUrl = '{{ url("/faq-manufacturing") }}';
                break;
            case 'jasa-non-konstruksi':
                baseUrl = '{{ url("/faq-jasa-non-konstruksi") }}';
                break;
            case 'capex-procurement':
                baseUrl = '{{ url("/faq-capex-procurement") }}';
                break;
            case 'internal-project':
                baseUrl = '{{ url("/faq-internal-project") }}';
                break;
        }

        modal.setAttribute('data-url-base', baseUrl);

        new bootstrap.Modal(modal).show();
    }
</script>
@endsection