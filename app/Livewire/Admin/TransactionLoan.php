<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\LoanService;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]

class TransactionLoan extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $loanService;

    public function boot(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function render()
    {
        return view('livewire.admin.transaction-loan', [
            'loans' => $this->loanService->getAllLoans()
        ]);
    }
}
