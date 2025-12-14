<?php

namespace App\Livewire\Public;

use App\Models\Book;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('components.layouts.app')]

class BookDetail extends Component
{
    public Book $book;

    public function mount($id)
    {
        $this->book = Book::with(['author', 'category', 'ratings.user', 'ratings.review'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.public.book-detail');
    }
}
