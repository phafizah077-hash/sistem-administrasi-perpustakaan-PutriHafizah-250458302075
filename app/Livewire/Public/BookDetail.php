<?php

namespace App\Livewire\Public;

use App\Models\Book;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;



class BookDetail extends Component
{
    public $book;

    // Tangkap $id di sini (sesuai nama di route tadi)
    public function mount($id)
    {
        // Cari buku berdasarkan ID
        $this->book = Book::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.public.book-detail');
    }
}
