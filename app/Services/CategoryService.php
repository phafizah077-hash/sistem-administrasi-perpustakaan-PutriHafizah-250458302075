<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class CategoryService
{
    public function getPaginatedCategories(?string $searchQuery = null, int $perPage = 10): LengthAwarePaginator
    {
        $categories = Category::query();

        if ($searchQuery) {
            $categories->where('category', 'like', '%' . $searchQuery . '%');
        }

        return $categories->latest()->paginate($perPage);
    }

    public function createCategory(string $categoryName, string $slug): Category
    {
        return Category::create([
            'category' => $categoryName,
            'slug' => $slug,
        ]);
    }

    public function updateCategory(Category $category, string $categoryName, string $slug): Category
    {
        $category->update([
            'category' => $categoryName,
            'slug' => $slug,
        ]);
        return $category;
    }

    public function deleteCategory(Category $category): void
    {
        $category->delete();
    }
}
