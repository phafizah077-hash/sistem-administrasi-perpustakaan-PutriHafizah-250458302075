<?php

namespace App\Livewire\Admin;

use App\Models\Author;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout; // <--- Pastikan baris ini ada

// Arahkan ke: resources/views/components/layouts/admin.blade.php
#[Layout('components.layouts.admin')]

class AuthorManajemen extends Component
{
    use WithPagination;

    public function deleteAuthor($authorId)
    {
        Author::find($authorId)->delete();
        session()->flash('message', 'Author deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.author-manajemen', [
            'authors' => Author::latest()->paginate(10),
        ]);
    }
}