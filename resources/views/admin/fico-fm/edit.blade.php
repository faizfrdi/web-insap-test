@extends('admin.layouts.admin')

@section('title', 'Edit FICO/FM')

@section('additional_css')
    <style>
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

        .jasa-konstruksi-image {
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
            height: auto;
            object-fit: cover;
        }

        .toast-container {
            position: fixed;
            top: 70px;
            right: 20px;
            z-index: 1050;
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
            .jasa-konstruksi-image {
                max-width: 100%;
            }

            .toast-container {
                right: 10px;
                width: auto;
            }
        }
    </style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="card card-custom">
        <div class="card-header-custom">
            <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit FICO/FM</h4>
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

            <form id="editForm" action="{{ route('fico-fm.update', $fico_fm->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="report" class="form-label">Updates</label>
                    <textarea class="form-control @error('report') is-invalid @enderror" id="report" name="report" rows="3">{{ old('report', $fico_fm->report) }}</textarea>
                    @error('report')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="" disabled>Pilih Status</option>
                        <option value="done" {{ old('status', $fico_fm->status) == 'done' ? 'selected' : '' }}>Done</option>
                        <option value="on going" {{ old('status', $fico_fm->status) == 'on going' ? 'selected' : '' }}>On Going</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $fico_fm->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="url" name="link" class="form-control" value="{{ old('link', $fico_fm->link ?? '') }}">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input type="file" name="image" class="form-control">
                    @if($fico_fm->image)
                        <div class="text-center mt-3">
                            <p class="form-label text-center">Gambar Saat Ini:</p>
                            <img src="{{ asset('images/fico_fm/' . $fico_fm->image) }}" alt="Current Image" class="jasa-konstruksi-image img-fluid mx-auto">
                        </div>
                    @endif
                    <div class="text-center mt-3" id="newImageContainer" style="display: none;">
                        <p class="form-label text-center">Gambar Baru:</p>
                        <img id="imagePreview" src="#" alt="Preview" class="jasa-konstruksi-image img-fluid mx-auto">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">File</label>
                    <input type="file" name="file" class="form-control">
                    @if($fico_fm->file)
                        <a href="{{ asset('files/fico_fm/' . $fico_fm->file) }}" target="_blank" class="d-block mt-2">Lihat File</a>
                    @endif
                </div>

                <div class="d-flex mt-3">
                    <a href="{{ route('fico-fm.index') }}" class="btn btn-secondary me-2 btn-custom">Batal</a>
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
                <h5 class="modal-title" id="confirmUpdateModalLabel">Konfirmasi Update FICO/FM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Apakah Anda yakin ingin memperbarui data ini?</div>
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
        const imageInput = document.querySelector('[name="image"]');

        const originalData = {
            report: `{!! $fico_fm->report !!}`,
            status: `{!! $fico_fm->status !!}`,
            description: `{!! $fico_fm->description !!}`,
            link: `{!! $fico_fm->link !!}`,
        };

        function compareValues(original, current) {
            return (original || '').trim() === (current || '').trim();
        }

        function checkFormChanges() {
            const currentData = {
                report: document.getElementById('report').value.trim(),
                status: document.getElementById('status').value.trim(),
                description: document.getElementById('description').value.trim(),
                link: document.querySelector('[name="link"]').value.trim(),
                image: document.querySelector('[name="image"]').value,
                file: document.querySelector('[name="file"]').value,
            };

            return compareValues(originalData.report, currentData.report) &&
                compareValues(originalData.status, currentData.status) &&
                compareValues(originalData.description, currentData.description) &&
                compareValues(originalData.link, currentData.link) &&
                !currentData.image && !currentData.file;
        }

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

        openModalBtn.addEventListener('click', function() {
            if (checkFormChanges()) {
                showNoChangesAlert();
            } else {
                const modal = new bootstrap.Modal(document.getElementById('confirmUpdateModal'));
                modal.show();
            }
        });

        confirmSaveBtn.addEventListener('click', () => editForm.submit());

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

        setupImagePreview(imageInput, 'imagePreview', 'newImageContainer');
    });
</script>
@endsection