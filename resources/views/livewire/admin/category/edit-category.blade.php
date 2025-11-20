<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Edit Category</h1>
    <form wire:submit.prevent="save">
        <div class="card-body">
            <div class="mb-4">
                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">
                    Kategori
                </label>
                <input type="text" id="category" wire:model.live="categoryName"
                    class="form-control">
                @error('categoryName') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-gray-700 text-sm font-bold mb-2">
                    Slug
                </label>
                <input type="text" id="slug" wire:model.live="slug" disabled
                    class="form-control">
                @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
                <a wire:navigate href="{{ route('admin.categories') }}"  type="button"
                    class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>