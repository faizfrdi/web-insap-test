@extends('admin.layouts.admin')

@section('title', 'Daftar Updates MM')

@section('additional_css')
<style>
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

    @media (max-width: 767px) {
        .mobile-layout {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .mobile-layout .search-form {
            margin-top: 1rem;
            width: 100%;
        }

        .mobile-pagination {
            margin-top: 1rem;
        }

        .card {
            width: 100%;
            margin-bottom: 1rem;
        }
    }

    .table {
        table-layout: fixed;
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 10px;
        text-align: center;
        word-wrap: break-word;
        border: 1px solid #ddd;
    }

    .table img {
        max-width: 100%;
        height: auto;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 8px;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Daftar Updates MM</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3 mobile-layout">
                <a href="{{ route('mm.create') }}" class="btn btn-primary d-flex align-items-center shadow-sm" style="font-weight: 500; font-size: 0.9rem; padding: 0.5rem 1rem; border-radius: 0.5rem;">
                    <i class="bi bi-plus-circle me-2"></i> Tambah
                </a>
                <form class="search-form" method="GET" action="{{ route('mm.index') }}">
                    <input class="form-control" type="search" name="search" placeholder="Cari di sini..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary search-btn" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <div class="d-flex align-items-center mb-3">
                <label for="entriesPerPage" class="me-2 showing-text">Show</label>
                <form id="entriesPerPageForm" action="{{ route('mm.index') }}" method="GET">
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
                            <th style="width: 50px;">No</th>
                            <th style="width: 200px;">Updates</th>
                            <th style="width: 150px;">Status</th>
                            <th style="width: 300px;">Deskripsi</th>
                            <th style="width: 300px;">Link</th>
                            <th style="width: 150px;">Gambar</th>
                            <th style="width: 150px;">File</th>
                            <th style="width: 150px;">Tanggal Dibuat</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $index => $report)
                        <tr>
                            <td>{{ $reports->firstItem() + $index }}</td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $report->report) : $report->report !!}
                            </td>
                            <td>{{ $report->status ?? '-' }}</td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", $report->description ?? '-') : ($report->description ?? '-') !!}
                            </td>
                            <td>
                                @if($report->link)
                                    <a href="{{ $report->link }}" target="_blank" rel="noopener noreferrer">{{ $report->link }}</a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td>
                                @if($report->image)
                                    <img src="{{ asset('images/mm/' . $report->image) }}" alt="Gambar Updates">
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td>
                                @if ($report->file)
                                    <a href="{{ asset('files/mm/' . $report->file) }}" target="_blank" rel="noopener noreferrer">{{ basename($report->file) }}</a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td>{{ $report->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('mm.public.show', $report->id) }}" class="btn btn-sm btn-primary" target="_blank" rel="noopener noreferrer"><i class="bi bi-eye"></i> Lihat</a>
                                    <a href="{{ route('mm.edit', $report->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Edit</a>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $report->id }}"><i class="bi bi-trash"></i> Hapus</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data updates.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column align-items-start mt-3">
                <div class="showing-text">
                    Showing {{ $reports->firstItem() ?? 0 }} to {{ $reports->lastItem() ?? 0 }} of {{ $reports->total() }} entries
                </div>

                <div class="mt-3 d-flex justify-content-center w-100 mobile-pagination">
                    @if ($reports->hasPages())
                        <nav>
                            <ul class="pagination justify-content-center">
                                {{-- Tombol navigasi --}}
                                @if (!$reports->onFirstPage())
                                    <li class="page-item"><a class="page-link page-link-icon" href="{{ $reports->appends(request()->input())->url(1) }}">&#x00AB;</a></li>
                                @endif

                                @if ($reports->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link page-link-icon">&#x2039;</span></li>
                                @else
                                    <li class="page-item"><a class="page-link page-link-icon" href="{{ $reports->appends(request()->input())->previousPageUrl() }}">&#x2039;</a></li>
                                @endif

                                @if($reports->currentPage() > 2)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif

                                @for ($i = max(1, $reports->currentPage() - 1); $i <= min($reports->lastPage(), $reports->currentPage() + 1); $i++)
                                    <li class="page-item {{ $i == $reports->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $reports->appends(request()->input())->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if($reports->currentPage() < $reports->lastPage() - 1)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif

                                @if ($reports->hasMorePages())
                                    <li class="page-item"><a class="page-link page-link-icon" href="{{ $reports->appends(request()->input())->nextPageUrl() }}">&#x203A;</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link page-link-icon">&#x203A;</span></li>
                                @endif

                                @if ($reports->currentPage() < $reports->lastPage())
                                    <li class="page-item"><a class="page-link page-link-icon" href="{{ $reports->appends(request()->input())->url($reports->lastPage()) }}">&#x00BB;</a></li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($reports as $report)
<div class="modal fade" id="deleteModal{{ $report->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $report->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Apakah Anda yakin ingin menghapus updates ini?</div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('mm.destroy', $report->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection