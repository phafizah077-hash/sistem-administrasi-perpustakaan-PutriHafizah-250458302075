<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout; // <--- Pastikan baris ini ada

// Arahkan ke: resources/views/components/layouts/admin.blade.php
#[Layout('components.layouts.admin')]

class CategoryManajemen extends Component
{
    use WithPagination;

    public function deleteCategory($categoryId)
    {
        Category::find($categoryId)->delete();
        session()->flash('message', 'Category deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.category-manajemen', [
            'categories' => Category::latest()->paginate(10),
        ]);
    }
}
