<div>
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
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="card-body">
                                @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                                @endif

                                <a wire:navigate href="{{ route('admin.authors.create') }}" class="btn btn-primary mb-4">
                                    Add New Author
                                </a>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Nama Penulis</th>
                                            <th style="width: 150px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($authors as $author)
                                        <tr class="align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $author->author }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    {{-- TOMBOL VIEW --}}
                                                    {{-- Perhatikan: tombol ini memicu Modal Bootstrap DAN Livewire --}}
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-info"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#viewAuthorModal"
                                                        wire:click="$dispatch('view-author-detail', { authorId: {{ $author->id }} })">
                                                        View
                                                    </button>

                                                    <a wire:navigate href="{{ route('admin.authors.edit', $author->id) }}" class="btn btn-sm btn-warning">
                                                        Edit
                                                    </a>

                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="deleteAuthor({{ $author->id }})"
                                                        wire:confirm="Are you sure you want to delete this author?">
                                                        Delete
                                                    </button>
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

    {{-- INI KUNCINYA: --}}
    {{-- Kita panggil komponen modal di sini. JANGAN taruh HTML <div modal> di file ini --}}
    <livewire:admin.author.view-author />
</div>