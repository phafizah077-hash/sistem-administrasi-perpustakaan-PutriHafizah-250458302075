<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Data User</h3>
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
                                @if (session()->has('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                <table class="table table-bordered">
                                    <a wire:navigate href="{{ route('admin.users.create') }}" class="btn btn-primary mb-4">
                                        Add New User
                                    </a>
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No Telp</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th style="width: 150px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr class="align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td><span class="badge {{ $user->role == 'Pustakawan' ? 'text-bg-primary' : 'text-bg-secondary' }}">{{ $user->role }}</span></td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    {{-- TOMBOL VIEW --}}
                                                    {{-- Perhatikan: tombol ini memicu Modal Bootstrap DAN Livewire --}}
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-info"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalDetailUser"
                                                        wire:click="$dispatch('view-user-detail', { userId: {{ $user->id }} })">
                                                        View
                                                    </button>

                                                    <a wire:navigate href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                                        Edit
                                                    </a>
                                                    <button class="btn btn-sm btn-danger" wire:click="deleteUser({{ $user->id }})" wire:confirm="Are you sure you want to delete this user?">Delete</button>
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

    <livewire:admin.user.view-user />
</div>