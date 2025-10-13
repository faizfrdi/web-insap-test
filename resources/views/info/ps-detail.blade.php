@extends('layouts.layout')

@section('title', 'Detail Updates PS')

@section('content')
<div class="p-5" style="border-radius: 15px; border: 1px solid #ddd; background-color: #fbfbfd;">
    <div class="text-center mb-4">
        <h3><strong>{{ $report->report }} Update</strong></h3>
        <span class="badge {{ $report->status === 'done' ? 'bg-success' : 'bg-warning text-dark' }}">
            {{ ucfirst($report->status) }}
        </span>
    </div>

    <div class="grid-layout">
        @if(!empty($report->description))
        <div class="item large-card">
            <div class="item-header">Deskripsi</div>
            <div class="item-content">
                <p>{{ $report->description }}</p>
            </div>
        </div>
        @endif

        @if($report->link)
            <div class="item">
                <div class="item-header">Link Terkait</div>
                <div class="item-content links-container d-flex flex-column">
                    @foreach(preg_split('/\r\n|\r|\n/', $report->link) as $line)
                        @php
                            $parts = explode(':', $line, 2);
                            $label = trim($parts[0]);
                            $url = isset($parts[1]) ? trim($parts[1]) : null;
                        @endphp

                        <div class="link-item mb-2">
                            <strong class="d-block">{{ $label }}:</strong>
                            @if(filter_var($url, FILTER_VALIDATE_URL))
                                <a href="{{ $url }}" target="_blank" class="link-blue d-block">{{ $url }}</a>
                            @else
                                <span class="text-muted">Link tidak valid</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($report->file)
        <div class="item">
            <div class="item-header">File Terkait</div>
            <div class="item-content">
                <a href="{{ asset('files/ps/' . $report->file) }}" target="_blank">
                    {{ basename($report->file) }}
                </a>
            </div>
        </div>
        @endif
    </div>

    @if($report->image)
    <div class="image-section mt-4 text-center">
        <img src="{{ asset('images/ps/' . $report->image) }}"
             alt="Gambar"
             class="img-fluid"
             style="border-radius: 10px; width: 100%; max-width: 800px;">
    </div>
    @endif

    <div class="mt-4 text-left">
        <a href="{{ url('/info/ps') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<style>
    .links-container {
        /* Hapus flex-wrap: wrap jika ada di file CSS lain */
        display: flex;
        flex-direction: column;
    }
    
    .link-item {
        font-size: 0.95rem;
        word-break: break-all; /* Agar URL panjang tidak keluar dari container */
    }

    .link-blue {
        color: #007bff;
        text-decoration: underline;
        word-break: break-all;
    }

    .grid-layout {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-top: 1rem;
        align-items: start;
    }

    .grid-layout .item {
        display: flex;
        flex-direction: column;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: auto;
    }

    .grid-layout .item-header {
        background-color: #ec1c24 !important;
        color: white !important;
        padding: 0.75rem 1rem;
        font-weight: bold;
        flex-shrink: 0;
    }

    .grid-layout .item-content {
        background-color: #f9f9f9;
        color: black;
        padding: 1rem;
        word-wrap: break-word;
        overflow-wrap: break-word;
        flex-grow: 1;
    }

    .grid-layout .item-content p {
        margin: 0;
        word-break: break-word;
        white-space: normal;
        width: 100%;
    }

    .large-card {
        grid-column: span 2;
    }

    .image-section img {
        max-width: 100%;
        height: auto;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 10px;
    }

    @media (max-width: 768px) {
        .grid-layout {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .large-card {
            grid-column: span 1;
        }

        .grid-layout .item {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
    }
</style>
@endsection