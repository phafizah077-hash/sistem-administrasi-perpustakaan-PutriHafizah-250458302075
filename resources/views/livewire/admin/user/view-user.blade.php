<div class="modal fade" id="modalDetailUser" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title">
                    <i class="fas fa-user-circle me-2"></i> Detail Pengguna
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- BODY --}}
            <div class="modal-body">

                @if ($user)
                {{-- BAGIAN PROFIL (AVATAR & NAMA) --}}
                <div class="text-center mb-4">
                    {{-- Avatar Placeholder (Bulat) --}}
                    <div class="bg-info-subtle text-info rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm"
                        style="width: 90px; height: 90px;">
                        <i class="fas fa-user fa-3x"></i>
                    </div>

                    {{-- Nama User --}}
                    <h4 class="fw-bold text-dark mb-1">{{ $user->name }}</h4>

                    {{-- Email (Kecil di bawah nama) --}}
                    <p class="text-muted mb-2">{{ $user->email }}</p>

                    {{-- Role Badge --}}
                    @if($user->role == 'admin')
                    <span class="badge bg-primary rounded-pill px-3">Admin</span>
                    @else
                    <span class="badge bg-secondary rounded-pill px-3">User</span>
                    @endif
                </div>

                {{-- BAGIAN DETAIL INFO --}}
                <div class="card bg-light border-0">
                    <div class="card-body">
                        <table class="table table-borderless table-sm mb-0">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-muted"><i class="fas fa-id-card me-2"></i>User ID</th>
                                    <td class="fw-bold">: {{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted"><i class="fas fa-envelope me-2"></i>Email</th>
                                    <td>: {{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted"><i class="fas fa-user-tag me-2"></i>Role</th>
                                    <td class="text-uppercase">: {{ $user->role }}</td>
                                </tr>
                                {{-- Opsional: Tanggal Bergabung (Jika ada di database) --}}
                                <tr>
                                    <th class="text-muted"><i class="fas fa-calendar-alt me-2"></i>Bergabung</th>
                                    <td>: {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                {{-- State Loading --}}
                <div class="text-center py-4">
                    <div class="spinner-border text-info mb-2" role="status"></div>
                    <p class="text-muted">Memuat data user...</p>
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