<?php

namespace App\Livewire\Public;

use App\Models\Category;
use App\Services\BookService;
use Livewire\Component;
use Livewire\WithPagination;

class BookSearch extends Component
{
    use WithPagination;

    public $search = '';

    public $categoryFilter = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => null, 'as' => 'kategori'],
    ];

    // PROTECTION 1: Saat halaman dimuat pertama kali (misal dari link ?kategori=5)
    // Kita pastikan string "5" dari URL diubah jadi angka 5
    public function mount()
    {
        if ($this->categoryFilter !== null && $this->categoryFilter !== '') {
            $this->categoryFilter = (int) $this->categoryFilter;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setCategory($categoryId)
    {
        // PROTECTION 2: Validasi input saat tombol diklik
        // Kita terima input (bisa string karena tanda kutip di Blade), lalu ubah.

        // Cek jika kosong atau string "null"
        if (empty($categoryId) || $categoryId === 'null') {
            $this->categoryFilter = null;
        } else {
            // KUNCI UTAMA: Paksa ubah jadi Integer (Angka) di sini
            $this->categoryFilter = (int) $categoryId;
        }

        $this->resetPage();
    }

    public function render(BookService $bookService)
    {
        // PROTECTION 3: Final Check sebelum kirim ke Service
        // Pastikan yang dikirim ke service adalah integer murni atau null
        if ($this->categoryFilter === null || $this->categoryFilter === '') {
            $finalCategory = null;
        } else {
            $finalCategory = (int) $this->categoryFilter;
        }

        $books = $bookService->getFilteredBooks($this->search, $finalCategory);
        $categories = Category::all();

        return view('livewire.public.book-search', [
            'books' => $books,
            'categories' => $categories,
        ]);
    }
}
