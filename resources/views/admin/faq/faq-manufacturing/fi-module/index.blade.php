@extends('admin.layouts.admin')

@section('title', 'Daftar FAQ FI Module - Manufacturing')

@section('additional_css')
<style>
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
    }
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
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Daftar FAQ FI Module - Manufacturing</h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3 mobile-layout">
                <a href="{{ route('faq-manufacturing.fi-module.create') }}" class="btn btn-primary d-flex align-items-center shadow-sm" style="font-weight: 500; font-size: 0.9rem; padding: 0.5rem 1rem; border-radius: 0.5rem; width: fit-content;">
                    <i class="bi bi-plus-circle me-2" style="font-size: 1rem;"></i> Tambah
                </a>
                <form class="search-form" role="search" method="GET" action="{{ route('faq-manufacturing.fi-module.index') }}">
                    <input class="form-control" type="search" name="search" placeholder="Cari di sini..." aria-label="Search" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary search-btn" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

            <div class="d-flex align-items-center mb-3">
                <label for="entriesPerPage" class="me-2 showing-text">Show</label>
                <form id="entriesPerPageForm" action="{{ route('faq-manufacturing.fi-module.index') }}" method="GET">
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
                            <th class="text-center" style="width: 5%;">No</th>
                            <th style="width: 25%;">Pertanyaan</th>
                            <th style="width: 40%;">Jawaban</th>
                            <th style="width: 20%;">Gambar</th>
                            <th class="text-center" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($faqs as $index => $faq)
                        <tr>
                            <td class="text-center">{{ $faqs->firstItem() + $index }}</td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", Str::limit($faq->question, 70)) : Str::limit($faq->question, 70) !!}
                            </td>
                            <td style="text-align: left;">
                                {!! $searchTerm ? str_ireplace($searchTerm, "<span style='background-color: yellow;'>$searchTerm</span>", Str::limit($faq->answer, 500)) : Str::limit($faq->answer, 500) !!}
                            </td>
                            <td class="text-center">
                                @if($faq->image)
                                    <img src="{{ asset('images/faq-manufacturing/fi/' . $faq->image) }}" alt="FAQ Image" style="width: 100px; height: auto; border: 1px solid #ddd; padding: 5px; border-radius: 8px;">
                                @else
                                    <span>Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="text-start">
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('faq-manufacturing.fi-module.edit', $faq->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $faq->id }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data FAQ manufacturing</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column align-items-start mt-3">
                <div class="showing-text">
                    Showing {{ $faqs->firstItem() ?? 0 }} to {{ $faqs->lastItem() ?? 0 }} of {{ $faqs->total() }} entries
                </div>

                <div class="mt-3 d-flex justify-content-center w-100 mobile-pagination">
                    @if ($faqs->hasPages())
                        <nav>
                            <ul class="pagination justify-content-center">
                                @if (!$faqs->onFirstPage())
                                    <li class="page-item">
                                        <a class="page-link page-link-icon" href="{{ $faqs->appends(request()->input())->url(1) }}">
                                            &#x00AB;
                                        </a>
                                    </li>
                                @endif

                                @if ($faqs->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link page-link-icon">
                                            &#x2039;
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link page-link-icon" href="{{ $faqs->appends(request()->input())->previousPageUrl() }}">
                                            &#x2039;
                                        </a>
                                    </li>
                                @endif

                                @if($faqs->currentPage() > 2)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif

                                @for ($i = max(1, $faqs->currentPage() - 1); $i <= min($faqs->lastPage(), $faqs->currentPage() + 1); $i++)
                                    @if ($i == $faqs->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $faqs->appends(request()->input())->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endfor

                                @if($faqs->currentPage() < $faqs->lastPage() - 1)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif

                                @if ($faqs->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link page-link-icon" href="{{ $faqs->appends(request()->input())->nextPageUrl() }}">
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

                                @if ($faqs->currentPage() < $faqs->lastPage())
                                    <li class="page-item">
                                        <a class="page-link page-link-icon" href="{{ $faqs->appends(request()->input())->url($faqs->lastPage()) }}">
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

@foreach ($faqs as $faq)
    <!-- Modal Hapus -->
    <div class="modal fade" id="deleteModal{{ $faq->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $faq->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $faq->id }}">Konfirmasi Hapus FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data FAQ ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form method="POST" action="{{ route('faq-manufacturing.fi-module.destroy', $faq->id) }}">
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