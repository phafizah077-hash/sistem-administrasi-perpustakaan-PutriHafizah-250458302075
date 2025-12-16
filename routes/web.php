<?php

use App\Livewire\Admin\Author\CreateAuthor;
use App\Livewire\Admin\Author\EditAuthor;
use App\Livewire\Admin\AuthorManajemen;
use App\Livewire\Admin\Book\CreateBook;
use App\Livewire\Admin\Book\EditBook;
use App\Livewire\Admin\BookManajemen;
use App\Livewire\Admin\Category\CreateCategory;
use App\Livewire\Admin\Category\EditCategory;
use App\Livewire\Admin\CategoryManajemen;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Loan\CreateLoan;
use App\Livewire\Admin\TransactionLoan;
use App\Livewire\Admin\TransactionReturn;
use App\Livewire\Admin\User\CreateUser;
use App\Livewire\Admin\User\EditUser;
use App\Livewire\Admin\UserManajemen;
use App\Livewire\Member\LoanHistory;
use App\Livewire\Member\Profile;
use App\Livewire\Public\BookDetail;
use App\Livewire\Public\HomePage;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// PUBLIC
Route::get('/', HomePage::class)->name('home');
Route::get('/book/{id}', BookDetail::class)->name('books.detail');

// ROUTE UNTUK MENGUJI NOTIFIKASI
Route::get('/trigger-notifications', function () {
    if (! Auth::check()) {
        return redirect('/login')->with('error', 'Harap login sebagai pustakawan untuk menguji notifikasi.');
    }

    $service = app(NotificationService::class);

    $countDue3 = $service->sendDueDateWarnings(3);
    $countOverdue = $service->sendOverdueAlerts();

    return '✅ Notifikasi Sukses Dipicu:<br>'
        ."- Peringatan H-3: {$countDue3} notifikasi<br>"
        ."- Keterlambatan: {$countOverdue} notifikasi<br>"
        ."Silakan cek tabel 'notifications' dan halaman anggota Anda.";
})->middleware(['auth', 'role:Pustakawan'])->name('test.notifications');

// AUTH
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Anggota
Route::prefix('member')
    ->middleware(['auth', 'verified', 'role:Anggota'])
    ->name('member.')
    ->group(function () {
        Route::get('/loans', LoanHistory::class)->name('loans.history');
        Route::get('/profile', Profile::class)->name('profile');
    });

// Pustakawan
Route::prefix('admin')
    ->middleware(['auth', 'verified', 'role:Pustakawan'])
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        Route::get('/loans', TransactionLoan::class)->name('loans');
        Route::get('/loans/create', CreateLoan::class)->name('loans.create');

        Route::get('/returns', TransactionReturn::class)->name('returns');

        Route::get('/users', UserManajemen::class)->name('users');
        Route::get('/users/create', CreateUser::class)->name('users.create');
        Route::get('/users/{user}/edit', EditUser::class)->name('users.edit');

        Route::get('/books', BookManajemen::class)->name('books');
        Route::get('/books/create', CreateBook::class)->name('books.create');
        Route::get('/books/{book}/edit', EditBook::class)->name('books.edit');

        Route::get('/authors', AuthorManajemen::class)->name('authors');
        Route::get('/authors/create', CreateAuthor::class)->name('authors.create');
        Route::get('/authors/{author}/edit', EditAuthor::class)->name('authors.edit');

        Route::get('/categories', CategoryManajemen::class)->name('categories');
        Route::get('/categories/create', CreateCategory::class)->name('categories.create');
        Route::get('/categories/{category}/edit', EditCategory::class)->name('categories.edit');
    });

// --- RUTE JEMBATAN (DIPERBAIKI) ---
Route::get('/dashboard', function () {
    $user = Auth::user();

    // Jika Pustakawan -> Masuk Dashboard Admin
    if ($user->role === 'Pustakawan') {
        return redirect()->route('admin.dashboard');
    }

    // Jika Anggota -> Masuk ke HOME (Landing Page)
    // Supaya bisa langsung lihat buku, bukan lihat profil
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');
// ----------------------------------

require __DIR__.'/auth.php';
