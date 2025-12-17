<?php

namespace App\Livewire\Admin\Loan;

use App\Models\Book;
use App\Models\User;
use App\Services\LoanService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class CreateLoan extends Component
{
    public $userId = '';

    public $bookId = '';

    public $loanDays = 7;

    public $searchUser = '';

    public $searchBook = '';

    protected function rules()
    {
        return [
            'userId' => 'required|exists:users,id',
            'bookId' => 'required|exists:books,id',
            'loanDays' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'userId.required' => 'Nama Peminjam wajib dipilih.',
            'userId.exists' => 'Data peminjam tidak valid.',

            'bookId.required' => 'Judul Buku wajib dipilih.',
            'bookId.exists' => 'Data buku tidak valid.',

            'loanDays.required' => 'Durasi peminjaman wajib diisi.',
            'loanDays.min' => 'Durasi minimal 1 hari.',
        ];
    }

    public function save(LoanService $loanService)
    {
        $this->validate();

        try {
            $loanService->createLoan(
                $this->userId,
                $this->bookId,
                Auth::id(),
                $this->loanDays
            );

            session()->flash('message', 'Peminjaman berhasil dibuat.');

            return $this->redirect(route('admin.loans'), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function selectUser($id, $name)
    {
        $this->userId = $id;
        $this->searchUser = $name;
        $this->resetValidation('userId');
    }

    public function selectBook($id, $title)
    {
        $this->bookId = $id;
        $this->searchBook = $title;
        $this->resetValidation('bookId');
    }

    public function render()
    {
        $users = User::where('role', 'Anggota')
            ->when($this->searchUser, function ($query) {
                $query->where('name', 'like', '%'.$this->searchUser.'%');
            })
            ->take(10)
            ->get();

        $books = Book::where('stock', '>', 0)
            ->when($this->searchBook, function ($query) {
                $query->where('title', 'like', '%'.$this->searchBook.'%');
            })
            ->take(10)
            ->get();

        return view('livewire.admin.loan.create-loan', [
            'users' => $users,
            'books' => $books,
        ]);
    }
}
