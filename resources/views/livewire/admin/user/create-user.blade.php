<div>
    <style>
        .btn-indigo {
            background-color: #4f46e5 !important;
            border-color: #4f46e5 !important;
            color: white !important;
            box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);
            transition: all 0.3s ease;
        }

        .btn-indigo:hover {
            background-color: #4338ca !important;
            border-color: #4338ca !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.3);
        }

        .form-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
        }
    </style>

    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 fw-bold text-slate-800">Tambah User Baru</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0 small">
                            <li class="breadcrumb-item"><a href="{{ route('admin.users') }}" class="text-decoration-none text-indigo-600">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white py-3 border-bottom-0">
                            <div class="d-flex align-items-center gap-2 text-indigo-600">
                                <i class="bi bi-person-plus-fill fs-5"></i>
                                <h5 class="mb-0 fw-bold text-dark">Form Data User</h5>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <form wire:submit.prevent="save">
                                <div class="mb-4">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror"
                                            wire:model.blur="name" placeholder="Masukkan nama lengkap">
                                    </div>
                                    @error('name') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Alamat Email <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-envelope"></i></span>
                                            <input type="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                                                wire:model.blur="email" placeholder="contoh@email.com">
                                        </div>
                                        @error('email') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Peran (Role) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-person-badge"></i></span>
                                            <select wire:model.live="role" class="form-select border-start-0 ps-0 @error('role') is-invalid @enderror">
                                                <option value="">-- Pilih Role --</option>
                                                <option value="Pustakawan">Pustakawan</option>
                                                <option value="Anggota">Anggota</option>
                                            </select>
                                        </div>
                                        @error('role') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-lock"></i></span>
                                            <input type="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror"
                                                wire:model.blur="password" placeholder="********">
                                        </div>
                                        @error('password') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-lock-fill"></i></span>
                                            <input type="password" class="form-control border-start-0 ps-0"
                                                wire:model.blur="password_confirmation" placeholder="Ulangi password">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Nomor HP</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-telephone"></i></span>
                                        <input type="text" class="form-control border-start-0 ps-0 @error('phone') is-invalid @enderror"
                                            wire:model.blur="phone" placeholder="Contoh: 08123456789">
                                    </div>
                                    @error('phone') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-geo-alt"></i></span>
                                        <textarea class="form-control border-start-0 ps-0 @error('address') is-invalid @enderror"
                                            wire:model.blur="address" rows="3" placeholder="Masukkan alamat lengkap..."></textarea>
                                    </div>
                                    @error('address') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                                    <a href="{{ route('admin.users') }}" class="btn btn-light text-secondary border px-4 rounded-pill">
                                        Batal
                                    </a>
                                    <button type="submit" class="btn btn-indigo px-4 rounded-pill shadow-sm d-flex align-items-center gap-2">
                                        <i class="bi bi-save"></i> Simpan User
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