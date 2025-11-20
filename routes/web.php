<?php

use Livewire\Volt\Volt;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Member\LoanHistory;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Admin\Book\EditBook;
use App\Livewire\Admin\BookManajemen;
use App\Livewire\Admin\User\EditUser;
use App\Livewire\Admin\UserManajemen;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AuthorManajemen;
use App\Livewire\Admin\Book\CreateBook;
use App\Livewire\Admin\Loan\CreateLoan;
use App\Livewire\Admin\TransactionLoan;
use App\Livewire\Admin\User\CreateUser;
use App\Livewire\Admin\Author\EditAuthor;
use App\Livewire\Admin\CategoryManajemen;
use App\Livewire\Admin\TransactionReturn;
use App\Livewire\Admin\Author\CreateAuthor;
use App\Livewire\Admin\Category\EditCategory;
use App\Livewire\Admin\Category\CreateCategory;

Route::get('/', function () {
    // Jika user sudah login, lempar ke dashboard admin
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    }

    // Jika belum login, tampilkan halaman welcome
    return view('welcome');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

//================
// Public Routes
//================
Route::get('/', function () {
    return view('welcome');
})->name('home');

Volt::route('/books', 'public.book-search')->name('books.search');
Volt::route('/books/{id}', 'public.book-detail')->name('books.detail');


//================
// Member Routes
//================
Route::prefix('dashboard')->middleware(['auth', 'verified', 'role:Anggota'])->name('member.')->group(function () {
    Volt::route('/', 'member.dashboard')->name('dashboard');
    Route::get('/loans', LoanHistory::class)->name('loans.history');;
});



// Admin
Route::prefix('admin')->middleware(['auth', 'verified', 'role:Pustakawan'])->name('admin.')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Transaksi
    Route::get('/loans', TransactionLoan::class)->name('loans');
    Route::get('/loans/create', CreateLoan::class)->name('loans.create');
    Route::get('/loans/{loan}', function ($loan) {
        return view('livewire.admin.loan.show', compact('loan'));
    })->name('loans.show');

    Route::get('/returns', TransactionReturn::class)->name('returns');
    Route::get('/returns/{return}', function ($return) {
        return view('livewire.admin.return.show', compact('return'));
    })->name('returns.show');

    // CRUD
    // user
    Route::get('/users', UserManajemen::class)->name('users');
    Route::get('/users/create', CreateUser::class)->name('users.create');
    Route::get('/users/{user}/edit', EditUser::class)->name('users.edit');

    // book
    Route::get('/books', BookManajemen::class)->name('books');
    Route::get('/books/create', CreateBook::class)->name('books.create');
    Route::get('/books/{book}/edit', EditBook::class)->name('books.edit');

    // author
    Route::get('/authors', AuthorManajemen::class)->name('authors');
    Route::get('/authors/create', CreateAuthor::class)->name('authors.create');
    Route::get('/authors/{author}/edit', EditAuthor::class)->name('authors.edit');

    // category
    Route::get('/categories', CategoryManajemen::class)->name('categories');
    Route::get('/categories/create', CreateCategory::class)->name('categories.create');
    Route::get('/categories/{category}/edit', EditCategory::class)->name('categories.edit');
});

require __DIR__ . '/auth.php';
