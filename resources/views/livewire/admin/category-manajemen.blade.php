<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Data Kategori</h3>
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
                                <table class="table table-bordered">
                                    <a wire:navigate href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-4">
                                        Add New Category
                                    </a>
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Kategori</th>
                                            <th>Slug</th>
                                            <th style="width: 150px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr class="align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->category }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    {{-- TOMBOL VIEW --}}
                                                    {{-- Perhatikan: tombol ini memicu Modal Bootstrap DAN Livewire --}}
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-info"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalDetailCategory"
                                                       wire:click="$dispatch('view-category-detail', { categoryId: {{ $category->id }} })">
                                                        View
                                                    </button>

                                                    <a wire:navigate href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                                                        Edit
                                                    </a>
                                                    <button class="btn btn-sm btn-danger" wire:click="deleteCategory({{ $category->id }})" wire:confirm="Are you sure you want to delete this category?">Delete</button>
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
    <livewire:admin.category.view-category />
</div>