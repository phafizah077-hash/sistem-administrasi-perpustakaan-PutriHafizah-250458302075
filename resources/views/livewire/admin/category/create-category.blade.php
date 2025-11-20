<div>
    <!-- Page header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add New Category</h3>
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
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <label for="category" class="block text-gray-700 text-sm font-bold mb-2">
                                                Kategori
                                            </label>
                                            <input type="text" id="category" wire:model.live="category"
                                                class="form-control">
                                            @error('category') <span class="text-danger">{{ $message }}</span> @enderror
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
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button wire:navigate href="{{ route('admin.categories') }}" type="button" class="btn btn-secondary">Cancel</button>
                                        </div>
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