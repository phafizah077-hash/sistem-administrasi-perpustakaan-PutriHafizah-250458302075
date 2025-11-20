<div class="modal fade" id="modalDetailCategory" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered"> {{-- Tidak perlu modal-lg, cukup standar biar compact --}}
        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title">
                    <i class="fas fa-layer-group me-2"></i> Detail Kategori
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- BODY --}}
            <div class="modal-body">

                @if ($category)
                {{-- BAGIAN IKON & JUDUL --}}
                <div class="text-center mb-4">
                    <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 80px; height: 80px;">
                        <i class="fas fa-tags fa-3x"></i>
                    </div>
                    <h3 class="fw-bold text-dark">{{ $category->category }}</h3>
                    <span class="badge bg-secondary">ID: {{ $category->id }}</span>
                </div>

                {{-- BAGIAN TABEL DETAIL --}}
                <div class="card bg-light border-0">
                    <div class="card-body">
                        <table class="table table-borderless table-sm mb-0">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-muted">Nama Kategori</th>
                                    <td class="fw-bold text-dark">: {{ $category->category }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Slug (URL)</th>
                                    <td class="font-monospace text-primary">: {{ $category->slug ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Dibuat Pada</th>
                                    <td>: {{ $category->created_at ? $category->created_at->format('d M Y') : '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                {{-- State Loading / Kosong --}}
                <div class="text-center py-4">
                    <div class="spinner-border text-primary mb-2" role="status"></div>
                    <p class="text-muted">Memuat data kategori...</p>
                </div>
                @endif

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>