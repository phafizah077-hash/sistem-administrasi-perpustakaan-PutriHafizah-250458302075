<?php

namespace App\Livewire\Admin\Book;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout; // <--- Pastikan baris ini ada

// Arahkan ke: resources/views/components/layouts/admin.blade.php
#[Layout('components.layouts.admin')]

class CreateBook extends Component
{
    use WithFileUploads;

    public $title;
    public $author_id;
    public $category_id;
    public $isbn;
    public $publisher;
    public $publication_year;
    public $stock;
    public $image;

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'isbn' => 'required|string|max:20|unique:books,isbn',
            'publisher' => 'required|string|max:150',
            'publication_year' => 'required|numeric|min:1000|max:' . (date('Y') + 1),
            'stock' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('books', 'public');
        }

        Book::create([
            'title' => $this->title,
            'author_id' => $this->author_id,
            'category_id' => $this->category_id,
            'isbn' => $this->isbn,
            'publisher' => $this->publisher,
            'publication_year' => $this->publication_year,
            'stock' => $this->stock,
            'image' => $imagePath,
        ]);

         session()->flash('message', 'Book created successfully.');
        
        return redirect()->route('admin.books');
    }

    public function render()
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('livewire.admin.book.create-book', compact('authors', 'categories'));
    }
}
