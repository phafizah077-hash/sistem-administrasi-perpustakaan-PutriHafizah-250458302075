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
        if (empty($categoryId) || $categoryId === 'null') {
            $this->categoryFilter = null;
        } else {
            $this->categoryFilter = (int) $categoryId;
        }

        $this->resetPage();
    }

    public function render(BookService $bookService)
    {
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
