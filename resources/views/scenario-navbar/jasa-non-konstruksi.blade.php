@extends('layouts.layout')

@section('content')
    <div id="flow-section" class="text-center p-3 p-md-5 mb-5" style="border-radius: 15px; border: 1px solid #ddd; background-color: #fbfbfd;">
        <h2 class="section-title mb-4" style="font-size: min(24px, 5vw);">FLOW END TO END ALL PROCESS SCENARIO JASA NON KONSTRUKSI</h2>
        
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center">
            <div class="image-container position-relative" style="width: 100%; max-width: 800px; margin: 0 auto; border-radius: 10px; overflow: hidden;">
                <img src="{{ asset('images/scenario-jasa-non-konstruksi.png') }}" class="img-fluid" alt="Flow End to End Jasa Non Konstruksi">
            </div>
            <div class="mt-4 mt-md-0 ms-md-4">
                <button id="scrollToSectionBtn" class="btn btn-custom-red btn-sm">
                    <i class="bi bi-arrow-down me-1"></i> Lihat Detail
                </button>
            </div>
        </div>

        <h3 class="mt-5 mb-3" style="font-size: min(20px, 4vw);">KETERANGAN LEGEND FOR FLOW</h3>

        <div class="image-container position-relative" style="width: 100%; max-width: 600px; margin: 0 auto; border-radius: 10px; overflow: hidden;">
            <img src="{{ asset('images/legend-for-flow.png') }}" class="img-fluid" alt="Legend for Flow">
        </div>
    </div>
    
    <div id="jasa-non-konstruksi-section" class="text-center p-3 p-md-5" style="border-radius: 15px; border: 1px solid #ddd; background-color: #fbfbfd;">
        <h2 class="section-title mb-4" style="font-size: min(24px, 5vw);">JASA NON KONSTRUKSI</h2>

        <div class="mb-4 d-flex justify-content-between">
            <button id="openModuleModalBtn" class="btn btn-custom-red btn-sm">
                <i class="bi bi-filter me-1"></i> Pilih Module
            </button>
            <button id="scrollToFlowBtn" class="btn btn-custom-blue btn-sm">
                <i class="bi bi-arrow-up me-1"></i> Lihat Flow
            </button>
        </div>

        <div id="jasa-non-konstruksi-content">
            <div class="row">
                @forelse ($jasaNonKonstruksis as $jasa_non_konstruksi)
                    @php
                        $moduleColors = [
                            'FI Module' => '#ff0404',
                            'PS Module' => '#aeeff0', 
                            'SD Module' => '#90c44c',
                            'CO/FM Module' => '#ff9ccc',
                            'MM Module' => '#08b4f4'
                        ];

                        $backgroundColor = $moduleColors[$jasa_non_konstruksi->module] ?? '#ffffff';
                    @endphp

                    <div class="custom-col mb-4 jasa-non-card {{ $jasa_non_konstruksi->module == 'FI Module' ? 'fi-module' : '' }}" data-module="{{ $jasa_non_konstruksi->module }}">
                        <a href="{{ route('scenarios.jasa-non-konstruksi', $jasa_non_konstruksi->slug) }}" class="text-decoration-none">
                            <div class="card h-100 portfolio-card" style="border-radius: 10px; overflow: hidden; padding: 0; background-color: {{ $backgroundColor }}; background-size: cover; background-position: center;"> 
                                <div class="card-body" style="background: rgba(255,255,255,0.15); color: {{ $jasa_non_konstruksi->module == 'FI Module' ? 'white' : 'black' }};">
                                    <h5 class="card-number">- {{ $jasa_non_konstruksi->urutan }} -</h5>
                                    <h5 class="card-title">{{ $jasa_non_konstruksi->judul }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-center mt-3">Tidak ada data untuk module yang dipilih.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="modal fade" id="moduleSelectionModal" tabindex="-1" aria-labelledby="moduleSelectionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="moduleSelectionModalLabel">Pilih Module</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="module-filter-container">
                        <p class="text-muted">Jasa Non Konstruksi</p>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input module-checkbox" type="checkbox" id="selectAllModules">
                            <label class="form-check-label" for="selectAllModules">Semua Module</label>
                        </div>

                        @php
                            $modules = ['FI Module', 'SD Module', 'PS Module', 'CO/FM Module', 'MM Module'];
                        @endphp

                        @foreach($modules as $module)
                            <div class="form-check mb-2">
                                <input class="form-check-input module-checkbox" type="checkbox" value="{{ $module }}" id="{{ str_replace(' ', '_', $module) }}">
                                <label class="form-check-label" for="{{ str_replace(' ', '_', $module) }}">
                                    {{ $module }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="applyModuleFilterBtn">Pilih</button>
                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed" style="top: 100px; right: 20px; z-index: 2000; max-width: 300px; width: auto;">
        <div id="statusToast" class="toast align-items-center text-white border-0" role="alert" data-bs-delay="3000" style="background-color: #ec1c24; display: none; word-wrap: break-word;">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-exclamation-circle-fill me-2"></i> Pilih minimal satu status!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <style>
        .fi-module .card-body {
            color: white !important;
        }

        .card-body {
            color: black;
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
            opacity: 0.9;
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

        .module-checkbox:focus {
            border-color: none;
            box-shadow: none !important;
        }

        .module-checkbox:not(:checked) {
            border-color: #000 !important;
        }

        .btn-close:focus {
            box-shadow: none;
        }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const openModalBtn = document.getElementById('openModuleModalBtn');
        const moduleModal = new bootstrap.Modal(document.getElementById('moduleSelectionModal'));
        const selectAllCheckbox = document.getElementById('selectAllModules');
        const moduleCheckboxes = document.querySelectorAll('.module-checkbox:not(#selectAllModules)');
        const applyFilterBtn = document.getElementById('applyModuleFilterBtn');
        const cards = document.querySelectorAll('.jasa-non-card');
        const statusToast = new bootstrap.Toast(document.getElementById('statusToast')); // Mengubah id dari toastAlert ke statusToast
        const toastBody = document.querySelector('#statusToast .toast-body');

        // Buka modal saat tombol diklik
        openModalBtn.addEventListener('click', function () {
            moduleModal.show();
        });

        // Logika Select All
        selectAllCheckbox.addEventListener('change', function () {
            if (this.checked) {
                moduleCheckboxes.forEach(cb => {
                    cb.checked = true;
                    cb.disabled = true;
                });
            } else {
                moduleCheckboxes.forEach(cb => {
                    cb.disabled = false;
                });
            }
        });

        // Terapkan filter saat halaman dimuat (secara default semua ditampilkan)
        cards.forEach(card => card.style.display = 'block');

        // Logika Apply Filter
        applyFilterBtn.addEventListener('click', function () {
            const selectedModules = Array.from(moduleCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            // Menampilkan toast jika tidak ada module yang dipilih
            if (selectedModules.length === 0 && !selectAllCheckbox.checked) {
                // Mengganti teks toast sesuai kebutuhan
                toastBody.innerHTML = `<i class="bi bi-exclamation-circle-fill me-2"></i> Silahkan pilih module terlebih dahulu.`; 
                
                // Menampilkan toast
                const toastElement = document.getElementById('statusToast');
                if (toastElement) {
                    toastElement.style.display = 'block';
                    statusToast.show();
                }
                
                return;
            }

            cards.forEach(card => {
                const cardModule = card.getAttribute('data-module');
                if (selectAllCheckbox.checked || selectedModules.includes(cardModule)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            moduleModal.hide();
        });

        // Scroll ke Section Detail
        const scrollToSectionBtn = document.getElementById('scrollToSectionBtn');
        if (scrollToSectionBtn) {
            scrollToSectionBtn.addEventListener('click', function (e) {
                e.preventDefault();
                document.getElementById('jasa-non-konstruksi-section')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        }

        // Scroll ke Section Flow
        const scrollToFlowBtn = document.getElementById('scrollToFlowBtn');
        if (scrollToFlowBtn) {
            scrollToFlowBtn.addEventListener('click', function (e) {
                e.preventDefault();
                document.getElementById('flow-section')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        }
    });
    </script>
@endsection