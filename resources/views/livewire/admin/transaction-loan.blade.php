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
                    <h3 class="mb-0 fw-bold text-slate-800">Manajemen Peminjaman</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                            <h3 class="card-title fw-bold text-secondary">Daftar Peminjaman</h3>
                            <div class="d-flex gap-2">
                                <a wire:navigate href="{{ route('admin.loans.create') }}" class="btn btn-indigo rounded-pill px-4">
                                    <i class="bi bi-plus-lg me-1"></i> Transaksi Baru
                                </a>
                            </div>
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
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" style="width: 50px">No</th>
                                            <th>Peminjam</th>
                                            <th>Buku</th>
                                            <th class="text-center">Tgl. Pinjam</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($loans as $loan)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loans->firstItem() + $loop->index }}
                                            </td>
                                            <td class="fw-semibold text-dark">{{ $loan->user->name }}</td>
                                            <td class="text-muted">{{ $loan->book->title }}</td>
                                            <td class="text-center font-monospace text-secondary">
                                                {{ $loan->loan_date->format('d M Y') }}
                                            </td>
                                            <td class="text-center">
                                                {{-- LOGIKA STATUS DIMULAI DI SINI --}}
                                                @if($loan->status == 'borrowed')
                                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning-subtle px-3 py-2 rounded-pill">
                                                    <i class="bi bi-clock-history me-1"></i> Sedang Dipinjam
                                                </span>
                                                @elseif($loan->status == 'returned')
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-2 rounded-pill">
                                                    <i class="bi bi-check-circle me-1"></i> Sudah Dikembalikan
                                                </span>
                                                @else
                                                {{-- Fallback jika ada status lain yang tidak terduga --}}
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary-subtle px-3 py-2 rounded-pill">
                                                    {{ ucfirst($loan->status) }}
                                                </span>
                                                @endif
                                                {{-- LOGIKA STATUS BERAKHIR DI SINI --}}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="bi bi-inbox text-slate-300" style="font-size: 3rem;"></i>
                                                    <p class="text-muted mt-2">Belum ada data peminjaman.</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if ($loans->count())
                        <div class="card-footer bg-white d-flex justify-content-end py-3">
                            {{ $loans->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>