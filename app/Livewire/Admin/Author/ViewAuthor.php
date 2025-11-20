<?php

namespace App\Livewire\Admin\Author;

use Livewire\Component;
use App\Models\Author;
use Livewire\Attributes\On;

class ViewAuthor extends Component
{
    // Pastikan ini public dan null
    public $author = null;

    #[On('view-author-detail')] 
    public function loadAuthor($authorId)
    {
        // Cek apakah ID masuk?
        // dd($authorId); // Hilangkan komentar ini kalau mau ngetes ID masuk atau nggak
        
        $this->author = Author::find($authorId);
    }

    public function render()
    {
        return view('livewire.admin.author.view-author');
    }
}