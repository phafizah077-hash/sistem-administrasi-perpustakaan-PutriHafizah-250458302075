<?php

namespace App\Livewire\Member;

use App\Models\Loan;
use App\Services\RatingService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LoanHistory extends Component
{
    use WithPagination;

    public bool $showModal = false;
    public ?Loan $selectedLoan = null;
    public int $rating = 0;
    public string $comment = '';

    public function openReviewModal($loanId)
    {
        $this->selectedLoan = Loan::with('book.ratings.review')->findOrFail($loanId);

        // Cek jika sudah ada rating sebelumnya
        $existingRating = $this->selectedLoan->book->ratings()
            ->where('user_id', Auth::id())
            ->first();

        if ($existingRating) {
            $this->rating = $existingRating->rating;
            $this->comment = $existingRating->review->comment ?? '';
        } else {
            $this->rating = 0;
            $this->comment = '';
        }

        $this->showModal = true;
    }

    public function saveReview(RatingService $ratingService)
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10',
        ]);

        if ($this->selectedLoan) {
            $ratingService->createOrUpdateRating(
                $this->selectedLoan->book,
                $this->rating,
                $this->comment
            );

            session()->flash('message', 'Ulasan berhasil disimpan.');
            $this->closeModal();
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['selectedLoan', 'rating', 'comment']);
    }

    public function render()
    {
        $loans = Loan::where('user_id', Auth::id())
            ->with(['book', 'book.ratings' => function ($query) {
                $query->where('user_id', Auth::id());
            }])
            ->latest()
            ->paginate(10);

        return view('livewire.member.loan-history', [
            'loans' => $loans,
        ]);
    }
}
