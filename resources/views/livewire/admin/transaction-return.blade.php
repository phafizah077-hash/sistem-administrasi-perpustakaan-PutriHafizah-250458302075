<div>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Manajemen Pengembalian</h3>
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

                                <a wire:navigate href="" class="btn btn-secondary mb-4">
                                    Ekspor Data
                                </a>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Peminjam</th>
                                            <th>Buku</th>
                                            <th>Tgl. Kembali</th>
                                            <th>Status</th>
                                            <th style="width: 150px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($loans as $loan)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">{{ $loan->user->name }}</p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">{{ $loan->book->title }}</p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">{{ $loan->due_date->format('d M Y') }}</p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                @if (now() > $loan->due_date)
                                                <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight bg-red-200 rounded-full">
                                                    <span class="relative">Terlambat</span>
                                                </span>
                                                @else
                                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight bg-green-200 rounded-full">
                                                    <span class="relative">Tepat Waktu</span>
                                                </span>
                                                @endif
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                                <button wire:click="processReturn({{ $loan->id }})" wire:confirm="Anda yakin ingin memproses pengembalian untuk buku ini?" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    Proses Pengembalian
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-10">
                                                <p class="text-gray-500">Tidak ada buku yang sedang dipinjam.</p>
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