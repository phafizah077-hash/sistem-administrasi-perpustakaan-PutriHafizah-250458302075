<?php

namespace App\Livewire\Admin;

use App\Models\Author;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]

class AuthorManajemen extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function deleteAuthor($authorId)
    {
        $author = Author::find($authorId);

        if ($author) {
            $author->delete();
            session()->flash('message', 'Penulis berhasil dihapus.');
        }
    }

    public function render()
    {
        return view('livewire.admin.author-manajemen', [
            'authors' => Author::latest()->paginate(10),
        ]);
    }
}
