<?php

namespace App\Services;

use App\Models\Loan;
use App\Models\ReturnBook;
use Illuminate\Support\Facades\DB;

class ReturnService
{
    public function getAllReturns()
    {
        return ReturnBook::with(['loan.user', 'loan.book'])->latest()->paginate(10);
    }

    public function createReturn(array $data): ReturnBook
    {
        return DB::transaction(function () use ($data) {
            $loan = Loan::findOrFail($data['loan_id']);

            $return = ReturnBook::create([
                'loan_id' => $loan->id,
                'return_date' => now(),
                'notes' => $data['notes'] ?? null,
            ]);

            $loan->book->increment('stock');
            $loan->update(['status' => 'returned']);

            return $return;
        });
    }

    public function getReturnById(string $id): ReturnBook
    {
        return ReturnBook::with(['loan.user', 'loan.book'])->findOrFail($id);
    }
}