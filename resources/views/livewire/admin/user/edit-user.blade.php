<div>
    <!-- Page header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit User</h3>
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
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control @error('form.name') is-invalid @enderror" id="name" wire:model.lazy="form.name">
                                            @error('form.name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('form.email') is-invalid @enderror" id="email" wire:model.lazy="form.email">
                                            @error('form.email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model="password">
                                            @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="password_confirmation" wire:model="password_confirmation">
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <select class="form-select @error('form.role') is-invalid @enderror" id="role" wire:model="form.role">
                                                <option value="Anggota">Anggota</option>
                                                <option value="Pustakawan">Pustakawan</option>
                                            </select>
                                            @error('form.role') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control @error('form.phone') is-invalid @enderror" id="phone" wire:model.lazy="form.phone">
                                            @error('form.phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control @error('form.address') is-invalid @enderror" id="address" wire:model.lazy="form.address"></textarea>
                                            @error('form.address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit"
                                            class="btn btn-primary">
                                            Save
                                        </button>
                                        <a wire:navigate href="{{ route('admin.users') }}" type="button"
                                            class="btn btn-secondary">
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