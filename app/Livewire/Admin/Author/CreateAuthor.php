<?php

namespace App\Livewire\Admin\Author;

use App\Services\AuthorService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class CreateAuthor extends Component
{
    #[Validate('required|string|max:255')]
    public string $author = '';

    public function messages()
    {
        return [
            'author.required' => 'Nama penulis wajib diisi.',
            'author.max' => 'Nama penulis tidak boleh lebih dari 255 karakter.',
        ];
    }

    public function save(AuthorService $authorService)
    {
        $this->validate();

        $authorService->createAuthor($this->author);

        session()->flash('message', 'Penulis berhasil ditambahkan.');

        return redirect()->route('admin.authors');
    }

    public function render()
    {
        return view('livewire.admin.author.create-author');
    }
}
