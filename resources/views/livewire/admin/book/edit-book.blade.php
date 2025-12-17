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

        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
        }

        .search-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1000;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            max-height: 200px;
            overflow-y: auto;
            margin-top: 5px;
        }

        .search-item {
            padding: 0.75rem 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .search-item:hover {
            background-color: #eef2ff;
            color: #4f46e5;
        }
    </style>

    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 fw-bold text-slate-800">Edit Buku</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0 small">
                            <li class="breadcrumb-item"><a href="{{ route('admin.books') }}" class="text-decoration-none text-indigo-600">Buku</a></li>
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
                <div class="col-12 col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white py-3 border-bottom-0">
                            <div class="d-flex align-items-center gap-2 text-warning">
                                <i class="bi bi-pencil-square fs-5"></i>
                                <h5 class="mb-0 fw-bold text-dark">Form Edit Buku</h5>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <form wire:submit.prevent="save">
                                <div class="mb-4">
                                    <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-type-h1"></i></span>
                                        <input type="text" class="form-control border-start-0 ps-0 @error('title') is-invalid @enderror"
                                            wire:model.blur="title" placeholder="Masukkan judul buku">
                                    </div>
                                    @error('title') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4" x-data="{ open: false }" @click.outside="open = false">
                                        <label class="form-label">Penulis <span class="text-danger">*</span></label>
                                        <div class="input-group relative">
                                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-person"></i></span>
                                            <input type="text"
                                                class="form-control border-start-0 ps-0 @error('author_id') is-invalid @enderror"
                                                placeholder="Ketik nama penulis..."
                                                wire:model.live="searchAuthor"
                                                @focus="open = true"
                                                @input="open = true">

                                            <div x-show="open && $wire.searchAuthor.length > 0" class="search-dropdown" style="display: none;">
                                                @forelse($authors as $author)
                                                <div class="search-item" wire:click="selectAuthor({{ $author->id }}, '{{ $author->author }}')" @click="open = false">
                                                    {{ $author->author }}
                                                </div>
                                                @empty
                                                <div class="p-3 text-muted text-center small">Penulis tidak ditemukan.</div>
                                                @endforelse
                                            </div>
                                        </div>
                                        @error('author_id') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6 mb-4" x-data="{ open: false }" @click.outside="open = false">
                                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                        <div class="input-group relative">
                                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-tags"></i></span>
                                            <input type="text"
                                                class="form-control border-start-0 ps-0 @error('category_id') is-invalid @enderror"
                                                placeholder="Ketik nama kategori..."
                                                wire:model.live="searchCategory"
                                                @focus="open = true"
                                                @input="open = true">

                                            <div x-show="open && $wire.searchCategory.length > 0" class="search-dropdown" style="display: none;">
                                                @forelse($categories as $category)
                                                <div class="search-item" wire:click="selectCategory({{ $category->id }}, '{{ $category->category }}')" @click="open = false">
                                                    {{ $category->category }}
                                                </div>
                                                @empty
                                                <div class="p-3 text-muted text-center small">Kategori tidak ditemukan.</div>
                                                @endforelse
                                            </div>
                                        </div>
                                        @error('category_id') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">ISBN <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-upc-scan"></i></span>
                                            <input type="text" class="form-control border-start-0 ps-0 @error('isbn') is-invalid @enderror"
                                                wire:model.blur="isbn"
                                                oninput="this.value = this.value.replace(/[^0-9-]/g, '')"
                                                placeholder="Contoh: 978-3-16-148410-0">
                                        </div>
                                        @error('isbn') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Penerbit <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-building"></i></span>
                                            <input type="text" class="form-control border-start-0 ps-0 @error('publisher') is-invalid @enderror"
                                                wire:model.blur="publisher" placeholder="Nama Penerbit">
                                        </div>
                                        @error('publisher') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-calendar3"></i></span>
                                            <input type="number" class="form-control border-start-0 ps-0 @error('publication_year') is-invalid @enderror"
                                                wire:model.blur="publication_year" placeholder="YYYY">
                                        </div>
                                        @error('publication_year') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Stok <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-boxes"></i></span>
                                            <input type="number" class="form-control border-start-0 ps-0 @error('stock') is-invalid @enderror"
                                                wire:model.blur="stock" placeholder="0">
                                        </div>
                                        @error('stock') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Sinopsis</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-file-text"></i></span>
                                        <textarea class="form-control border-start-0 ps-0 @error('sinopsis') is-invalid @enderror"
                                            wire:model.blur="sinopsis" rows="4" placeholder="Masukkan sinopsis buku..."></textarea>
                                    </div>
                                    @error('sinopsis') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Gambar Cover (Upload Baru)</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" wire:model="image">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-image"></i></span>
                                    </div>
                                    <div wire:loading wire:target="image" class="text-sm text-indigo-600 mt-1">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading...
                                    </div>
                                    @error('image') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror

                                    @if ($existingImage)
                                    <div class="mt-2">
                                        <small class="text-muted d-block mb-1">Cover Saat Ini:</small>
                                        <img src="{{ asset('storage/' . $existingImage) }}" alt="Cover Buku" class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                    @endif
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                                    <a wire:navigate href="{{ route('admin.books') }}" class="btn btn-light text-secondary border px-4 rounded-pill">
                                        Batal
                                    </a>
                                    <button type="submit" class="btn btn-indigo px-4 rounded-pill shadow-sm d-flex align-items-center gap-2">
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