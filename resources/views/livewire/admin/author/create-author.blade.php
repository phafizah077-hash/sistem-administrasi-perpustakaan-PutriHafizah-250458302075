<div>
    <style>
        .form-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
        }

        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
        }
    </style>

    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 fw-bold text-slate-800">Tambah Penulis Baru</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0 small">
                            <li class="breadcrumb-item"><a href="{{ route('admin.authors') }}" class="text-decoration-none text-indigo-600">Penulis</a></li>
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
                <div class="col-12 col-lg-8 col-xl-6">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white py-3 border-bottom-0">
                            <div class="d-flex align-items-center gap-2 text-indigo-600">
                                <i class="bi bi-person-plus-fill fs-5"></i>
                                <h5 class="mb-0 fw-bold text-dark">Form Penulis</h5>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <form wire:submit.prevent="save">
                                <div class="mb-4">
                                    <label for="author" class="form-label">Nama Penulis <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <i class="bi bi-person"></i>
                                        </span>
                                        <input type="text"
                                            id="author"
                                            wire:model.live="author"
                                            class="form-control border-start-0 ps-0 @error('author') is-invalid @enderror"
                                            placeholder="Masukkan nama lengkap penulis">
                                    </div>
                                    @error('author')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted small mt-1">
                                        Pastikan ejaan nama sudah benar untuk memudahkan pencarian.
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                                    <a wire:navigate href="{{ route('admin.authors') }}" class="btn btn-light text-secondary border px-4 rounded-pill">
                                        Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm d-flex align-items-center gap-2" style="background-color: #4f46e5; border-color: #4f46e5;">
                                        <i class="bi bi-save"></i> Simpan Data
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