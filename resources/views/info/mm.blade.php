@extends('layouts.layout')

@section('content')
<div id="flow-section" class="p-3 p-md-5 mb-5" style="border-radius: 15px; border: 1px solid #ddd; background-color: #fbfbfd;">
    <div class="container mt-4">
        <h3 class="mb-4 fw-bold">MM Module Updates</h3>

        <!-- Tombol Filter Status -->
        <div class="mb-4 d-flex justify-content-start">
            <button id="openStatusModalBtn" class="btn btn-custom-red btn-sm">
                <i class="bi bi-filter me-1"></i> Pilih Status
            </button>
        </div>

        <!-- Modal Filter Status -->
        <div class="modal fade" id="statusSelectionModal" tabindex="-1" aria-labelledby="statusSelectionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="GET" action="{{ url()->current() }}" id="statusFilterForm">
                        <div class="modal-header">
                            <h5 class="modal-title">Pilih Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-check mb-3">
                                <input class="form-check-input status-checkbox" type="checkbox" id="selectAllStatus">
                                <label class="form-check-label" for="selectAllStatus">Semua Status</label>
                            </div>
                            @php
                                $statuses = ['done' => 'Done', 'on going' => 'On Going'];
                                $selectedStatuses = request()->input('status', []);
                            @endphp
                            @foreach($statuses as $value => $label)
                                <div class="form-check mb-2">
                                    <input class="form-check-input status-checkbox" name="status[]" type="checkbox" value="{{ $value }}" id="{{ $value }}"
                                        {{ in_array($value, $selectedStatuses) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $value }}">{{ $label }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="applyStatusFilterBtn">Pilih</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Toast Alert -->
        <div class="position-fixed" style="top: 100px; right: 20px; z-index: 2000; max-width: 300px; width: auto;">
            <div id="statusToast" class="toast align-items-center text-white border-0" role="alert" data-bs-delay="3000"
                style="background-color: #ec1c24; display: none; word-wrap: break-word;">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-exclamation-circle-fill me-2"></i> Pilih minimal satu status!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="table-responsive">
            <table class="table table-bordered" style="border-radius: 12px; overflow: hidden;">
                <thead class="text-center">
                    <tr>
                        <th class="py-3 px-3 custom-header">No</th>
                        <th class="py-3 custom-header">Updates</th>
                        <th class="py-3 custom-header">Status</th>
                        <th class="py-3 custom-header">Deskripsi</th>
                        <th class="py-3 custom-header">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($reports as $index => $report)
                        <tr>
                            <td class="py-2 px-3 text-center">{{ ($reports->currentPage() - 1) * $reports->perPage() + $index + 1 }}</td>
                            <td class="py-2">{{ $report->report }}</td>
                            <td class="py-2 text-center">
                                <span class="badge {{ $report->status === 'done' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ ucfirst($report->status) }}
                                </span>
                            </td>
                            <td class="py-2">{{ $report->description }}</td>
                            <td>
                                <a href="{{ url('/info/mm/' . $report->id) }}" class="btn btn-primary btn-sm fw-bold">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-3">Belum ada updates.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($reports->hasPages())
            <div class="mt-3 d-flex justify-content-center">
                <nav>
                    <ul class="pagination justify-content-center">
                        {{-- Tombol ke halaman pertama --}}
                        @if (!$reports->onFirstPage())
                            <li class="page-item">
                                <a class="page-link" href="{{ $reports->appends(request()->query())->url(1) }}">
                                    &#x00AB;
                                </a>
                            </li>
                        @endif

                        {{-- Tombol sebelumnya --}}
                        @if ($reports->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&#x2039;</span></li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $reports->appends(request()->query())->previousPageUrl() }}">
                                    &#x2039;
                                </a>
                            </li>
                        @endif

                        {{-- Titik-titik sebelum --}}
                        @if ($reports->currentPage() > 2)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif

                        {{-- Nomor halaman --}}
                        @for ($i = max(1, $reports->currentPage() - 1); $i <= min($reports->lastPage(), $reports->currentPage() + 1); $i++)
                            @if ($i == $reports->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $reports->appends(request()->query())->url($i) }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endfor

                        {{-- Titik-titik setelah --}}
                        @if ($reports->currentPage() < $reports->lastPage() - 1)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif

                        {{-- Tombol selanjutnya --}}
                        @if ($reports->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $reports->appends(request()->query())->nextPageUrl() }}">
                                    &#x203A;
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&#x203A;</span></li>
                        @endif

                        {{-- Tombol ke halaman terakhir --}}
                        @if ($reports->currentPage() < $reports->lastPage())
                            <li class="page-item">
                                <a class="page-link" href="{{ $reports->appends(request()->query())->url($reports->lastPage()) }}">
                                    &#x00BB;
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif
    </div>
