@extends('admin.layouts.admin')

@section('title', 'Tambah Updates PS')

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
            <h4 class="mb-0">Tambah Updates PS</h4>
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

            <form id="createForm" action="{{ route('ps.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="report" class="form-label">Updates</label>
                    <input type="text" class="form-control @error('report') is-invalid @enderror" id="report" name="report" value="{{ old('report') }}" required>
                    @error('report')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="" disabled selected>Pilih status</option>
                        <option value="on going" {{ old('status') == 'on going' ? 'selected' : '' }}>On Going</option>
                        <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Link Terkait</label>
                    <textarea name="link" id="link" class="form-control @error('link') is-invalid @enderror" rows="3">{{ old('link') }}</textarea>
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <img id="imagePreview" src="#" alt="Preview" />
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">File</label>
                    <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror">
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex mt-3">
                    <a href="{{ route('ps.index') }}" class="btn btn-secondary me-2 btn-custom">Batal</a>
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
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Simpan Updates</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menambahkan updates ini?
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
    document.getElementById('openModalBtn').addEventListener('click', function () {
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

    // Gambar preview
    document.getElementById('image').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('imagePreview');
            preview.src = reader.result;
            preview.style.display = 'block';
        }
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>
@endsection