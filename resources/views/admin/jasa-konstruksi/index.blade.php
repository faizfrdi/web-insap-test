@extends('admin.layouts.admin')

@section('title', 'Daftar Jasa Konstruksi')

@section('additional_css')
<style>
    /* Pengaturan untuk form pencarian */
    .search-form {
        display: flex;
        align-items: center;
    }

    .search-form .form-control {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .search-form .search-btn {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    /* Responsivitas untuk perangkat kecil */
    @media (max-width: 767px) {
        .mobile-layout {
            flex-direction: column;   /* Mengatur layout menjadi kolom pada perangkat kecil */
            align-items: flex-start !important;  /* Menjaga item di sebelah kiri */
        }

        /* Styling form pencarian di perangkat mobile */
        .mobile-layout .search-form {
            margin-top: 1rem;  /* Memberi margin atas */
            width: 100%;       /* Membuat form pencarian lebar penuh */
        }

        .mobile-pagination {
            margin-top: 1rem;  /* Memberi margin atas pada pagination */
        }

        /* Memperbaiki tampilan card dan konten pada perangkat kecil */
        .card {
            width: 100%;  /* Mengatur lebar card menjadi 100% */
            margin-bottom: 1rem;  /* Memberi jarak antara card */
        }
    }

    /* Pengaturan untuk tabel secara keseluruhan */
    .table {
        table-layout: fixed;   /* Memastikan lebar kolom tetap meskipun ada konten panjang */
        width: 100%;            /* Membuat tabel mengisi lebar container */
        border-collapse: collapse; /* Menghilangkan jarak antar sel */
    }

    /* Styling untuk header dan sel tabel */
    .table th, .table td {
        padding: 10px;            /* Menambahkan padding di dalam sel */
        text-align: center;       /* Mengatur perataan teks di tengah */
        word-wrap: break-word;    /* Memastikan teks panjang terpecah dalam kolom */
        border: 1px solid #ddd;   /* Menambahkan border antar sel */
    }

    /* Menjaga gambar dalam sel tabel agar tidak melampaui lebar kolom */
    .table img {
        max-width: 100%;
        height: auto;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Daftar Jasa Konstruksi</h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3 mobile-layout">
                <a href="{{ route('jasa-konstruksi.create') }}" class="btn btn-primary d-flex align-items-center shadow-sm" style="font-weight: 500; font-size: 0.9rem; padding: 0.5rem 1rem; border-radius: 0.5rem; width: fit-content;">
                    <i class="bi bi-plus-circle me-2" style="font-size: 1rem;"></i> Tambah
                </a>
                <form class="search-form" role="search" method="GET" action="{{ route('jasa-konstruksi.index') }}">
                    <input class="form-control" type="search" name="search" placeholder="Cari di sini..." aria-label="Search" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary search-btn" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

            <div class="d-flex align-items-center mb-3">
                <label for="entriesPerPage" class="me-2 showing-text">Show</label>
                <form id="entriesPerPageForm" action="{{ route('jasa-konstruksi.index') }}" method="GET">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <select name="entries" id="entriesPerPage" class="form-select" style="width: auto;" onchange="document.getElementById('entriesPerPageForm').submit()">
                        <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('entries') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>
                <span class="ms-2 showing-text">entries</span>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-danger">
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th style="width: 150px;">Judul</th>
                            <th style="width: 150px;">Input Process</th>
                            <th style="width: 150px;">Output Process</th>
                            <th style="width: 100px;">PIC</th>
                            <th style="width: 100px;">T-Code</th>
                            <th style="width: 150px;">Proses</th>
                            <th style="width: 150px;">Link Terkait</th>
                            <th style="width: 80px;">Urutan</th>
                            <th style="width: 100px;">Module</th> 
                            <th style="width: 150px;">Gambar Utama</th>
                            <th style="width: 95px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jasaKonstruksis as $index => $jasa_konstruksi)
                        <tr>
                            <td class="text-center">{{ $jasaKonstruksis->firstItem() + $index }}</td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $jasa_konstruksi->judul) : $jasa_konstruksi->judul !!}
                            </td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", Str::limit($jasa_konstruksi->input_process, 100)) : Str::limit($jasa_konstruksi->input_process, 100) !!}
                            </td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $jasa_konstruksi->output_process ?? '-') : ($jasa_konstruksi->output_process ?? '-') !!}
                            </td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $jasa_konstruksi->pic ?? '-') : ($jasa_konstruksi->pic ?? '-') !!}
                            </td>
                            <td style="text-align: center;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $jasa_konstruksi->t_code ?? '-') : ($jasa_konstruksi->t_code ?? '-') !!}
                            </td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $jasa_konstruksi->proses ?? '-') : ($jasa_konstruksi->proses ?? '-') !!}
                            </td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $jasa_konstruksi->link_terkait ?? '-') : ($jasa_konstruksi->link_terkait ?? '-') !!}
                            </td>
                            <td style="text-align: center;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $jasa_konstruksi->urutan ?? '-') : ($jasa_konstruksi->urutan ?? '-') !!}
                            </td>
                            <td style="text-align: center;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $jasa_konstruksi->module ?? '-') : ($jasa_konstruksi->module ?? '-') !!}
                            </td>
                            <td>
                                @if ($jasa_konstruksi->image)
                                    <img src="{{ asset('images/jasa_konstruksi/' . $jasa_konstruksi->image) }}" alt="{{ $jasa_konstruksi->judul }}" style="width: 100px; height: auto; border: 1px solid #ddd; padding: 5px; border-radius: 8px;">
                                @else
                                    <span>Tidak ada gambar</span>
                                @endif
                            </td>
                            <td style="text-align: left;">
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('scenarios.jasa-konstruksi', $jasa_konstruksi->slug) }}" class="btn btn-sm btn-primary text-decoration-none" target="_blank" rel="noopener noreferrer">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('jasa-konstruksi.edit', $jasa_konstruksi->id) }}" class="btn btn-sm btn-warning me-2">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $jasa_konstruksi->id }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="13" class="text-center">Tidak ada data jasa konstruksi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column align-items-start mt-3">
                <div class="showing-text">
                    Showing {{ $jasaKonstruksis->firstItem() ?? 0 }} to {{ $jasaKonstruksis->lastItem() ?? 0 }} of {{ $jasaKonstruksis->total() }} entries
                </div>

                <div class="mt-3 d-flex justify-content-center w-100 mobile-pagination">
                    @if ($jasaKonstruksis->hasPages())
                        <nav>
                            <ul class="pagination justify-content-center">
                                @if (!$jasaKonstruksis->onFirstPage())
                                    <li class="page-item">
                                        <a class="page-link page-link-icon" href="{{ $jasaKonstruksis->appends(request()->input())->url(1) }}">
                                            &#x00AB;
                                        </a>
                                    </li>
                                @endif

                                @if ($jasaKonstruksis->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link page-link-icon">
                                            &#x2039;
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link page-link-icon" href="{{ $jasaKonstruksis->appends(request()->input())->previousPageUrl() }}">
                                            &#x2039;
                                        </a>
                                    </li>
                                @endif

                                @if($jasaKonstruksis->currentPage() > 2)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif

                                @for ($i = max(1, $jasaKonstruksis->currentPage() - 1); $i <= min($jasaKonstruksis->lastPage(), $jasaKonstruksis->currentPage() + 1); $i++)
                                    @if ($i == $jasaKonstruksis->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $jasaKonstruksis->appends(request()->input())->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endfor

                                @if($jasaKonstruksis->currentPage() < $jasaKonstruksis->lastPage() - 1)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif

                                @if ($jasaKonstruksis->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link page-link-icon" href="{{ $jasaKonstruksis->appends(request()->input())->nextPageUrl() }}">
                                            &#x203A;
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link page-link-icon">
                                            &#x203A;
                                        </span>
                                    </li>
                                @endif

                                @if ($jasaKonstruksis->currentPage() < $jasaKonstruksis->lastPage())
                                    <li class="page-item">
                                        <a class="page-link page-link-icon" href="{{ $jasaKonstruksis->appends(request()->input())->url($jasaKonstruksis->lastPage()) }}">
                                            &#x00BB;
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($jasaKonstruksis as $jasa_konstruksi)
    <!-- Modal Hapus -->
    <div class="modal fade" id="deleteModal{{ $jasa_konstruksi->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $jasa_konstruksi->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $jasa_konstruksi->id }}">Konfirmasi Hapus Jasa Konstruksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data jasa konstruksi ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form method="POST" action="{{ route('jasa-konstruksi.destroy', $jasa_konstruksi->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection