@extends('admin.layouts.admin')

@section('title', 'Edit Jasa Non Konstruksi')

@section('additional_css')
<style>
    /* General Styling */
    .card-custom {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .card-header-custom {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        padding: 15px 20px;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        border-color: #80bdff;
    }

    .btn-custom {
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        font-weight: bold;
        text-align: left;
        display: block;
    }

    /* Style for image preview */
    .jasa-non-konstruksi-image {
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 8px;
        width: 100%; /* Mengubah menjadi 100% untuk responsivitas */
        max-width: 500px; /* Ukuran maksimum untuk tampilan desktop */
        height: auto;
        object-fit: cover; /* Memastikan gambar tetap proporsional */
    }

    .toast-container {
        position: fixed;
        top: 70px;
        right: 20px;
        z-index: 1050;
    }

    @media (max-width: 576px) {
        .toast-container {
            right: 10px; /* Mengatur jarak ke kanan lebih kecil di tampilan mobile */
            left: auto;  /* Pastikan tidak ada pengaturan left yang membuatnya bergeser */
            width: auto; /* Pastikan alert menyesuaikan lebar kontainer */
        }
    }

    .alert-custom {
        background-color: #ec1c24;
        color: white;
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        border-radius: 5px;
        padding: 1rem;
        font-size: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-close-white {
        color: white;
    }

    @media (max-width: 576px) {
        .jasa-non-konstruksi-image {
            max-width: 100%; /* Memastikan gambar lebih besar di tampilan mobile */
        }
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="card card-custom">
        <div class="card-header-custom">
            <h4 class="mb-0">Edit Jasa Non Konstruksi</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form id="editForm" action="{{ route('jasa-non-konstruksi.update', $jasa_non_konstruksi->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Jasa Non Konstruksi</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $jasa_non_konstruksi->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input_process" class="form-label">Input Process</label>
                    <textarea class="form-control @error('input_process') is-invalid @enderror" id="input_process" name="input_process" rows="3" required>{{ old('input_process', $jasa_non_konstruksi->input_process) }}</textarea>
                    @error('input_process')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="output_process" class="form-label">Output Process</label>
                    <textarea class="form-control @error('output_process') is-invalid @enderror" id="output_process" name="output_process" rows="3">{{ old('output_process', $jasa_non_konstruksi->output_process) }}</textarea>
                    @error('output_process')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pic" class="form-label">PIC</label>
                    <input type="text" class="form-control @error('pic') is-invalid @enderror" id="pic" name="pic" value="{{ old('pic', $jasa_non_konstruksi->pic) }}">
                    @error('pic')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="t_code" class="form-label">T-Code</label>
                    <input type="text" class="form-control @error('t_code') is-invalid @enderror" id="t_code" name="t_code" value="{{ old('t_code', $jasa_non_konstruksi->t_code) }}">
                    @error('t_code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="proses" class="form-label">Proses</label>
                    <textarea class="form-control @error('proses') is-invalid @enderror" id="proses" name="proses" rows="3">{{ old('proses', $jasa_non_konstruksi->proses) }}</textarea>
                    @error('proses')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="link_terkait" class="form-label">Link Terkait</label>
                    <input type="text" class="form-control @error('link_terkait') is-invalid @enderror" id="link_terkait" name="link_terkait" value="{{ old('link_terkait', $jasa_non_konstruksi->link_terkait) }}">
                    @error('link_terkait')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="urutan" class="form-label">Urutan Jasa Non Konstruksi</label>
                    <input type="text" class="form-control @error('urutan') is-invalid @enderror" id="urutan" name="urutan" value="{{ old('urutan', $jasa_non_konstruksi->urutan) }}" required>
                    @error('urutan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="module" class="form-label">Pilih Module</label>
                    <select class="form-select @error('module') is-invalid @enderror" id="module" name="module" required>
                        <option value="" disabled>Pilih Module</option>
                        <option value="FI Module" {{ (old('module', $jasa_non_konstruksi->module) == 'FI Module') ? 'selected' : '' }}>FI Module</option>
                        <option value="SD Module" {{ (old('module', $jasa_non_konstruksi->module) == 'SD Module') ? 'selected' : '' }}>SD Module</option>
                        <option value="PS Module" {{ (old('module', $jasa_non_konstruksi->module) == 'PS Module') ? 'selected' : '' }}>PS Module</option>
                        <option value="CO/FM Module" {{ (old('module', $jasa_non_konstruksi->module) == 'CO/FM Module') ? 'selected' : '' }}>CO/FM Module</option>
                        <option value="MM Module" {{ (old('module', $jasa_non_konstruksi->module) == 'MM Module') ? 'selected' : '' }}>MM Module</option>
                    </select>
                    @error('module')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Bagian Gambar Utama -->
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Jasa Non Konstruksi</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @if ($jasa_non_konstruksi->image)
                        <div class="text-center mt-3">
                            <p class="form-label text-center">Gambar Saat Ini:</p>
                            <img src="{{ asset('images/jasa_non_konstruksi/' . $jasa_non_konstruksi->image) }}" 
                                alt="{{ $jasa_non_konstruksi->judul }}" 
                                class="jasa-non-konstruksi-image img-fluid mx-auto">
                        </div>
                    @endif
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 text-center" id="newImageContainer" style="display: none;">
                    <p class="form-label text-center">Gambar Baru:</p>
                    <img id="imagePreview" src="#" alt="Preview" class="jasa-non-konstruksi-image img-fluid mx-auto">
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('jasa-non-konstruksi.index') }}" class="btn btn-secondary me-2 btn-custom">Batal</a>
                    <button type="button" class="btn btn-success btn-custom" id="openModalBtn">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmUpdateModal" tabindex="-1" aria-labelledby="confirmUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmUpdateModalLabel">Konfirmasi Update Jasa Non Konstruksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin memperbarui data jasa non konstruksi ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="confirmSaveBtn">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="toast-container" id="alert-container"></div>

@endsection

@section('additional_js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const openModalBtn = document.getElementById('openModalBtn');
        const confirmSaveBtn = document.getElementById('confirmSaveBtn');
        const editForm = document.getElementById('editForm');
        const alertContainer = document.getElementById('alert-container');
        const imageInput = document.getElementById('image');

        // Original values from server
        const originalData = {
            judul: '{!! $jasa_non_konstruksi->judul !!}',
            input_process: '{!! $jasa_non_konstruksi->input_process !!}',
            output_process: '{!! $jasa_non_konstruksi->output_process !!}',
            pic: '{!! $jasa_non_konstruksi->pic !!}',
            t_code: '{!! $jasa_non_konstruksi->t_code !!}',
            proses: '{!! $jasa_non_konstruksi->proses !!}',
            link_terkait: '{!! $jasa_non_konstruksi->link_terkait !!}',
            urutan: '{!! $jasa_non_konstruksi->urutan !!}',
            module: '{!! $jasa_non_konstruksi->module !!}'
        };

        // Function to safely compare values
        function compareValues(original, current) {
            // Trim and normalize comparison
            const originalTrimmed = (original || '').toString().trim();
            const currentTrimmed = (current || '').toString().trim();
            return originalTrimmed === currentTrimmed;
        }

        // Function to check if any changes have been made
        function checkFormChanges() {
            const currentData = {
                judul: document.getElementById('judul').value.trim(),
                input_process: document.getElementById('input_process').value.trim(),
                output_process: document.getElementById('output_process').value.trim(),
                pic: document.getElementById('pic').value.trim(),
                t_code: document.getElementById('t_code').value.trim(),
                proses: document.getElementById('proses').value.trim(),
                link_terkait: document.getElementById('link_terkait').value.trim(),
                urutan: document.getElementById('urutan').value.trim(),
                module: document.getElementById('module').value.trim()
            };

            // Check text inputs
            const isTextUnchanged = Object.keys(originalData).every(key => 
                compareValues(originalData[key], currentData[key])
            );

            // Check file inputs
            const isImageUnchanged = imageInput.files.length === 0;

            return isTextUnchanged && isImageUnchanged;
        }

        // Function to show toast alert
        function showNoChangesAlert() {
            const alert = document.createElement('div');
            alert.className = 'alert-custom toast align-items-center';
            alert.role = 'alert';
            alert.innerHTML = `
                <div class="d-flex justify-content-between">
                    <div>Tidak ada perubahan yang Anda lakukan.</div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;

            alertContainer.appendChild(alert);

            const toast = new bootstrap.Toast(alert);
            toast.show();

            let hideTimeout = setTimeout(() => alert.remove(), 4000);

            alert.addEventListener('mouseover', () => clearTimeout(hideTimeout));
            alert.addEventListener('mouseleave', () => {
                hideTimeout = setTimeout(() => alert.remove(), 4000);
            });
        }

        // Event listener for update button
        openModalBtn.addEventListener('click', function() {
            if (checkFormChanges()) {
                showNoChangesAlert();
            } else {
                const modal = new bootstrap.Modal(document.getElementById('confirmUpdateModal'));
                modal.show();
            }
        });

        // Event listener for confirm save button
        confirmSaveBtn.addEventListener('click', () => editForm.submit());

        // Image preview functions
        function setupImagePreview(inputElement, previewImageId, previewContainerId) {
            inputElement.addEventListener('change', function(event) {
                const reader = new FileReader();
                const previewImage = document.getElementById(previewImageId);
                const previewContainer = document.getElementById(previewContainerId);

                reader.onload = function() {
                    previewImage.src = reader.result;
                    previewImage.style.display = 'block';
                    previewContainer.style.display = 'block';
                };

                if (event.target.files && event.target.files[0]) {
                    reader.readAsDataURL(event.target.files[0]);
                }
            });
        }

        // Setup image previews
        setupImagePreview(imageInput, 'imagePreview', 'newImageContainer');
    });
</script>
@endsection