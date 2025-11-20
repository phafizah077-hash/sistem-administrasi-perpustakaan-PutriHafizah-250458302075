<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class LoanService
{
    public function getAllLoans()
    {
        return Loan::with(['user', 'book'])
            ->latest()
            ->paginate(10);
    }

    public function getLoanHistoryForUser(User $user): Collection
    {
        return $user->loans()->with('book')->latest()->get();
    }

    public function createLoan(int $userId, int $bookId, int $librarianId, int $loanDays = 7): Loan
    {
        $book = Book::findOrFail($bookId);

        if (!$book->isAvailable()) {
            throw new Exception('Buku tidak tersedia untuk dipinjam.');
        }

        // Decrement stock
        $book->decrement('stock');

        return Loan::create([
            'user_id' => $userId,
            'book_id' => $bookId,
            'librarian_id' => $librarianId,
            'loan_date' => Carbon::now(),
            'due_date' => Carbon::now()->addDays($loanDays),
            'status' => 'borrowed',
        ]);
    }

    public function returnLoan(Loan $loan): Loan
    {
        if ($loan->status === 'returned') {
            throw new Exception('Buku ini sudah dikembalikan sebelumnya.');
        }

        // Update loan status
        $loan->update([
            'status' => 'returned',
        ]);

        // Increment stock
        $loan->book->increment('stock');

        // Create a record in return_books table
        $loan->returnBook()->create([
            'librarian_id' => Auth::id(), // Assumes the authenticated user is the librarian
            'return_date' => Carbon::now(),
        ]);

        return $loan;
    }
}
