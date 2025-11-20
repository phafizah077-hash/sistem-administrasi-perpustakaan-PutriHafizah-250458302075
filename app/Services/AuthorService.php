<?php

namespace App\Services;

use App\Models\Author;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthorService
{
    public function getPaginatedAuthors(?string $searchQuery = null, int $perPage = 10): LengthAwarePaginator
    {
        $authors = Author::query();

        if ($searchQuery) {
            $authors->where('author', 'like', '%' . $searchQuery . '%');
        }

        return $authors->latest()->paginate($perPage);
    }

    public function createAuthor(string $authorName): Author
    {
        return Author::create(['author' => $authorName]);
    }

    public function updateAuthor(Author $author, string $authorName): Author
    {
        $author->update(['author' => $authorName]);
        return $author;
    }

    public function deleteAuthor(Author $author): void
    {
        $author->delete();
    }
}
