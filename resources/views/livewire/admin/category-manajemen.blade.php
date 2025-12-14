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
                    <h3 class="mb-0">Data Kategori</h3>
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
                            <h3 class="card-title fw-bold text-secondary">List Kategori</h3>
                            <a wire:navigate href="{{ route('admin.categories.create') }}" class="btn btn-indigo rounded-pill px-4">
                                <i class="bi bi-plus-lg me-1"></i> Add New Category
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
                            @if (session()->has('error'))
                            <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" style="width: 50px">No</th>
                                            <th>Kategori</th>
                                            <th>Slug</th>
                                            <th class="text-center" style="width: 200px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                            <td class="text-center">{{ $categories->firstItem() + $loop->index }}</td>

                                            <td class="fw-semibold text-dark">{{ $category->category }}</td>
                                            <td>
                                                <span class="badge bg-light text-secondary border border-secondary-subtle px-3 py-2 rounded-pill font-monospace">
                                                    {{ $category->slug }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-info rounded-pill px-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalDetailCategory"
                                                        wire:click="$dispatch('view-category-detail', { categoryId: {{ $category->id }} })">
                                                        <i class="bi bi-eye"></i>
                                                    </button>

                                                    <a wire:navigate href="{{ route('admin.categories.edit', $category->id) }}"
                                                        class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                        wire:click="deleteCategory({{ $category->id }})"
                                                        wire:confirm="Apakah Anda yakin ingin menghapus kategori ini?">
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
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:admin.category.view-category />
</div>