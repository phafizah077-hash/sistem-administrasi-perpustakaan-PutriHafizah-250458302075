<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]

class CategoryManajemen extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function deleteCategory($categoryId)
    {
        Category::find($categoryId)->delete();
        session()->flash('message', 'Kategori berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.category-manajemen', [
            'categories' => Category::latest()->paginate(10),
        ]);
    }
}
