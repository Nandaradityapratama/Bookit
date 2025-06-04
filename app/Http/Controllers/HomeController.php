<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Visit;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $totalBorrowCount = Borrowing::count();
        $totalBooks = Book::count();
        
        // Hitung total kunjungan berdasarkan user yang login
        $totalVisits = Visit::where('user_id', Auth::id())->count();

        // Ambil buku pelajaran
        $educationalBooks = Book::where('type', 'book')
            ->orderBy('borrow_count', 'desc')
            ->take(5)
            ->get();

        // Ambil buku non-fiksi
        $fictionBooks = Book::where('type', 'novel')
            ->orderBy('borrow_count', 'desc')
            ->take(5)
            ->get();

        return view('welcome', compact(
            'totalBorrowCount',
            'totalBooks',
            'totalVisits',
            'educationalBooks',
            'fictionBooks'
        ));
    }
} 