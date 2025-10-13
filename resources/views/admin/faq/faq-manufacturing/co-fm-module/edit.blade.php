@extends('admin.layouts.admin')

@section('title', 'Edit FAQ CO/FM Module - Manufacturing')

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
    .faq-image {
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

    @media (max-width: 576px) {
        .toast-container {
            right: 10px;
            left: auto;
            width: auto;
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
        .faq-image {
            max-width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="card card-custom">
        <div class="card-header-custom">
            <h4 class="mb-0">Edit FAQ CO/FM Module - Manufacturing</h4>
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

            <form id="editForm" action="{{ route('faq-manufacturing.co-fm-module.update', $faq->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="question" class="form-label">Pertanyaan</label>
                    <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{ old('question', $faq->question) }}" required>
                    @error('question')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="answer" class="form-label">Jawaban</label>
                    <textarea class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" rows="3" required>{{ old('answer', $faq->answer) }}</textarea>
                    @error('answer')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Bagian Gambar Saat Ini -->
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar FAQ</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @if ($faq->image)
                        <div class="text-center mt-3">
                            <p class="form-label text-center">Gambar Saat Ini:</p>
                            <img src="{{ asset('images/faq-manufacturing/co-fm/' . $faq->image) }}" 
                                alt="{{ $faq->question }}" 
                                class="faq-image img-fluid mx-auto" 
                                style="max-width: 500px;">
                        </div>
                    @endif
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        
                <!-- Bagian Gambar Perubahan -->
                <div class="mb-3 text-center" id="newImageContainer" style="display: none;">
                    <p class="form-label text-center">Gambar Baru:</p>
                    <img id="imagePreview" src="#" alt="Preview" class="faq-image img-fluid mx-auto">
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('faq-manufacturing.co-fm-module.index') }}" class="btn btn-secondary me-2 btn-custom">Batal</a>
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
                <h5 class="modal-title" id="confirmUpdateModalLabel">Konfirmasi Update FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin memperbarui data FAQ ini?
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
    document.getElementById('openModalBtn').addEventListener('click', function() {
        var form = document.getElementById('editForm');
        var originalQuestion = '{{ $faq->question }}';
        var originalAnswer = '{{ $faq->answer }}';
        var currentQuestion = document.getElementById('question').value;
        var currentAnswer = document.getElementById('answer').value;
        var imageInput = document.getElementById('image');

        var isQuestionChanged = originalQuestion !== currentQuestion;
        var isAnswerChanged = originalAnswer !== currentAnswer;
        var isImageChanged = imageInput.files.length > 0;

        if (!isQuestionChanged && !isAnswerChanged && !isImageChanged) {
            // Langsung tulis logika showAlert di sini tanpa membuat fungsi terpisah
            var alertContainer = document.getElementById('alert-container');

            // Membuat elemen alert
            var alert = document.createElement('div');
            alert.className = 'alert-custom toast align-items-center';
            alert.role = 'alert';
            alert.innerHTML = `
                <div class="d-flex justify-content-between">
                    <div>Tidak ada perubahan yang Anda lakukan.</div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;

            // Menambahkan alert ke container
            alertContainer.appendChild(alert);

            // Menampilkan alert sebagai toast
            var toast = new bootstrap.Toast(alert);
            toast.show();

            // Set timeout untuk menghapus alert setelah 4 detik jika tidak di-hover
            var hideTimeout = setTimeout(function() {
                alert.remove();
            }, 4000);

            // Menghapus timeout jika alert di-hover
            alert.addEventListener('mouseover', function() {
                clearTimeout(hideTimeout);
            });

            // Memulai ulang timeout ketika alert tidak di-hover lagi
            alert.addEventListener('mouseleave', function() {
                hideTimeout = setTimeout(function() {
                    alert.remove();
                }, 4000);
            });
        } else {
            var modal = new bootstrap.Modal(document.getElementById('confirmUpdateModal'));
            modal.show();
        }
    });

    document.getElementById('confirmSaveBtn').addEventListener('click', function () {
        document.getElementById('editForm').submit();
    });

    // Script for image preview
    document.getElementById('image').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            var container = document.getElementById('newImageContainer');
            output.src = reader.result;
            output.style.display = 'block';
            container.style.display = 'block';
        }
        // Cek apakah file diunggah dan jika tipe file adalah gambar
        if (event.target.files && event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    });

</script>
@endsection