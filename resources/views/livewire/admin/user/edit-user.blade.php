<div>
    <style>
        .form-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
        }

        .invalid-feedback {
            color: #ef4444;
            font-style: italic;
            font-size: 0.75rem;
        }
    </style>

    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 fw-bold text-slate-800">Edit User</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0 small">
                            <li class="breadcrumb-item"><a wire:navigate href="{{ route('admin.users') }}" class="text-decoration-none text-indigo-600">Users</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 col-xl-6">

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white py-3 border-bottom-0">
                            <div class="d-flex align-items-center gap-2 text-warning">
                                <i class="bi bi-person-fill fs-5"></i>
                                <h5 class="mb-0 fw-bold text-dark">Form Edit User</h5>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <form wire:submit="save">
                                <div class="mb-4">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <i class="bi bi-person-circle"></i>
                                        </span>
                                        <input type="text" id="name" wire:model.blur="name"
                                            class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror"
                                            placeholder="Masukkan nama lengkap user">
                                    </div>
                                    @error('name')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <input type="email" id="email" wire:model.blur="email"
                                            class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                                            placeholder="Masukkan alamat email">
                                    </div>
                                    @error('email')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <i class="bi bi-key"></i>
                                        </span>
                                        <input type="password" id="password" wire:model.blur="password"
                                            class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror"
                                            placeholder="Kosongkan jika tidak ingin diubah">
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <i class="bi bi-shield-lock"></i>
                                        </span>
                                        <input type="password" id="password_confirmation" wire:model.blur="password_confirmation"
                                            class="form-control border-start-0 ps-0"
                                            placeholder="Konfirmasi password baru">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                                    <select id="role" wire:model.live="role"
                                        class="form-select @error('role') is-invalid @enderror">
                                        <option value="Anggota">Anggota</option>
                                        <option value="Pustakawan">Pustakawan</option>
                                    </select>
                                    @error('role')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="phone" class="form-label">Phone</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <i class="bi bi-phone"></i>
                                        </span>
                                        <input type="text" id="phone" wire:model.blur="phone"
                                            class="form-control border-start-0 ps-0 @error('phone') is-invalid @enderror"
                                            placeholder="Nomor telepon aktif">
                                    </div>
                                    @error('phone')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea id="address" wire:model.blur="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        rows="3" placeholder="Alamat lengkap user"></textarea>
                                    @error('address')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                                    <a wire:navigate href="{{ route('admin.users') }}" class="btn btn-light text-secondary border px-4 rounded-pill">
                                        Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm d-flex align-items-center gap-2" style="background-color: #4f46e5; border-color: #4f46e5;">
                                        <i class="bi bi-save"></i> Simpan Perubahan
                                        <div wire:loading wire:target="save" class="spinner-border spinner-border-sm text-white" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>