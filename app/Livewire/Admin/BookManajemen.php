<?php

namespace App\Livewire\Admin;

use App\Models\Book;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]

class BookManajemen extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function deleteBook($bookId)
    {
        $book = Book::find($bookId);

        if ($book) {
            $book->delete();
            session()->flash('message', 'Buku berhasil dihapus.');
        }
    }

    public function render()
    {
        return view('livewire.admin.book-manajemen', [
            'books' => Book::with(['author', 'category'])->latest()->paginate(10),
        ]);
    }
}
