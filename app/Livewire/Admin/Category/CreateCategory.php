<?php

namespace App\Livewire\Admin\Category;

use App\Services\CategoryService;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout; // <--- Pastikan baris ini ada

// Arahkan ke: resources/views/components/layouts/admin.blade.php
#[Layout('components.layouts.admin')]

class CreateCategory extends Component
{
    #[Validate('required|string|max:100|unique:categories,category')]
    public string $category = '';

    #[Validate('required|string|max:100|unique:categories,slug')]
    public string $slug = '';

    public function updatedCategory($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save(CategoryService $categoryService)
    {
        $this->validate();

        $categoryService->createCategory($this->category, $this->slug);

        session()->flash('message', 'Category created successfully.');

        return redirect()->route('admin.categories');
    }

    public function render()
    {
       return view('livewire.admin.category.create-category');
    }
}

