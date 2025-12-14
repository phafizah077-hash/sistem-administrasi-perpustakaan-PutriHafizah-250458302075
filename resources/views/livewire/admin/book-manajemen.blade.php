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
                    <h3 class="mb-0">Data Buku</h3>
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
                            <h3 class="card-title fw-bold text-secondary">List Buku</h3>

                            <a wire:navigate href="{{ route('admin.books.create') }}" class="btn btn-indigo rounded-pill px-4">
                                <i class="bi bi-plus-lg me-1"></i> Add New Book
                            </a>
                        </div>

                        <div class="card-body">
                            @if (session()->has('message'))
                            <div x-data="{ show: true }"
                                x-init="setTimeout(() => show = false, 3000)"
                                x-show="show"
                                x-transition.duration.500ms
                                class="alert alert-success rounded-3 mb-4">
                                {{ session('message') }}
                            </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" style="width: 50px">No</th>
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>Kategori</th>
                                            <th>ISBN</th>
                                            <th>Penerbit</th>
                                            <th class="text-center">Tahun</th>
                                            <th class="text-center">Stok</th>
                                            <th class="text-center" style="width: 150px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($books as $book)
                                        <tr>
                                            <td class="text-center">{{ $books->firstItem() + $loop->index }}</td>

                                            <td class="fw-semibold text-dark">{{ Str::limit($book->title, 30) }}</td>
                                            <td class="text-muted">{{ $book->author->author ?? '-' }}</td>
                                            <td>
                                                <span class="badge bg-light text-secondary border border-secondary-subtle px-2 py-1 rounded-pill">
                                                    {{ $book->category->category ?? '-' }}
                                                </span>
                                            </td>
                                            <td class="font-monospace small">{{ $book->isbn }}</td>
                                            <td>{{ $book->publisher }}</td>
                                            <td class="text-center">{{ $book->publication_year }}</td>

                                            <td class="text-center">
                                                <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 {{ $book->stock > 0 ? 'text-success' : 'text-danger' }} border {{ $book->stock > 0 ? 'border-success-subtle' : 'border-danger-subtle' }} px-2 py-1 rounded-pill">
                                                    {{ $book->stock }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-info rounded-pill px-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalDetailBook"
                                                        wire:click="$dispatch('view-book-detail', { bookId: {{ $book->id }} })"
                                                        title="View Details">
                                                        <i class="bi bi-eye"></i>
                                                    </button>

                                                    <a wire:navigate href="{{ route('admin.books.edit', $book->id) }}"
                                                        class="btn btn-sm btn-outline-warning rounded-pill px-2"
                                                        title="Edit Book">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    <button class="btn btn-sm btn-outline-danger rounded-pill px-2"
                                                        wire:click="deleteBook({{ $book->id }})"
                                                        wire:confirm="Are you sure you want to delete this book?"
                                                        title="Delete Book">
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
                            {{ $books->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:admin.book.view-book />
</div>