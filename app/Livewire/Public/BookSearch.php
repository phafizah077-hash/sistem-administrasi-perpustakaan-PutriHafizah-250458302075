<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use App\Services\BookService;

class BookSearch extends Component
{
      use WithPagination;

    public string $search = '';
    public ?int $categoryFilter = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => null],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function setCategory($categoryId)
    {
        $this->categoryFilter = $categoryId;
    }


    public function render(BookService $bookService)
    {
        $books = $bookService->getFilteredBooks($this->search, $this->categoryFilter);
        $categories = Category::all();

        return view('livewire.public.book-search', [
            'books' => $books,
            'categories' => $categories,
        ]);
    }
}

