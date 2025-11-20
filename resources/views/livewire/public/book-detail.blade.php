<div class="p-6 md:p-8">
    <a href="{{ route('home') }}" wire:navigate class="text-indigo-600 hover:text-indigo-900 mb-6 inline-block">&larr; Kembali ke Katalog</a>
    <div class="flex flex-col md:flex-row">
        <!-- Image Side -->
        <div class="w-full md:w-2/5 bg-slate-100 h-96 md:h-auto relative flex-shrink-0 rounded-lg">
            <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover rounded-lg">
        </div>

        <!-- Info Side -->
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
                </ul>
            </div>

            <div class="mt-auto pt-6 border-t border-slate-100 flex items-center justify-between">
                <div>
                    <span class="text-xs text-slate-400 uppercase font-bold block">Status</span>
                    <span class="font-bold {{ $book->stock > 0 ? 'text-green-600' : 'text-amber-600' }}">
                        {{ $book->stock > 0 ? 'Tersedia' : 'Dipinjam' }}
                    </span>
                </div>
                @if ($book->stock > 0)
                @guest
                <div class="flex items-center gap-4">
                    <a href="{{ route('register', ['redirect' => route('books.detail', $book->id)]) }}" class="px-6 py-3 rounded-xl font-semibold text-white bg-slate-700 hover:bg-slate-800 transition">
                        Register
                    </a>
                    <a href="{{ route('login', ['redirect' => route('books.detail', $book->id)]) }}" class="px-6 py-3 rounded-xl font-semibold text-white bg-indigo-600 hover:bg-indigo-700 transition shadow-lg">
                        Login untuk Pinjam
                    </a>
                </div>
                @else
                {{-- Jika sudah login, bisa ditambahkan aksi lain, misal langsung meminjam --}}
                <a href="{{ route('member.dashboard') }}" class="px-8 py-3 rounded-xl font-semibold text-white bg-indigo-600 hover:bg-indigo-700 transition shadow-lg">
                    Masuk ke Dashboard
                </a>
                @endguest
                @else
                <button disabled class="px-8 py-3 rounded-xl font-semibold text-white bg-slate-300 cursor-not-allowed">
                    Tidak Tersedia
                </button>
                @endif
            </div>
        </div>
    </div>
</div>