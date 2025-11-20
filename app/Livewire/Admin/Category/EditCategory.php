<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Services\CategoryService;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout; // <--- Pastikan baris ini ada

// Arahkan ke: resources/views/components/layouts/admin.blade.php
#[Layout('components.layouts.admin')]

class EditCategory extends Component
{

     public Category $category;

    #[Validate('required|string|max:100')]
    public string $categoryName = '';

    #[Validate('required|string|max:100')]
    public string $slug = '';

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->categoryName = $category->category;
        $this->slug = $category->slug;
    }

    public function updatedCategoryName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save(CategoryService $categoryService)
    {
        $this->validate([
            'categoryName' => 'required|string|max:100|unique:categories,category,' . $this->category->id,
            'slug' => 'required|string|max:100|unique:categories,slug,' . $this->category->id,
        ]);

        $categoryService->updateCategory($this->category, $this->categoryName, $this->slug);

        session()->flash('message', 'Category updated successfully.');

        return redirect()->route('admin.categories');
    }

    public function render()
    {
        return view('livewire.admin.category.edit-category');
    }
}


