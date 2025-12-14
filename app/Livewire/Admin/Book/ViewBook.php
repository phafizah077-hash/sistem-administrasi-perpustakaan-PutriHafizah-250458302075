<?php

namespace App\Livewire\Admin\Book;

use App\Models\Book;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewBook extends Component
{
    public ?Book $book = null;

    #[On('view-book-detail')]
    
    public function showBook(int $bookId)
    {
        $this->book = Book::with(['author', 'category'])->find($bookId);
    }

    public function render()
    {
        return view('livewire.admin.book.view-book');
    }
}
