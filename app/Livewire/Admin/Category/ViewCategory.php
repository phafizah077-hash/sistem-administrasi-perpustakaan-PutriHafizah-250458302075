<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewCategory extends Component
{
    public ?Category $category = null;

    #[On('view-category-detail')]
    public function showCategory(int $categoryId)
    {
        $this->category = Category::find($categoryId);
    }

    public function render()
    {
        return view('livewire.admin.category.view-category');
    }
}
