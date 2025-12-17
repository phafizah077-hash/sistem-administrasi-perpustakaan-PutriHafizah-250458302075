<div class="p-6 md:p-8">
    <a href="{{ route('home') }}" wire:navigate class="text-indigo-600 hover:text-indigo-900 mb-6 inline-block">&larr; Kembali ke Beranda</a>
    <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-2/5 bg-slate-100 h-96 md:h-auto relative flex-shrink-0 rounded-lg">
            <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover rounded-lg">
        </div>

        <div class="w-full md:w-3/5 p-6 md:p-8 flex flex-col">
            <div class="mb-1">
                <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">{{ $book->category->category }}</span>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-2">{{ $book->title }}</h2>
            <p class="text-slate-600 font-medium mb-6">oleh {{ $book->author->author }}</p>

            <div class="prose prose-slate mb-8 flex-grow">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-2">Detail Buku</h4>
                <ul class="text-slate-600 leading-relaxed text-sm">
                    <li><strong>Penerbit:</strong> {{ $book->publisher ?? '-' }}</li>
                    <li><strong>Tahun Terbit:</strong> {{ $book->publication_year ?? '-' }}</li>
                    <li><strong>ISBN:</strong> {{ $book->isbn ?? '-' }}</li>
                    <li><strong>Stok:</strong> {{ $book->stock }}</li>
                    <li><strong>Sinopsis:</strong> {{ $book->sinopsis }}</li>
                </ul>
            </div>

            <div class="mt-auto pt-6 border-t border-slate-100 flex items-center justify-between">
                <div>
                    <span class="text-xs text-slate-400 uppercase font-bold block">Status</span>
                    <span class="font-bold {{ $book->stock > 1 ? 'text-green-600' : 'text-amber-600' }}">
                        {{ $book->stock > 1 ? 'Tersedia' : 'Tidak Tersedia' }}
                    </span>
                </div>

                @if ($book->stock > 1)
                @guest
                <span class="text-slate-500 text-sm italic">
                    Silakan login untuk masuk.
                </span>
                @endguest
                @endif
            </div>
        </div>
    </div>

    <div class="mt-12 p-6 md:p-8 bg-white shadow-md rounded-lg">
        <h3 class="text-2xl font-bold mb-6 text-slate-900">Ulasan Pengguna</h3>

        @forelse ($book->ratings as $rating)
        <div class="border-b border-slate-200 pb-6 mb-6 last:border-b-0 last:pb-0 last:mb-0">
            <div class="flex items-center mb-2">
                <p class="font-semibold text-slate-800 mr-3">{{ $rating->user->name }}</p>
                <div class="flex">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $rating->rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.368-2.448a1 1 0 00-1.175 0l-3.368 2.448c-.784.57-1.838-.197-1.539-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.34 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                        </svg>
                        @endfor
                </div>
            </div>
            @if ($rating->review && $rating->review->comment)
            <p class="text-slate-700 text-sm leading-relaxed">{{ $rating->review->comment }}</p>
            @else
            <p class="text-slate-500 text-sm italic">Tidak ada ulasan tertulis.</p>
            @endif
        </div>
        @empty
        <p class="text-slate-500 text-center">Belum ada ulasan untuk buku ini.</p>
        @endforelse
    </div>
</div>