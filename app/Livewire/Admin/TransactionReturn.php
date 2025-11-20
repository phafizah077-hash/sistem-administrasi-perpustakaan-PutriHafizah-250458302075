<?php

namespace App\Livewire\Admin;

use App\Models\Loan;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\ReturnService;
use Livewire\Attributes\Layout; // <--- Pastikan baris ini ada

// Arahkan ke: resources/views/components/layouts/admin.blade.php
#[Layout('components.layouts.admin')]

class TransactionReturn extends Component
{
    use WithPagination;

    protected $returnService;

    public function boot(ReturnService $returnService)
    {
        $this->returnService = $returnService;
    }

    public function processReturn($loanId)
    {
        $this->returnService->createReturn(['loan_id' => $loanId]);
        session()->flash('message', 'Buku berhasil dikembalikan.');
    }



    public function render()
    {
        // Ambil data buku yang sedang dipinjam
        $loans = Loan::where('status', 'borrowed')->latest()->get();

        return view('livewire.admin.transaction-return', [
            'loans' => $loans, // <--- INI YANG HILANG TADI
            // 'returns' => ... (Kalau variabel ini tidak dipakai di tabel, hapus saja biar gak berat)
        ]);
    }
}
