<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;

class CategoryController extends Controller
{
    /**
     * Menampilkan buku berdasarkan kategori
     */
    public function show($slug, Request $request)
    {
        // Khusus untuk kategori khusus SMP, SMA, dan Kejuruan
        if ($slug === 'smp') {
            $query = Book::query()
                ->where('type', 'textbook')
                ->where('education_level', 'smp');
            
            // Filter berdasarkan kelas jika ada
            if ($request->grade && $request->grade !== 'all') {
                $query->where('grade', $request->grade);
            }
            
            // Filter berdasarkan mata pelajaran
            if ($request->subject && $request->subject !== 'all') {
                $query->where('subject', $request->subject);
            }
            
            // Urutkan buku
            $books = $query->orderBy('grade')
                ->orderBy('title')
                ->get();
                
            return view('category.smp', compact('books'));
        } elseif ($slug === 'sma') {
            // Ambil buku untuk SMA
            $query = Book::query()
                ->where('type', 'textbook')
                ->where('education_level', 'sma');
                
            // Filter berdasarkan kelas jika ada
            if ($request->grade && $request->grade !== 'all') {
                $query->where('grade', $request->grade);
            }
            
            // Filter berdasarkan mata pelajaran
            if ($request->subject && $request->subject !== 'all') {
                $query->where('subject', $request->subject);
            }
            
            // Urutkan buku
            $books = $query->orderBy('grade')
                ->orderBy('title')
                ->get();
                
            return view('category.sma', compact('books'));
        } elseif ($slug === 'kejuruan') {
            return view('category.kejuruan');
        }

        // Untuk kategori lainnya
        $category = Category::where('slug', $slug)->firstOrFail();
        $query = Book::where('category_id', $category->id)
            ->orderBy('borrow_count', 'desc');

        // Filter berdasarkan kelas
        if ($request->filled('grade')) {
            $query->where('grade', $request->grade);
        }

        // Filter berdasarkan mata pelajaran
        if ($request->filled('subject')) {
            $query->where('subject', $request->subject);
        }

        $books = $query->paginate(20)
            ->withQueryString();
        
        return view('category.show', [
            'category' => $category,
            'books' => $books
        ]);
    }
}
