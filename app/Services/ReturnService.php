<?php

namespace App\Services;

use App\Models\Loan;
use App\Models\ReturnBook;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 

class ReturnService
{
    public function getAllReturns()
    {
        return ReturnBook::with(['loan.user', 'loan.book'])->latest()->paginate(10);
    }

    public function createReturn(array $data): ReturnBook
    {
        if (!isset($data['loan_id'])) {
            throw new \InvalidArgumentException("Loan ID diperlukan untuk proses pengembalian.");
        }

        return DB::transaction(function () use ($data) {
            $loan = Loan::findOrFail($data['loan_id']);

            $librarianId = Auth::check() ? Auth::id() : null; 
            
            if (!$librarianId) {

            }

            $return = ReturnBook::create([
                'loan_id' => $loan->id,
                'librarian_id' => $librarianId, 
                'return_date' => now(),
                'notes' => $data['notes'] ?? null,
            ]);

            $loan->book->increment('stock');
            $loan->status = 'returned';
            $loan->save();

            return $return;
        });
    }
}