<div class="modal fade" id="modalDetailBook" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-secondary">
                    <i class="bi bi-book-half text-indigo-500 me-2"></i> Detail Buku
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body pt-2 pb-4 px-4">

                @if ($book)
                <div class="row g-4">
                    <div class="col-md-4 d-flex flex-column align-items-center">
                        <div class="position-relative shadow-sm rounded overflow-hidden border w-100" style="max-width: 250px;">
                            @if ($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}"
                                class="img-fluid w-100"
                                alt="Cover Buku"
                                style="object-fit: cover; aspect-ratio: 2/3;">
                            @else
                            <div class="bg-light d-flex flex-column align-items-center justify-content-center text-muted"
                                style="aspect-ratio: 2/3; width: 100%;">
                                <i class="bi bi-image fs-1 mb-2 opacity-50"></i>
                                <span class="small fw-bold">No Cover</span>
                            </div>
                            @endif
                        </div>
                        <div class="mt-3 w-100 text-center">
                            @if($book->stock > 0)
                            <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-2 rounded-pill w-100">
                                <i class="bi bi-check-circle-fill me-1"></i> Tersedia: {{ $book->stock }}
                            </span>
                            @else
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle px-3 py-2 rounded-pill w-100">
                                <i class="bi bi-x-circle-fill me-1"></i> Stok Habis
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-8">
                        <h3 class="fw-bold text-dark mb-1">{{ $book->title }}</h3>
                        <p class="text-muted mb-3">
                            Oleh <span class="fw-bold text-indigo-600">{{ $book->author->author ?? 'Tidak Diketahui' }}</span>
                        </p>

                        <div class="card bg-light border-0 rounded-3">
                            <div class="card-body p-0">
                                <table class="table table-borderless table-sm mb-0">
                                    <tbody>
                                        <tr class="border-bottom border-light">
                                            <td class="text-muted small text-uppercase fw-bold ps-3 py-2" width="30%">ISBN</td>
                                            <td class="fw-bold text-dark py-2 font-monospace">{{ $book->isbn ?? '-' }}</td>
                                        </tr>
                                        <tr class="border-bottom border-light">
                                            <td class="text-muted small text-uppercase fw-bold ps-3 py-2">Kategori</td>
                                            <td class="py-2">
                                                <span class="badge bg-white text-secondary border border-secondary-subtle px-2 py-1 rounded">
                                                    {{ $book->category->category ?? 'Umum' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="border-bottom border-light">
                                            <td class="text-muted small text-uppercase fw-bold ps-3 py-2">Penerbit</td>
                                            <td class="fw-semibold text-dark py-2">{{ $book->publisher ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted small text-uppercase fw-bold ps-3 py-2">Tahun Terbit</td>
                                            <td class="fw-semibold text-dark py-2">{{ $book->publication_year ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-3 text-end">
                            <small class="text-muted fst-italic" style="font-size: 0.75rem;">
                                Ditambahkan pada: {{ $book->created_at ? $book->created_at->format('d M Y, H:i') : '-' }}
                            </small>
                        </div>
                    </div>
                </div>

                @else
                <div class="text-center py-5">
                    <div class="spinner-border text-indigo-500 mb-3" role="status" style="width: 3rem; height: 3rem;"></div>
                    <p class="text-muted mb-0">Sedang memuat data buku...</p>
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