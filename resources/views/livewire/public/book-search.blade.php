<div>
    {{-- Search & Filter Container --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 mb-10">
        <div class="flex flex-col md:flex-row gap-4 justify-between items-center">

            {{-- Search Input --}}
            <div class="relative w-full md:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari judul buku atau penulis..."
                    class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-xl leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition sm:text-sm">
            </div>

            {{-- Category Buttons --}}
            <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0 w-full md:w-auto">
                <button wire:click="setCategory(null)" class="{{ is_null($categoryFilter) ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }} whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all duration-200">
                    Semua
                </button>
                @foreach ($categories as $category)
                <button wire:click="setCategory({{ $category->id }})" class="{{ $categoryFilter == $category->id ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }} whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all duration-200">
                    {{ $category->category }}
                </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Grid Container Buku --}}
    <div wire:loading.class="opacity-50" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse ($books as $book)
        <a href="{{ route('books.detail', $book->id) }}" wire:navigate class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 flex flex-col h-full transform hover:-translate-y-1">
            <div class="h-64 bg-slate-200 relative overflow-hidden">
                <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute top-3 right-3">
                    <span class="px-3 py-1 rounded-full text-xs font-bold shadow-sm {{ $book->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ $book->stock > 0 ? 'Tersedia' : 'Dipinjam' }}
                    </span>
                </div>
            </div>
            <div class="p-5 flex-1 flex flex-col">
                <span class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">{{ $book->category->category }}</span>
                <h3 class="text-lg font-bold text-slate-800 leading-tight mb-1 line-clamp-2 group-hover:text-indigo-600 transition">{{ $book->title }}</h3>
                <p class="text-slate-500 text-sm mb-4">{{ $book->author->author }}</p>
                <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                    <span>Tahun: {{ $book->publication_year }}</span>
                    <span class="group-hover:underline">Selengkapnya &rarr;</span>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-full text-center py-20 bg-slate-50 rounded-2xl border border-dashed border-slate-300">
            <svg class="h-12 w-12 text-slate-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <h3 class="text-lg font-medium text-slate-900">Tidak ada buku ditemukan</h3>
            <p class="text-slate-500">Coba kata kunci lain atau ubah kategori.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $books->links() }}
    </div>
</div>