<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function index()
    {
        // Ambil buku dengan jumlah peminjaman terbanyak (kecuali buku pelajaran)
        $books = Book::select(
                'books.id',
                'books.title',
                'books.description',
                'books.author',
                'books.image_path',
                'books.type',
                'books.education_level',
                'books.grade',
                'books.curriculum',
                'books.fiction_category',
                'books.pdf_path',
                'books.pages',
                'books.publication_year',
                'books.borrow_count',
                DB::raw('COUNT(borrowings.id) as total_borrows')
            )
            ->leftJoin('borrowings', 'books.id', '=', 'borrowings.book_id')
            ->where('books.type', '!=', 'textbook')
            ->groupBy(
                'books.id',
                'books.title',
                'books.description',
                'books.author',
                'books.image_path',
                'books.type',
                'books.education_level',
                'books.grade',
                'books.curriculum',
                'books.fiction_category',
                'books.pdf_path',
                'books.pages',
                'books.publication_year',
                'books.borrow_count'
            )
            ->orderBy('total_borrows', 'desc')
            ->limit(10)
            ->get();

        return view('ranking', compact('books'));
    }
} 