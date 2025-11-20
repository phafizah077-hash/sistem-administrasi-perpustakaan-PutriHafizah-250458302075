<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Exports\LoansExport;
use Livewire\WithPagination;
use App\Services\LoanService;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Attributes\Layout; // <--- Pastikan baris ini ada

// Arahkan ke: resources/views/components/layouts/admin.blade.php
#[Layout('components.layouts.admin')]

class TransactionLoan extends Component
{
    use WithPagination;

    protected $loanService;

    public function boot(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function exportBorrowedLoans()
    {
        return Excel::download(new LoansExport, 'borrowed_loans.xlsx');
    }

    public function render()
    {
        return view('livewire.admin.transaction-loan', [
            'loans' => $this->loanService->getAllLoans()
        ]);
    }
}