</div>

<style>
    body.modal-open {
        padding-right: 0 !important;
    }

    .custom-header {
        background-color: #ec1c24 !important;
        color: white !important;
        font-weight: bold;
    }

    .badge {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
    }

    .pagination .page-item .page-link {
        color: #ec1c24;
        border: 1px solid #ddd;
        margin: 0 2px;
    }

    .pagination .page-item.active .page-link {
        background-color: #ec1c24;
        color: white;
        border-color: #ec1c24;
    }

    .pagination .page-item.disabled .page-link {
        color: #aaa;
    }

    .btn-custom-red {
        background-color: #ec1c24;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 8px 15px;
        font-size: 14px;
        cursor: pointer;
    }

    .btn-custom-red:hover {
        background-color: #b3161c;
        color: white !important;
    }

    .form-check-input {
        border: 1px solid;
        background-color: #fff;
    }

    .form-check-input:checked {
        background-color: #ec1c24;
        border-color: #ec1c24;
    }

    .form-check-input:focus {
        box-shadow: none;
    }
</style>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const openModalBtn = document.getElementById("openStatusModalBtn");
    const statusModal = new bootstrap.Modal(document.getElementById("statusSelectionModal"));
    const selectAllCheckbox = document.getElementById("selectAllStatus");
    const statusCheckboxes = document.querySelectorAll(".status-checkbox:not(#selectAllStatus)");
    const applyBtn = document.getElementById("applyStatusFilterBtn");
    const toastAlert = new bootstrap.Toast(document.getElementById("statusToast"));

    openModalBtn.addEventListener("click", () => {
        statusModal.show();
        const navbarCollapse = document.querySelector(".navbar-collapse.show");
        if (navbarCollapse) {
            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
            if (bsCollapse) bsCollapse.hide();
        }
    });

    const urlParams = new URLSearchParams(window.location.search);
    const selected = [];

    for (const [key, value] of urlParams.entries()) {
        if (key.startsWith("status")) {
            selected.push(value);
        }
    }

    if (selected.length === 0) {
        selectAllCheckbox.checked = true;
        statusCheckboxes.forEach(cb => {
            cb.checked = true;
            cb.disabled = true;
        });
    } else {
        selectAllCheckbox.checked = false;
        statusCheckboxes.forEach(cb => {
            cb.checked = selected.includes(cb.value);
            cb.disabled = false;
        });
    }

    selectAllCheckbox.addEventListener("change", function () {
        if (this.checked) {
            statusCheckboxes.forEach(cb => {
                cb.checked = true;
                cb.disabled = true;
            });
        } else {
            statusCheckboxes.forEach(cb => (cb.disabled = false));
        }
    });

    applyBtn.addEventListener("click", function () {
        const checked = Array.from(statusCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        if (selectAllCheckbox.checked) {
            window.location.href = window.location.pathname;
            return;
        }

        if (checked.length === 0) {
            document.getElementById("statusToast").style.display = "block";
            toastAlert.show();
            return;
        }

        document.getElementById("statusFilterForm").submit();
    });
});
</script>
@endsection