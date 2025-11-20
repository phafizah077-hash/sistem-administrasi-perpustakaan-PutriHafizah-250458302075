<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Buat Peminjaman Baru</h1>

    <form wire:submit="save" class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <label for="userId" class="block text-gray-700 text-sm font-bold mb-2">Peminjam:</label>
            <select wire:model="userId" id="userId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Pilih Peminjam</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('userId') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="bookId" class="block text-gray-700 text-sm font-bold mb-2">Buku:</label>
            <select wire:model="bookId" id="bookId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Pilih Buku</option>
                @foreach ($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }} (Stok: {{ $book->stock }})</option>
                @endforeach
            </select>
            @error('bookId') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label for="loanDays" class="block text-gray-700 text-sm font-bold mb-2">Durasi Peminjaman (Hari):</label>
            <input type="number" wire:model="loanDays" id="loanDays" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="1">
            @error('loanDays') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan Peminjaman
            </button>
            <a wire:navigate href="{{ route('admin.loans') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Batal
            </a>
        </div>
    </form>

    @if (session()->has('message'))
    <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('message') }}</span>
    </div>
    @endif

    @if (session()->has('error'))
    <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif
</div>