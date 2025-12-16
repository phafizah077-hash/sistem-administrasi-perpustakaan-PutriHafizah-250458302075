<?php

namespace App\Livewire\Admin\Category;

use App\Services\CategoryService;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

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

    /**
     * Kustomisasi pesan error ke Bahasa Indonesia
     */
    public function messages()
    {
        return [
            // Pesan untuk Kategori
            'category.required' => 'Nama kategori wajib diisi.',
            'category.max' => 'Nama kategori maksimal 100 karakter.',
            'category.unique' => 'Nama kategori ini sudah ada, silakan gunakan nama lain.',
        ];
    }

    public function save(CategoryService $categoryService)
    {
        $this->validate();

        $categoryService->createCategory($this->category, $this->slug);

        // Flash message diterjemahkan
        session()->flash('message', 'Kategori baru berhasil ditambahkan.');

        return redirect()->route('admin.categories');
    }

    public function render()
    {
        return view('livewire.admin.category.create-category');
    }
}
