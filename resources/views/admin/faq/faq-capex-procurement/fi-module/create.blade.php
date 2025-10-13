@extends('admin.layouts.admin')

@section('title', 'Tambah FAQ FI Module - Capex Procurement')

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
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="card card-custom">
        <div class="card-header-custom">
            <h4 class="mb-0">Tambah FAQ FI Module Baru - Capex Procurement</h4>
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

            <form id="createForm" action="{{ route('faq-capex-procurement.fi-module.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="question" class="form-label">Pertanyaan</label>
                    <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{ old('question') }}" required>
                    @error('question')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="answer" class="form-label">Jawaban</label>
                    <textarea class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" rows="3" required>{{ old('answer') }}</textarea>
                    @error('answer')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar FAQ</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <img id="imagePreview" src="#" alt="Preview" />
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('faq-capex-procurement.fi-module.index') }}" class="btn btn-secondary me-2 btn-custom">Batal</a>
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
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Simpan FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menambahkan data FAQ ini?
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

    // Script for image preview
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