<?php

namespace App\Livewire\Admin\Book;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Services\BookService;
use Livewire\Attributes\Layout; // <--- Pastikan baris ini ada

// Arahkan ke: resources/views/components/layouts/admin.blade.php
#[Layout('components.layouts.admin')]

class EditBook extends Component
{
    use WithFileUploads;

    public Book $book;

    // 1. Kita ganti Form Object menjadi Array biasa
    // Ini supaya cocok dengan HTML kamu yang pakai "form.title", "form.isbn", dll.
    public $form = [];

    // 2. Khusus Image, kita taruh di luar array agar upload file lebih stabil
    public $image;
    public $existingImage;

    // 3. Variabel untuk Dropdown (agar error undefined hilang)
    public $allAuthors;
    public $allCategories;

    public function mount(Book $book)
    {
        $this->book = $book;
        $this->existingImage = $book->image;

        // Ambil data untuk dropdown
        $this->allAuthors = Author::all();
        $this->allCategories = Category::all();

        // Masukkan data buku ke dalam array form
        $this->form = [
            'title' => $book->title,
            'author_id' => $book->author_id,
            'category_id' => $book->category_id,
            'isbn' => $book->isbn,
            'publisher' => $book->publisher,
            'publication_year' => $book->publication_year,
            'stock' => $book->stock,
        ];
    }

    public function save(BookService $bookService)
    {
        // Validasi Array
        $this->validate([
            'form.title' => 'required|string|max:255',
            'form.author_id' => 'required|exists:authors,id',
            'form.category_id' => 'required|exists:categories,id',
            'form.isbn' => 'required|string|max:20|unique:books,isbn,' . $this->book->id,
            'form.publisher' => 'nullable|string|max:150',
            'form.publication_year' => 'nullable|integer|digits:4',
            'form.stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:1024', // Validasi image terpisah
        ]);

        // Ambil data dari array form
        $data = $this->form;

        // Logika simpan gambar
        if ($this->image) {
            $data['image'] = $this->image->store('book-images', 'public');
        } else {
            $data['image'] = $this->existingImage;
        }

        $bookService->updateBook($this->book, $data);

        session()->flash('message', 'Book updated successfully.');

        return redirect()->route('admin.books');
    }

    public function render()
    {
        return view('livewire.admin.book.edit-book');
    }
}
