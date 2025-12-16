<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class BookService
{
    /**
     * Mengambil daftar buku dengan filter pencarian dan kategori.
     */
    public function getFilteredBooks(string $search, ?int $categoryId)
    {
        return Book::with(['author', 'category'])
            // Logic Search
            ->when($search, function ($query, $search) {
                $query->where(function (Builder $q) use ($search) {
                    $q->where('title', 'like', '%'.$search.'%')
                        ->orWhere('isbn', 'like', '%'.$search.'%')
                        ->orWhereHas('author', function ($subQ) use ($search) {
                            $subQ->where('author', 'like', '%'.$search.'%');
                        });
                });
            })
            // Logic Filter Kategori
            ->when($categoryId, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->latest()
            ->paginate(12);
    }

    // ... method lain (getPaginatedBooks, createBook, dll) biarkan saja seperti semula ...
    public function getPaginatedBooks(
        ?string $searchQuery = null,
        ?int $categoryId = null,
        ?int $authorId = null,
        ?int $publicationYear = null,
        int $perPage = 12
    ): LengthAwarePaginator {
        $books = Book::with(['author', 'category'])->latest();

        if ($searchQuery) {
            $books->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', '%'.$searchQuery.'%')
                    ->orWhereHas('author', function ($q) use ($searchQuery) {
                        $q->where('author', 'like', '%'.$searchQuery.'%');
                    })
                    ->orWhereHas('category', function ($q) use ($searchQuery) {
                        $q->where('category', 'like', '%'.$searchQuery.'%');
                    });
            });
        }

        if ($categoryId) {
            $books->where('category_id', $categoryId);
        }

        if ($authorId) {
            $books->where('author_id', $authorId);
        }

        if ($publicationYear) {
            $books->where('publication_year', $publicationYear);
        }

        return $books->paginate($perPage);
    }

    public function createBook(array $data): Book
    {
        return Book::create($data);
    }

    public function updateBook(Book $book, array $data): Book
    {
        $book->update($data);

        return $book;
    }

    public function deleteBook(Book $book): void
    {
        $book->delete();
    }
}
