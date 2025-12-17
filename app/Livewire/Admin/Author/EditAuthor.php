<?php

namespace App\Livewire\Admin\Author;

use App\Models\Author;
use App\Services\AuthorService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

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

    public function messages()
    {
        return [
            'authorName.required' => 'Nama penulis wajib diisi.',
            'authorName.string' => 'Nama penulis harus berupa teks.',
            'authorName.max' => 'Nama penulis tidak boleh lebih dari 255 karakter.',
            'authorName.unique' => 'Nama penulis ini sudah terdaftar, silakan gunakan nama lain.',
        ];
    }

    public function save(AuthorService $authorService)
    {
        $this->validate([
            'authorName' => 'required|string|max:255|unique:authors,author,'.$this->author->id,
        ]);

        $authorService->updateAuthor($this->author, $this->authorName);

        session()->flash('message', 'Penulis berhasil diperbarui.');

        return redirect()->route('admin.authors');
    }

    public function render()
    {
        return view('livewire.admin.author.edit-author');
    }
}
