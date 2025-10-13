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
<!-- FAQ FI Module - Jasa Konstruksi Section -->
<div class="p-5" style="border-radius: 15px; border: 1px solid #ddd; background-color: #fbfbfd;">
    <h2 class="section-title mb-4 text-center" style="font-size: min(24px, 5vw);">FAQ FI MODULE - JASA KONSTRUKSI</h2>
    <div class="row g-4">
        @foreach ($faqFiModules as $faq)
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
                                <img src="{{ asset('images/faq-jasa-konstruksi/fi/' . $faq->image) }}" alt="FAQ Image" class="img-fluid mb-3 faq-image">
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

<!-- Custom CSS for Accordion Button Active State -->
<style>
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
</style>
@endsection