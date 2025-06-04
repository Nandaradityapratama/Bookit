<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class StudyBookController extends Controller
{
    /**
     * Menampilkan halaman detail buku belajar
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        
        // Mendapatkan buku terkait berdasarkan level pendidikan dan kelas yang sama
        $relatedBooks = Book::where('id', '!=', $book->id)
            ->where('type', 'textbook')
            ->where('education_level', $book->education_level)
            ->where('grade', $book->grade)
            ->orderBy('borrow_count', 'desc')
            ->take(3)
            ->get();
            
        // Jika tidak cukup buku dari level dan kelas yang sama, tambahkan buku lain dari level yang sama
        if ($relatedBooks->count() < 3) {
            $moreBooks = Book::where('id', '!=', $book->id)
                ->where('type', 'textbook')
                ->where('education_level', $book->education_level)
                ->whereNotIn('id', $relatedBooks->pluck('id'))
                ->orderBy('borrow_count', 'desc')
                ->take(3 - $relatedBooks->count())
                ->get();
            
            $relatedBooks = $relatedBooks->concat($moreBooks);
        }
        
        return view('study.book-detail', [
            'book' => $book,
            'relatedBooks' => $relatedBooks
        ]);
    }

    /**
     * Menampilkan PDF buku
     */
    public function readPdf($id)
    {
        $book = Book::findOrFail($id);
        
        // Jika PDF tidak ada, kembalikan ke halaman detail dengan pesan error
        if (!$book->pdf_path) {
            return redirect()->route('study.book.detail', $id)
                ->with('error', 'PDF buku tidak tersedia.');
        }
        
        // Menambah jumlah baca
        $book->borrow_count = $book->borrow_count + 1;
        $book->save();
        
        // Tampilkan PDF di browser
        return view('study.book-pdf', [
            'book' => $book
        ]);
    }

    public function pdf(Book $book)
    {
        return view('study.book-pdf', [
            'book' => $book
        ]);
    }
}
