<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller
{
    public function index()
    {
        // Mengambil statistik
        $totalBooks = Book::count();
        $totalBorrowCount = Book::sum('borrow_count');
        
        // Menghitung total kunjungan dari semua peminjaman
        $totalVisits = Borrowing::count();
        
        // Mengambil 5 buku pelajaran terbaru
        $educationalBooks = Book::whereNotNull('education_level')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        // Mengambil 5 buku fiksi terbaru    
        $fictionBooks = Book::whereNotNull('fiction_category')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('welcome', [
            'totalBooks' => $totalBooks,
            'totalBorrowCount' => $totalBorrowCount,
            'totalVisits' => $totalVisits,
            'educationalBooks' => $educationalBooks,
            'fictionBooks' => $fictionBooks
        ]);
    }
} 