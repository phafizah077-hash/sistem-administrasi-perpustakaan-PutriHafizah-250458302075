<?php

namespace App\Livewire\Admin;

use App\Exports\LoansExport;
use App\Models\Loan;
use App\Services\ReturnService;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

#[Layout('components.layouts.admin')]
class TransactionReturn extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $returnService;

    public function boot(ReturnService $returnService)
    {
        $this->returnService = $returnService;
    }

    public function processReturn($loanId)
    {
        $this->returnService->createReturn(['loan_id' => $loanId]);
        session()->flash('message', 'Buku berhasil dikembalikan.');
        $this->dispatch('bookReturned');
    }

    public function exportExcel()
    {
        $loans = Loan::where('status', 'borrowed')->latest()->get();

        return Excel::download(new LoansExport($loans), 'daftar-peminjaman-terkena-denda.xlsx');
    }

    public function render()
    {
        $loans = Loan::where('status', 'borrowed')->latest()->paginate(10);

        return view('livewire.admin.transaction-return', [
            'loans' => $loans,
        ]);
    }
}
