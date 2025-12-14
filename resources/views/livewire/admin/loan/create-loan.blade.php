<div>
    <style>
        /* CSS Tambahan untuk Search Dropdown (Sama seperti CreateBook) */
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

        /* Style Button & Form original */
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

        .relative {
            position: relative;
        }
    </style>

    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 fw-bold text-slate-800">Buat Transaksi Baru</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0 small">
                            <li class="breadcrumb-item"><a wire:navigate href="{{ route('admin.loans') }}" class="text-decoration-none text-indigo-600">Peminjaman</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Transaksi Baru</li>
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
                                <i class="bi bi-arrow-right-circle-fill fs-5"></i>
                                <h5 class="mb-0 fw-bold text-dark">Form Transaksi Peminjaman</h5>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <form wire:submit.prevmanaent="save">
                                @if (session()->has('message'))
                                <div class="alert alert-success rounded-3 mb-4">{{ session('message') }}</div>
                                @endif
                                @if (session()->has('error'))
                                <div class="alert alert-danger rounded-3 mb-4">{{ session('error') }}</div>
                                @endif

                                <div class="mb-4" x-data="{ open: false }" @click.outside="open = false">
                                    <label class="form-label">Peminjam <span class="text-danger">*</span></label>
                                    <div class="input-group relative">
                                        <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-person"></i></span>
                                        <input type="text"
                                            class="form-control border-start-0 ps-0 @error('userId') is-invalid @enderror"
                                            placeholder="Ketik nama anggota..."
                                            wire:model.live="searchUser"
                                            @focus="open = true"
                                            @input="open = true">

                                        <div x-show="open && $wire.searchUser.length > 0"
                                            class="search-dropdown"
                                            style="display: none;">
                                            @forelse($users as $user)
                                            <div class="search-item"
                                                wire:click="selectUser({{ $user->id }}, '{{ $user->name }}')"
                                                @click="open = false">
                                                {{ $user->name }} <span class="text-muted small">({{ $user->email }})</span>
                                            </div>
                                            @empty
                                            <div class="p-3 text-muted text-center small">
                                                Anggota tidak ditemukan.
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                    @error('userId') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-4" x-data="{ open: false }" @click.outside="open = false">
                                    <label class="form-label">Buku <span class="text-danger">*</span></label>
                                    <div class="input-group relative">
                                        <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-book"></i></span>
                                        <input type="text"
                                            class="form-control border-start-0 ps-0 @error('bookId') is-invalid @enderror"
                                            placeholder="Ketik judul buku..."
                                            wire:model.live="searchBook"
                                            @focus="open = true"
                                            @input="open = true">

                                        <div x-show="open && $wire.searchBook.length > 0"
                                            class="search-dropdown"
                                            style="display: none;">
                                            @forelse($books as $book)
                                            <div class="search-item"
                                                wire:click="selectBook({{ $book->id }}, '{{ $book->title }}')"
                                                @click="open = false">
                                                <div class="d-flex justify-content-between">
                                                    <span>{{ $book->title }}</span>
                                                    <span class="badge bg-light text-dark border">Stok: {{ $book->stock }}</span>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="p-3 text-muted text-center small">
                                                Buku tidak ditemukan / Stok Habis.
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                    @error('bookId') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="loanDays" class="form-label">Durasi Peminjaman (Hari) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-calendar-date"></i></span>
                                        <input type="number" wire:model="loanDays" id="loanDays" class="form-control border-start-0 ps-0 @error('loanDays') is-invalid @enderror" placeholder="Contoh: 7 hari" min="1">
                                    </div>
                                    @error('loanDays') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                                    <a wire:navigate href="{{ route('admin.loans') }}" class="btn btn-light text-secondary border px-4 rounded-pill">
                                        Batal
                                    </a>
                                    <button type="submit" class="btn btn-indigo px-4 rounded-pill shadow-sm d-flex align-items-center gap-2">
                                        <i class="bi bi-save"></i> Simpan Transaksi
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