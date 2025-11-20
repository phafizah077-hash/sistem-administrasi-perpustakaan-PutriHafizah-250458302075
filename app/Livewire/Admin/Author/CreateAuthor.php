<?php

namespace App\Livewire\Admin\Author;

use App\Services\AuthorService;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout; // <--- Pastikan baris ini ada

// Arahkan ke: resources/views/components/layouts/admin.blade.php
#[Layout('components.layouts.admin')]

class CreateAuthor extends Component
{
  #[Validate('required|string|max:255')]
  public string $author = '';

  public function save(AuthorService $authorService)
  {
    $this->validate();

    $authorService->createAuthor($this->author);

    session()->flash('message', 'Author created successfully.');

    return redirect()->route('admin.authors');
  }

  public function render()
  {
    return view('livewire.admin.author.create-author');
  }
}
