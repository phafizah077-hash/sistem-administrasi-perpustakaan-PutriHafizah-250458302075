<?php

namespace App\Livewire\Admin;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout; // <--- Pastikan baris ini ada

// Arahkan ke: resources/views/components/layouts/admin.blade.php
#[Layout('components.layouts.admin')]

class BookManajemen extends Component
{
    use WithPagination;

    public function deleteBook($bookId)
    {
        Book::find($bookId)->delete();
        session()->flash('message', 'Book deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.book-manajemen', [
            'books' => Book::with(['author', 'category'])->latest()->paginate(10),
        ]);
    }
}
