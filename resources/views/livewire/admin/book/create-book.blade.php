<div>
    <!-- Page header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add New Book</h3>
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
                                <form wire:submit.prevent="save">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Judul</label>
                                        <input type="text" class="form-control" id="title" wire:model="title">
                                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="author_id" class="form-label">Penulis</label>
                                        <select class="form-select" id="author_id" wire:model="author_id">
                                            <option value="">Pilih Penulis</option>
                                            @foreach($authors as $author)
                                            <option value="{{ $author->id }}">{{ $author->author }}</option>
                                            @endforeach
                                        </select>
                                        @error('author_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Kategori</label>
                                        <select class="form-select" id="category_id" wire:model="category_id">
                                            <option value="">Pilih Kategori</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="isbn" class="form-label">ISBN</label>
                                        <input type="text" class="form-control" id="isbn" wire:model="isbn">
                                        @error('isbn') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="publisher" class="form-label">Penerbit</label>
                                        <input type="text" class="form-control" id="publisher" wire:model="publisher">
                                        @error('publisher') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="publication_year" class="form-label">Tahun Terbit</label>
                                        <input type="number" class="form-control" id="publication_year" wire:model="publication_year">
                                        @error('publication_year') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="stock" class="form-label">Stok</label>
                                        <input type="number" class="form-control" id="stock" wire:model="stock">
                                        @error('stock') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Gambar</label>
                                        <input type="file" class="form-control" id="image" wire:model="image">
                                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                        <div wire:loading wire:target="image">Uploading...</div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button wire:navigate href="{{ route('admin.books') }}" type="button" class="btn btn-secondary">Cancel</button>
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