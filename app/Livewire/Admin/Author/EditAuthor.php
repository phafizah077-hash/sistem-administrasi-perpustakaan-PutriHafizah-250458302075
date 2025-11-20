<?php

namespace App\Livewire\Admin\Author;

use App\Models\Author;
use Livewire\Component;
use App\Services\AuthorService;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout; // <--- Pastikan baris ini ada

// Arahkan ke: resources/views/components/layouts/admin.blade.php
#[Layout('components.layouts.admin')]

class EditAuthor extends Component
{
     public Author $author;

    #[Validate('required|string|max:255')]
    public string $authorName = '';

    public function mount(Author $author)
    {
        $this->author = $author;
        $this->authorName = $author->author;
    }

    public function save(AuthorService $authorService)
    {
        $this->validate([
            'authorName' => 'required|string|max:255|unique:authors,author,' . $this->author->id,
        ]);

        $authorService->updateAuthor($this->author, $this->authorName);

        session()->flash('message', 'Author updated successfully.');

        return redirect()->route('admin.authors');
    }
    
    public function render()
    {
        return view('livewire.admin.author.edit-author');
    }
}
