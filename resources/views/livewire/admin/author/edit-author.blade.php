<div>
    <style>
        .form-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control:focus {
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
                    <h3 class="mb-0 fw-bold text-slate-800">Edit Penulis</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0 small">
                            <li class="breadcrumb-item"><a wire:navigate href="{{ route('admin.authors') }}" class="text-decoration-none text-indigo-600">Penulis</a></li>
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
                                <i class="bi bi-pencil-square fs-5"></i>
                                <h5 class="mb-0 fw-bold text-dark">Form Edit Penulis</h5>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <form wire:submit.prevent="save">
                                <div class="mb-4">
                                    <label for="author" class="form-label">Nama Penulis <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary">
                                            <i class="bi bi-person-badge"></i>
                                        </span>

                                        {{-- PERBAIKAN DI SINI: --}}
                                        {{-- 1. Ubah @error('author') jadi @error('authorName') di dalam class --}}
                                        <input type="text"
                                            id="author"
                                            wire:model.live="authorName"
                                            class="form-control border-start-0 ps-0 @error('authorName') is-invalid @enderror"
                                            placeholder="Masukkan nama penulis">
                                    </div>

                                    {{-- PERBAIKAN DI SINI: --}}
                                    {{-- 2. Ubah @error('author') jadi @error('authorName') untuk pesan errornya --}}
                                    @error('authorName')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                                    <a wire:navigate href="{{ route('admin.authors') }}" class="btn btn-light text-secondary border px-4 rounded-pill">
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