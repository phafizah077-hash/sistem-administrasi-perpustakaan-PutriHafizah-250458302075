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
    </style>

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Data Penulis</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                            <h3 class="card-title fw-bold text-secondary">List Penulis</h3>
                            <a wire:navigate href="{{ route('admin.authors.create') }}" class="btn btn-indigo rounded-pill px-4">
                                <i class="bi bi-plus-lg me-1"></i> Add New Author
                            </a>
                        </div>

                        <div class="card-body">
                            {{-- Notifikasi Otomatis Hilang (Alpine.js) --}}
                            @if (session()->has('message'))
                            <div x-data="{ show: true }"
                                x-init="setTimeout(() => show = false, 3000)"
                                x-show="show"
                                x-transition.duration.500ms
                                class="alert alert-success rounded-3 mb-4" role="alert">
                                {{ session('message') }}
                            </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" style="width: 50px">No</th>
                                            <th>Nama Penulis</th>
                                            <th class="text-center" style="width: 200px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($authors as $author)
                                        {{-- PENTING: wire:key agar Livewire tidak bingung saat hapus data --}}
                                        <tr wire:key="{{ $author->id }}">
                                            <td class="text-center">{{ $authors->firstItem() + $loop->index }}</td>

                                            <td class="fw-semibold text-dark">{{ $author->author }}</td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-info rounded-pill px-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#viewAuthorModal"
                                                        wire:click="$dispatch('view-author-detail', { authorId: {{ $author->id }} })">
                                                        <i class="bi bi-eye"></i>
                                                    </button>

                                                    <a wire:navigate href="{{ route('admin.authors.edit', $author->id) }}"
                                                        class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                        wire:click="deleteAuthor({{ $author->id }})"
                                                        wire:confirm="Apakah Anda yakin ingin menghapus penulis ini?">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer bg-white d-flex justify-content-end py-3">
                            {{ $authors->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:admin.author.view-author />
</div>