<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\BelajarController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StudyBookController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::middleware(['web'])->group(function () {
    Route::get('/', [WelcomeController::class, 'index'])->name('home');
    Route::get('/about', function () {
        return view('about');
    })->name('about');
});

// Protected Routes (Require Authentication)
Route::middleware(['auth', 'web'])->group(function () {
    // Booklist Routes
    Route::get('/booklist', [BelajarController::class, 'index'])->name('booklist.index');

    // Novel Routes
    Route::get('/novels', [NovelController::class, 'index'])->name('novels.index');

    // Category Routes
    Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

    // Book Routes
    Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
    Route::get('/books/{id}/read-pdf', [BookController::class, 'readPdf'])->name('books.read-pdf');

    // Study Book Routes
    Route::get('/study/book/{id}', [StudyBookController::class, 'show'])->name('study.book.detail');
    Route::get('/study/book/{id}/read', [StudyBookController::class, 'readPdf'])->name('study.book.read');
    Route::get('/study/book/{book}/pdf', [StudyBookController::class, 'pdf'])->name('study.book.pdf');

    // Borrowing Routes
    Route::get('/borrowings/create', [BorrowingController::class, 'create'])->name('borrowings.create');
    Route::post('/borrowings', [BorrowingController::class, 'store'])->name('borrowings.store');
    Route::get('/borrowings/success', [BorrowingController::class, 'success'])->name('borrowings.success');

    // Ranking Route
    Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');
});

require __DIR__.'/auth.php';
