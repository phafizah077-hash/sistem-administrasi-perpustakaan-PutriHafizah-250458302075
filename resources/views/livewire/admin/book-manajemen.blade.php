<div>
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
                    <div class="card mb-4">
                        <div class="card-header">

                            <div class="card-body">
                                @if (session()->has('message'))
                                <div class="alert alert-success">{{ session('message') }}</div>
                                @endif
                                <table class="table table-bordered">

                                    <a wire:navigate href="{{ route('admin.books.create') }}" class="btn btn-primary mb-4">
                                        Add New Book
                                    </a>
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>Kategori</th>
                                            <th>ISBN</th>
                                            <th>Penerbit</th>
                                            <th>Tahun Terbit</th>
                                            <th>Gambar</th>
                                            <th>Stok</th>
                                            <th style="width: 150px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($books as $book)
                                        <tr class="align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->author->author ?? 'N/A' }}</td>
                                            <td>{{ $book->category->category ?? 'N/A' }}</td>
                                            <td>{{ $book->isbn}}</td>
                                            <td>{{ $book->publisher}}</td>
                                            <td>{{ $book->publication_year}}</td>
                                            <td>
                                                @if ($book->image)
                                                <img src="{{ asset('storage/' . $book->image) }}" alt="Gambar Buku" style="width: 100px; height: auto; object-fit: cover;">
                                                @else
                                                <span class="text-muted">Tidak ada gambar</span>
                                                @endif
                                            </td>
                                            <td>{{ $book->stock }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    {{-- TOMBOL VIEW --}}
                                                    {{-- Perhatikan: tombol ini memicu Modal Bootstrap DAN Livewire --}}
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-info"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalDetailBook"
                                                        wire:click="$dispatch('view-book-detail', { bookId: {{ $book->id }} })">
                                                        View
                                                    </button>

                                                    <a wire:navigate href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-warning">
                                                        Edit
                                                    </a>
                                                    <button class="btn btn-sm btn-danger" wire:click="deleteBook({{ $book->id }})" wire:confirm="Are you sure you want to delete this book?">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:admin.book.view-book />
</div>