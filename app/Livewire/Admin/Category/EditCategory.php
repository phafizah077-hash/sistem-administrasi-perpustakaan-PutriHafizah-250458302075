<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

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

    public function messages()
    {
        return [
            'categoryName.required' => 'Nama kategori wajib diisi.',
            'categoryName.string' => 'Nama kategori harus berupa teks.',
            'categoryName.max' => 'Nama kategori tidak boleh lebih dari 100 karakter.',
            'categoryName.unique' => 'Nama kategori ini sudah digunakan, silakan pilih nama lain.',
        ];
    }

    public function save(CategoryService $categoryService)
    {
        $this->validate([
            'categoryName' => 'required|string|max:100|unique:categories,category,'.$this->category->id,
            'slug' => 'required|string|max:100|unique:categories,slug,'.$this->category->id,
        ]);

        $categoryService->updateCategory($this->category, $this->categoryName, $this->slug);

        session()->flash('message', 'Data kategori berhasil diperbarui.');

        return redirect()->route('admin.categories');
    }

    public function render()
    {
        return view('livewire.admin.category.edit-category');
    }
}
