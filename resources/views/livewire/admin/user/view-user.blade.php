<div class="modal fade" id="modalDetailUser" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-secondary">
                    <i class="bi bi-person-circle text-primary-500 me-2"></i> Detail Pengguna
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body pt-2 pb-4 px-4">
                @if ($user)
                <div class="text-center mt-3 mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow-sm"
                        style="width: 90px; height: 90px; background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%); border: 4px solid #fff;">
                        <i class="fas fa-user text-primary-600" style="font-size: 2.5rem;"></i>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">{{ $user->name }}</h3>
                    <p class="text-muted mb-2">{{ $user->email }}</p>

                    @if($user->role == 'Pustakawan')
                    <span class="badge bg-primary text-white rounded-pill px-3 py-2 fw-semibold">Pustakawan</span>
                    @else
                    <span class="badge bg-secondary text-white rounded-pill px-3 py-2 fw-semibold">Anggota</span>
                    @endif
                </div>

                <div class="card bg-light border-0 rounded-3">
                    <div class="card-body p-3">
                        {{-- Bagian No Telp --}}
                        <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
                            <span class="text-muted small text-uppercase fw-bold"><i class="fas fa-envelope me-2"></i>No Telp</span>
                            {{-- PERBAIKAN: Gunakan ternary operator ?: --}}
                            <span class="text-dark fw-semibold">
                                {{ $user->phone ?: '-' }}
                            </span>
                        </div>

                        {{-- Bagian Alamat --}}
                        <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
                            <span class="text-muted small text-uppercase fw-bold"><i class="fas fa-user-tag me-2"></i>Alamat</span>
                            {{-- PERBAIKAN: Gunakan ternary operator ?: --}}
                            <span class="text-dark fw-semibold text-uppercase">
                                {{ $user->address ?: '-' }}
                            </span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small text-uppercase fw-bold"><i class="fas fa-calendar-alt me-2"></i>Bergabung</span>
                            <span class="text-dark fw-semibold">
                                {{ $user->created_at ? $user->created_at->format('d F Y') : '-' }}
                            </span>
                        </div>
                    </div>
                </div>

                @else
                <div class="text-center py-5">
                    <div class="spinner-border text-primary-500 mb-3" role="status" style="width: 3rem; height: 3rem;"></div>
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
        .text-primary-500 {
            color: #2196f3 !important;
        }

        .text-primary-600 {
            color: #1e88e5 !important;
        }
    </style>
</div>