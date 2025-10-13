@extends('admin.layouts.admin')

@section('title', 'Tambah Capex Procurement Baru')

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
    #imagePreview {
        max-width: 100%;
        max-height: 300px;
        margin-top: 10px;
        display: none;
    }

    /* Custom Dropdown Style */
    .custom-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath fill='none' stroke='%23666666' stroke-width='1.5' d='M5 8l5 5 5-5'/%3E%3C/svg%3E") no-repeat right 1rem center/1.5em;
        background-color: #fff;
        padding-right: 2.5rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    .custom-select option {
        color: #000000; /* Option text color remains black */
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="card card-custom">
        <div class="card-header-custom">
            <h4 class="mb-0">Tambah Capex Procurement Baru</h4>
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

            <form id="createForm" action="{{ route('capex-procurement.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" required>
                    @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="input_process" class="form-label">Input Process</label>
                    <textarea class="form-control @error('input_process') is-invalid @enderror" id="input_process" name="input_process" rows="3" required>{{ old('input_process') }}</textarea>
                    @error('input_process')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="output_process" class="form-label">Output Process</label>
                    <textarea class="form-control @error('output_process') is-invalid @enderror" id="output_process" name="output_process" rows="3">{{ old('output_process') }}</textarea>
                    @error('output_process')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pic" class="form-label">PIC</label>
                    <input type="text" class="form-control @error('pic') is-invalid @enderror" id="pic" name="pic" value="{{ old('pic') }}">
                    @error('pic')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="t_code" class="form-label">T-Code</label>
                    <input type="text" class="form-control @error('t_code') is-invalid @enderror" id="t_code" name="t_code" value="{{ old('t_code') }}">
                    @error('t_code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="proses" class="form-label">Proses</label>
                    <textarea class="form-control @error('proses') is-invalid @enderror" id="proses" name="proses" rows="3">{{ old('proses') }}</textarea>
                    @error('proses')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="link_terkait" class="form-label">Link Terkait</label>
                    <input type="text" class="form-control @error('link_terkait') is-invalid @enderror" id="link_terkait" name="link_terkait" value="{{ old('link_terkait') }}">
                    @error('link_terkait')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="urutan" class="form-label">Urutan</label>
                    <input type="text" class="form-control @error('urutan') is-invalid @enderror" id="urutan" name="urutan" value="{{ old('urutan') }}" required>
                    @error('urutan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Bagian Module -->
                <div class="mb-3">
                    <label for="module" class="form-label">Module</label>
                    <select class="form-select @error('module') is-invalid @enderror" id="module" name="module" required>
                        <option value="" selected disabled>Pilih Module</option>
                        <option value="FI Module" {{ old('module') == 'FI Module' ? 'selected' : '' }}>FI Module</option>
                        <option value="SD Module" {{ old('module') == 'SD Module' ? 'selected' : '' }}>SD Module</option>
                        <option value="PS Module" {{ old('module') == 'PS Module' ? 'selected' : '' }}>PS Module</option>
                        <option value="CO/FM Module" {{ old('module') == 'CO/FM Module' ? 'selected' : '' }}>CO/FM Module</option>
                        <option value="MM Module" {{ old('module') == 'MM Module' ? 'selected' : '' }}>MM Module</option>
                    </select>
                    @error('module')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Capex Procurement</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <img id="imagePreview" src="#" alt="Preview" style="max-width: 100%; max-height: 300px; display: none; margin-top: 10px;">
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('capex-procurement.index') }}" class="btn btn-secondary me-2 btn-custom">Batal</a>
                    <button type="button" class="btn btn-primary btn-custom" id="openModalBtn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Simpan Capex Procurement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menambahkan data capex procurement ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmSaveBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_js')
<script>
    document.getElementById('openModalBtn').addEventListener('click', function() {
        var form = document.getElementById('createForm');

        if (form.checkValidity()) {
            var modal = new bootstrap.Modal(document.getElementById('confirmModal'));
            modal.show();
        } else {
            form.reportValidity();
        }
    });

    document.getElementById('confirmSaveBtn').addEventListener('click', function () {
        document.getElementById('createForm').submit();
    });

    // Script for gambar utama preview
    document.getElementById('image').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
@endsection