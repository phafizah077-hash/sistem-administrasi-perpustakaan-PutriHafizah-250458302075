<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <a href="{{ route('home') }}" wire:navigate class="text-indigo-600 hover:text-indigo-900 mb-6 inline-block">&larr; Kembali ke Katalog</a>
    <h1 class="text-2xl font-bold mb-6">Riwayat Peminjaman Anda</h1>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Buku
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Tgl. Pinjam
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Tgl. Jatuh Tempo
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($loans as $loan)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $loan->book->title }}</p>
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

    {{-- Review Modal --}}
    @if ($showModal && $selectedLoan)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-xl p-6 md:p-8 w-full max-w-lg mx-4">
            <h3 class="text-xl font-bold mb-4">Ulasan untuk: {{ $selectedLoan->book->title }}</h3>

            <form wire:submit.prevent="saveReview">
                {{-- Rating --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Rating Anda</label>
                    <div class="flex space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg wire:click="$set('rating', {{ $i }})" class="w-8 h-8 cursor-pointer {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.368-2.448a1 1 0 00-1.175 0l-3.368 2.448c-.784.57-1.838-.197-1.539-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.34 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                            </svg>
                            @endfor
                    </div>
                    @error('rating') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Comment --}}
                <div class="mb-6">
                    <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">Ulasan Anda</label>
                    <textarea wire:model.defer="comment" id="comment" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Bagaimana pendapat Anda tentang buku ini?"></textarea>
                    @error('comment') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" wire:click="closeModal" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                        Batal
                    </button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        Simpan Ulasan
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>