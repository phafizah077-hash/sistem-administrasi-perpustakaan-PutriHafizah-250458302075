<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout; // <--- Pastikan baris ini ada

// Arahkan ke: resources/views/components/layouts/admin.blade.php
#[Layout('components.layouts.admin')]

class Dashboard extends Component
{
    public $userCount;
    public $bookCount;
    public $authorCount;
    public $categoryCount;

    public function mount()
    {
        $this->userCount = User::count();
        $this->bookCount = Book::count();
        $this->authorCount = Author::count();
        $this->categoryCount = Category::count();
    }

    public function openCreateModal()
    {
        $this->dispatch('open-modal', 'createBookModal');
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
