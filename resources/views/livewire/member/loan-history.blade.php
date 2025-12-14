<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-12">
    <a href="{{ route('home') }}" wire:navigate class="text-indigo-600 hover:text-indigo-900 mb-4 md:mb-6 inline-flex items-center text-sm md:text-base">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali ke Beranda
    </a>

    <h1 class="text-xl md:text-2xl font-bold mb-4 md:mb-6">Peminjaman Saya</h1>

    <div class="block md:hidden space-y-4">
        @forelse ($loans as $loan)
        <div class="bg-white shadow rounded-lg p-4 border border-gray-100">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <h3 class="font-bold text-gray-900 text-base">{{ $loan->book->title }}</h3>
                    <p class="text-xs text-gray-500">{{ $loan->book->author->author }}</p>
                </div>
                <span class="px-2 py-1 text-xs font-semibold {{ $loan->status === 'returned' ? 'text-green-900 bg-green-200' : 'text-yellow-900 bg-yellow-200' }} rounded-full shrink-0 ml-2">
                    {{ ucfirst($loan->status) }}
                </span>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm mb-4 border-t border-b border-gray-100 py-2">
                <div>
                    <span class="text-gray-500 text-xs block">Tgl. Pinjam</span>
                    <span class="font-medium text-gray-800">{{ $loan->loan_date->format('d M Y') }}</span>
                </div>
                <div>
                    <span class="text-gray-500 text-xs block">Jatuh Tempo</span>
                    <span class="font-medium text-gray-800">{{ $loan->due_date->format('d M Y') }}</span>
                </div>
            </div>

            <div class="flex justify-end">
                @if ($loan->status === 'returned')
                <button wire:click="openReviewModal({{ $loan->id }})" class="w-full sm:w-auto text-center bg-indigo-50 text-indigo-700 hover:bg-indigo-100 px-4 py-2 rounded text-sm font-semibold transition">
                    {{ $loan->book->ratings->isNotEmpty() ? 'Edit Ulasan' : 'Beri Ulasan' }}
                </button>
                @else
                <span class="text-gray-400 text-xs italic">Menunggu pengembalian</span>
                @endif
            </div>
        </div>
        @empty
        <div class="bg-white rounded-lg p-6 text-center text-gray-500">
            Anda belum memiliki riwayat peminjaman.
        </div>
        @endforelse
    </div>

    <div class="hidden md:block bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Buku</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tgl. Pinjam</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tgl. Jatuh Tempo</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($loans as $loan)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 font-medium whitespace-no-wrap">{{ $loan->book->title }}</p>
                        <p class="text-gray-600 whitespace-no-wrap text-xs">{{ $loan->book->author->author }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $loan->loan_date->format('d M Y') }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $loan->due_date->format('d M Y') }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <span class="relative inline-block px-3 py-1 font-semibold {{ $loan->status === 'returned' ? 'text-green-900 bg-green-200' : 'text-yellow-900 bg-yellow-200' }} leading-tight rounded-full">
                            <span class="relative">{{ ucfirst($loan->status) }}</span>
                        </span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        @if ($loan->status === 'returned')
                        <button wire:click="openReviewModal({{ $loan->id }})" class="text-indigo-600 hover:text-indigo-900 font-semibold">
                            {{ $loan->book->ratings->isNotEmpty() ? 'Edit Ulasan' : 'Beri Ulasan' }}
                        </button>
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-10">
                        <p class="text-gray-500">Anda belum memiliki riwayat peminjaman.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $loans->links() }}
    </div>

    @if ($showModal && $selectedLoan)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 px-4">
        <div class="bg-white rounded-lg shadow-xl p-5 md:p-8 w-full max-w-lg">
            <h3 class="text-lg md:text-xl font-bold mb-4 line-clamp-2">Ulasan: {{ $selectedLoan->book->title }}</h3>

            <form wire:submit.prevent="saveReview">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Rating Anda</label>
                    <div class="flex space-x-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" wire:click="$set('rating', {{ $i }})" class="focus:outline-none transition transform active:scale-110">
                            <svg class="w-8 h-8 md:w-10 md:h-10 {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.368-2.448a1 1 0 00-1.175 0l-3.368 2.448c-.784.57-1.838-.197-1.539-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.34 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                            </svg>
                            </button>
                            @endfor
                    </div>
                    @error('rating') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">Ulasan Anda</label>
                    <textarea wire:model.defer="comment" id="comment" rows="4" class="shadow-sm appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Bagaimana pendapat Anda tentang buku ini?"></textarea>
                    @error('comment') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" wire:click="closeModal" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded text-sm transition">
                        Batal
                    </button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm shadow transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>