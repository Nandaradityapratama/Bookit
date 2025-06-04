<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    /**
     * Menampilkan daftar novel
     */
    public function index(Request $request)
    {
        // Daftar kategori untuk filter (hanya kategori novel)
        $categories = [
            'romance' => 'Romance',
            'drama' => 'Drama',
            'non-fiction' => 'Non-Fiksi',
            'fiction' => 'Fiksi',
            'action' => 'Action',
            'self-improvement' => 'Self Improvement'
        ];
        
        // Filter berdasarkan genre jika ada
        $categoryFilter = $request->genre;
        
        $query = Book::query();
        
        // Filter berdasarkan tipe novel
        $query->where('type', 'fiction');
        
        if ($categoryFilter && $categoryFilter != 'all') {
            // Filter berdasarkan kategori spesifik
            $query->where('fiction_category', $categoryFilter);
        }
        
        // Sort berdasarkan parameter
        $sort = $request->sort ?? 'recommended';
        
        switch ($sort) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'recommended':
            default:
                $query->orderBy('borrow_count', 'desc');
                break;
        }
        
        // Paginate hasil dengan lebih banyak item per halaman
        $books = $query->paginate(8);
        
        return view('novels.index', compact('books', 'categories', 'categoryFilter', 'sort'));
    }
}
