@extends('layouts.layout')

@section('title', 'Detail Proyek Internal Project')

@section('content')
    <div class="p-5" style="border-radius: 15px; border: 1px solid #ddd; background-color: #fbfbfd;">
        <div class="text-center mb-4">
            <h3><strong>DETAIL PROYEK INTERNAL PROJECT</strong></h3>
        </div>
        
        <div class="grid-layout">
            <!-- Judul -->
            <div class="item">
                <div class="item-header">{{ $internal_project->module ?? '-' }}</div>
                <div class="item-content">
                    <p>{{ $internal_project->judul }}</p>
                </div>
            </div>

            <!-- PIC -->
            <div class="item">
                <div class="item-header">PIC</div>
                <div class="item-content">
                    <p>{{ $internal_project->pic ?? '-' }}</p>
                </div>
            </div>

            <!-- T-Code -->
            <div class="item">
                <div class="item-header">T-Code</div>
                <div class="item-content">
                    <p>{{ $internal_project->t_code ?? '-' }}</p>
                </div>
            </div>

            <!-- Input Process -->
            <div class="item">
                <div class="item-header">Input Process</div>
                <div class="item-content">
                    <p>{{ $internal_project->input_process }}</p>
                </div>
            </div>

            <!-- Proses (Large Card) -->
            <div class="item large-card">
                <div class="item-header">Proses</div>
                <div class="item-content">
                    <p>{{ $internal_project->proses ?? '-' }}</p>
                </div>
            </div>

            <!-- Output Process -->
            <div class="item">
                <div class="item-header">Output Process</div>
                <div class="item-content">
                    <p>{{ $internal_project->output_process ?? '-' }}</p>
                </div>
            </div>

            <!-- Link Terkait -->
            <div class="item large-card">
                <div class="item-header">Link Terkait</div>
                <div class="item-content">
                    <p>
                        @if($internal_project->link_terkait)
                            {{-- Cek apakah teks mengandung URL yang valid --}}
                            <?php
                                $link_terkait = $internal_project->link_terkait;
                                $pattern = '/\bhttps?:\/\/[^\s]+\b/';  // Pola untuk mencocokkan URL
                                if (preg_match($pattern, $link_terkait)) {
                                    // Jika ada URL, tampilkan sebagai link
                                    $link_terkait = preg_replace($pattern, '<a href="$0" target="_blank" style="color: blue; text-decoration: underline;">$0</a>', $link_terkait);
                                }
                            ?>
                            {!! $link_terkait !!}
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>

        </div>

        @if($internal_project->image)
            <div class="image-section mt-4 text-center">
                <img src="{{ asset('images/internal_project/' . $internal_project->image) }}" 
                     alt="{{ $internal_project->judul }}" 
                     class="img-fluid" 
                     style="border-radius: 10px; width: 100%; max-width: 800px;">
            </div>
        @else
            <p class="mt-4 text-center">Tidak ada gambar</p>
        @endif
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

        .link-terkait {
            align-self: start;
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