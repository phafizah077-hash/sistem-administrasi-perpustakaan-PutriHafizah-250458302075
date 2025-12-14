<div class="modal fade" id="viewAuthorModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-secondary">
                    <i class="bi bi-person-lines-fill text-indigo-500 me-2"></i> Detail Penulis
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body pt-2 pb-4 px-4">
                @if ($author)
                <div class="text-center mt-3 mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow-sm"
                        style="width: 90px; height: 90px; background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%); border: 4px solid #fff;">
                        <i class="bi bi-pen-fill text-indigo-600" style="font-size: 2.5rem;"></i>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">{{ $author->author }}</h3>
                </div>

                <div class="card bg-light border-0 rounded-3">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
                            <span class="text-muted small text-uppercase fw-bold">Nama Lengkap</span>
                            <span class="fw-bold text-indigo-600">{{ $author->author ?? '-' }}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small text-uppercase fw-bold">Tanggal Dibuat</span>
                            <span class="text-dark fw-semibold">
                                {{ $author->created_at ? $author->created_at->format('d F Y') : '-' }}
                            </span>
                        </div>
                    </div>
                </div>

                @else
                <div class="text-center py-5">
                    <div class="spinner-border text-indigo-500 mb-3" role="status" style="width: 3rem; height: 3rem;"></div>
                    <p class="text-muted mb-0">Sedang memuat data...</p>
                </div>
                @endif

            </div>

            <div class="modal-footer border-top-0 pt-0 px-4 pb-4">
                <button type="button" class="btn btn-light text-secondary fw-bold w-100 py-2 rounded-pill border" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>

    <style>
        .text-indigo-500 {
            color: #6366f1 !important;
        }

        .text-indigo-600 {
            color: #4f46e5 !important;
        }

        .bg-indigo-50 {
            background-color: #eef2ff !important;
        }
    </style>
</div>