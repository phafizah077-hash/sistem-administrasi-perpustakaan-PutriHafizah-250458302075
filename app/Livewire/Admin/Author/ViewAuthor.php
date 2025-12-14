<?php

namespace App\Livewire\Admin\Author;

use Livewire\Component;
use App\Models\Author;
use Livewire\Attributes\On;

class ViewAuthor extends Component
{
    public $author = null;

    #[On('view-author-detail')] 

    public function loadAuthor($authorId)
    {
        $this->author = Author::find($authorId);
    }

    public function render()
    {
        return view('livewire.admin.author.view-author');
    }
}