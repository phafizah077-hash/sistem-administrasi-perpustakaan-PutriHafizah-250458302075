<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Edit Author</h1>
    <form wire:submit.prevent="save">
        <div class="card-body">
            <div class="mb-4">
                <label for="author" class="block text-gray-700 text-sm font-bold mb-2">
                    Nama Penulis
                </label>
                <input type="text" id="author" wire:model.live="authorName"
                    class="form-control">
                @error('author') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Save</button>
                <button wire:navigate href="{{ route('admin.authors') }}" type="button" class="btn btn-secondary">Cancel</button>
            </div>
        </div>

    </form>
</div>