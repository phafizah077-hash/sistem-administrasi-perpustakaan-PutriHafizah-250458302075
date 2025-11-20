<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Manajemen Peminjaman</h3>
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

                                <div>
                                    <a wire:navigate href="{{ route('admin.loans.create') }}" class="btn btn-primary mb-4">
                                        Transaksi Baru
                                    </a>
                                    <button wire:click="exportBorrowedLoans" class="btn btn-secondary mb-4">
                                        Ekspor Data
                                    </button>
                                </div>


                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Peminjam</th>
                                            <th>Buku</th>
                                            <th>Tgl. Pinjam</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($loans as $loan)
                                        <tr class="align-middle">
                                            <td>{{ $loan->user->name }}</td>
                                            <td>{{ $loan->book->title }}</td>
                                            <td>{{ $loan->loan_date->format('d M Y') }}</td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">{{ ucfirst($loan->status) }}</span>
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-10">
                                                <p class="text-gray-500">Tidak ada data peminjaman.</p>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>