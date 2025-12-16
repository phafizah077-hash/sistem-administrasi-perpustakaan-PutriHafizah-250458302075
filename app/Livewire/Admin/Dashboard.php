<?php

namespace App\Livewire\Admin;

use App\Enums\Role;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Dashboard Admin - BookifyLibrary')]

class Dashboard extends Component
{
    public $userCount;

    public $authorCount;

    public $categoryCount;

    public $monthlyLoans;

    public $monthlyReturns;

    public $bookStatus;

    public function mount()
    {
        $this->userCount = User::where('role', Role::Anggota)->count();
        $this->authorCount = Author::count();
        $this->categoryCount = Category::count();

        $this->loadChartData();
    }

    private function loadChartData()
    {
        $months = [];
        $loansData = [];
        $returnsData = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->shortMonthName;

            $loansData[] = Loan::whereMonth('loan_date', $month->month)
                ->whereYear('loan_date', $month->year)
                ->count();

            $returnsData[] = Loan::whereMonth('updated_at', $month->month)
                ->whereYear('updated_at', $month->year)
                ->where('status', 'returned')
                ->count();
        }

        $this->monthlyLoans = [
            'labels' => $months,
            'data' => $loansData,
        ];

        $this->monthlyReturns = [
            'labels' => $months,
            'data' => $returnsData,
        ];

        $this->bookStatus = [
            'available' => Book::where('stock', '>', 0)->count(),
            'borrowed' => Loan::where('status', 'borrowed')->count(),
            'lost_damaged' => 0,
        ];
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
