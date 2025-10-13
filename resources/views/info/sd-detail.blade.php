@extends('layouts.layout')

@section('title', 'Detail Updates SD')

@section('content')
<div class="p-5" style="border-radius: 15px; border: 1px solid #ddd; background-color: #fbfbfd;">
    <div class="text-center mb-4">
        <h3><strong>{{ $report->report }} Update</strong></h3>
        <span class="badge {{ $report->status === 'done' ? 'bg-success' : 'bg-warning text-dark' }}">
            {{ ucfirst($report->status) }}
        </span>
    </div>

    <div class="grid-layout">
        <!-- Deskripsi -->
        <div class="item large-card">
            <div class="item-header">Deskripsi</div>
            <div class="item-content">
                <p>{{ $report->description ?? '-' }}</p>
            </div>
        </div>

        <!-- Link -->
        @if($report->link)
        <div class="item">
            <div class="item-header">Link Terkait</div>
            <div class="item-content">
                <a href="{{ $report->link }}" target="_blank" style="color: blue; text-decoration: underline;">
                    {{ $report->link }}
                </a>
            </div>
        </div>
        @endif

        <!-- File -->
        @if($report->file)
        <div class="item">
            <div class="item-header">File Terkait</div>
            <div class="item-content">
                <a href="{{ asset('files/sd/' . $report->file) }}" target="_blank">
                    {{ basename($report->file) }}
                </a>
            </div>
        </div>
        @endif
    </div>

    <!-- Gambar -->
    @if($report->image)
    <div class="image-section mt-4 text-center">
        <img src="{{ asset('images/sd/' . $report->image) }}"
             alt="Gambar"
             class="img-fluid"
             style="border-radius: 10px; width: 100%; max-width: 800px;">
    </div>
    @endif

    <div class="mt-4 text-left">
        <a href="{{ url('/info/sd') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<style>
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
        display: flex;
        align-items: center;
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