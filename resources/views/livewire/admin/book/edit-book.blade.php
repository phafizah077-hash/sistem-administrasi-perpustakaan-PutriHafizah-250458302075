<div>
    <!-- Page header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Book</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">

                            <div class="card-body">
                                <form wire:submit="save">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Judul</label>
                                            <input type="text" class="form-control @error('form.title') is-invalid @enderror" id="title" wire:model.lazy="form.title">
                                            @error('form.title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="author_id" class="form-label">Penulis</label>
                                            <select class="form-select @error('form.author_id') is-invalid @enderror" id="author_id" wire:model="form.author_id">
                                                <option value="">Pilih Penulis</option>
                                                @foreach($allAuthors as $author)
                                                <option value="{{ $author->id }}">{{ $author->author }}</option>
                                                @endforeach
                                            </select>
                                            @error('form.author_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Kategori</label>
                                            <select class="form-select @error('form.category_id') is-invalid @enderror" id="category_id" wire:model="form.category_id">
                                                <option value="">Pilih Kategori</option>
                                                @foreach($allCategories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                                                @endforeach
                                            </select>
                                            @error('form.category_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="isbn" class="form-label">ISBN</label>
                                            <input type="text" class="form-control @error('form.isbn') is-invalid @enderror" id="isbn" wire:model.lazy="form.isbn">
                                            @error('form.isbn') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="publisher" class="form-label">Penerbit</label>
                                            <input type="text" class="form-control @error('form.publisher') is-invalid @enderror" id="publisher" wire:model.lazy="form.publisher">
                                            @error('form.publisher') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="publication_year" class="form-label">Tahun Terbit</label>
                                            <input type="number" class="form-control @error('form.publication_year') is-invalid @enderror" id="publication_year" wire:model.lazy="form.publication_year">
                                            @error('form.publication_year') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="stock" class="form-label">Stok</label>
                                            <input type="number" class="form-control @error('form.stock') is-invalid @enderror" id="stock" wire:model.lazy="form.stock">
                                            @error('form.stock') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="image" class="form-label">Gambar</label>

                                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" wire:model="image">

                                            @error('image') <span class="invalid-feedback">{{ $message }}</span> @enderror

                                            <div wire:loading wire:target="image" class="mt-2">Uploading...</div>

                                            @if ($image)
                                            <img src="{{ $image->temporaryUrl() }}" class="mt-3" style="max-width: 150px;">
                                            @elseif ($existingImage)
                                            <img src="{{ asset('storage/' . $existingImage) }}" class="mt-3" style="max-width: 150px;">
                                            @endif
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            Save
                                        </button>
                                        <a wire:navigate href="{{ route('admin.books') }}" type="button" class="btn btn-secondary">
                                            Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>