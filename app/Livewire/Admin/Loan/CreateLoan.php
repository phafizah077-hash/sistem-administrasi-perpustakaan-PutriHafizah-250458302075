<?php

namespace App\Livewire\Admin\Loan;

use App\Models\Book;
use App\Models\User;
use Livewire\Component;
use App\Services\LoanService;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout; // <--- Pastikan baris ini ada

// Arahkan ke: resources/views/components/layouts/admin.blade.php
#[Layout('components.layouts.admin')]

class CreateLoan extends Component
{

     #[Rule('required|exists:users,id')]
    public $userId = '';

    #[Rule('required|exists:books,id')]
    public $bookId = '';

    #[Rule('required|integer|min:1')]
    public $loanDays = 7;

    public $users;
    public $books;

    public function mount()
    {
        $this->users = User::where('role', 'Anggota')->get();
        $this->books = Book::where('stock', '>', 0)->get();
    }

    public function save(LoanService $loanService)
    {
        $this->validate();

        try {
            $loanService->createLoan(
                $this->userId,
                $this->bookId,
                Auth::id(), // Librarian ID
                $this->loanDays
            );

            session()->flash('message', 'Peminjaman berhasil dibuat.');
            return $this->redirect(route('admin.loans'), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.loan.create-loan');
    }
}
