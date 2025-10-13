@extends('admin.layouts.admin')

@section('title', 'Daftar Manufacturing')

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
        <h1 class="mb-0">Daftar Manufacturing</h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3 mobile-layout">
                <a href="{{ route('manufacturing.create') }}" class="btn btn-primary d-flex align-items-center shadow-sm" style="font-weight: 500; font-size: 0.9rem; padding: 0.5rem 1rem; border-radius: 0.5rem; width: fit-content;">
                    <i class="bi bi-plus-circle me-2" style="font-size: 1rem;"></i> Tambah
                </a>
                <form class="search-form" role="search" method="GET" action="{{ route('manufacturing.index') }}">
                    <input class="form-control" type="search" name="search" placeholder="Cari di sini..." aria-label="Search" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary search-btn" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

            <div class="d-flex align-items-center mb-3">
                <label for="entriesPerPage" class="me-2 showing-text">Show</label>
                <form id="entriesPerPageForm" action="{{ route('manufacturing.index') }}" method="GET">
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
                        @forelse ($manufacturings as $index => $manufacturing)
                        <tr>
                            <td class="text-center">{{ $manufacturings->firstItem() + $index }}</td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $manufacturing->judul) : $manufacturing->judul !!}
                            </td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", Str::limit($manufacturing->input_process, 100)) : Str::limit($manufacturing->input_process, 100) !!}
                            </td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $manufacturing->output_process ?? '-') : ($manufacturing->output_process ?? '-') !!}
                            </td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $manufacturing->pic ?? '-') : ($manufacturing->pic ?? '-') !!}
                            </td>
                            <td style="text-align: center;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $manufacturing->t_code ?? '-') : ($manufacturing->t_code ?? '-') !!}
                            </td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $manufacturing->proses ?? '-') : ($manufacturing->proses ?? '-') !!}
                            </td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $manufacturing->link_terkait ?? '-') : ($manufacturing->link_terkait ?? '-') !!}
                            </td>
                            <td style="text-align: center;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $manufacturing->urutan ?? '-') : ($manufacturing->urutan ?? '-') !!}
                            </td>
                            <td style="text-align: center;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $manufacturing->module ?? '-') : ($manufacturing->module ?? '-') !!}
                            </td>
                            <td>
                                @if ($manufacturing->image)
                                    <img src="{{ asset('images/manufacturing/' . $manufacturing->image) }}" alt="{{ $manufacturing->judul }}" style="width: 100px; height: auto; border: 1px solid #ddd; padding: 5px; border-radius: 8px;">
                                @else
                                    <span>Tidak ada gambar</span>
                                @endif
                            </td>
                            <td style="text-align: left;">
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('scenarios.manufacturing', $manufacturing->slug) }}" class="btn btn-sm btn-primary text-decoration-none" target="_blank" rel="noopener noreferrer">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('manufacturing.edit', $manufacturing->id) }}" class="btn btn-sm btn-warning me-2">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $manufacturing->id }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="13" class="text-center">Tidak ada data manufacturing</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column align-items-start mt-3">
                <div class="showing-text">
                    Showing {{ $manufacturings->firstItem() ?? 0 }} to {{ $manufacturings->lastItem() ?? 0 }} of {{ $manufacturings->total() }} entries
                </div>

                <div class="mt-3 d-flex justify-content-center w-100 mobile-pagination">
                    @if ($manufacturings->hasPages())
                        <nav>
                            <ul class="pagination justify-content-center">
                                @if (!$manufacturings->onFirstPage())
                                    <li class="page-item">
                                        <a class="page-link page-link-icon" href="{{ $manufacturings->appends(request()->input())->url(1) }}">
                                            &#x00AB;
                                        </a>
                                    </li>
                                @endif

                                @if ($manufacturings->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link page-link-icon">
                                            &#x2039;
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link page-link-icon" href="{{ $manufacturings->appends(request()->input())->previousPageUrl() }}">
                                            &#x2039;
                                        </a>
                                    </li>
                                @endif

                                @if ($manufacturings->currentPage() > 2)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif

                                @for ($i = max(1, $manufacturings->currentPage() - 1); $i <= min($manufacturings->lastPage(), $manufacturings->currentPage() + 1); $i++)
                                    @if ($i == $manufacturings->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $manufacturings->appends(request()->input())->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endfor

                                @if ($manufacturings->currentPage() < $manufacturings->lastPage() - 1)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif

                                @if ($manufacturings->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link page-link-icon" href="{{ $manufacturings->appends(request()->input())->nextPageUrl() }}">
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

                                @if ($manufacturings->currentPage() < $manufacturings->lastPage())
                                    <li class="page-item">
                                        <a class="page-link page-link-icon" href="{{ $manufacturings->appends(request()->input())->url($manufacturings->lastPage()) }}">
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

@foreach ($manufacturings as $manufacturing)
    <!-- Modal Hapus -->
    <div class="modal fade" id="deleteModal{{ $manufacturing->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $manufacturing->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $manufacturing->id }}">Konfirmasi Hapus Manufacturing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data manufacturing ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form method="POST" action="{{ route('manufacturing.destroy', $manufacturing->id) }}">
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