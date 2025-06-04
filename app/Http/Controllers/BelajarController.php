<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BelajarController extends Controller
{
    /**
     * Menampilkan daftar buku belajar
     */
    public function index(Request $request)
    {
        // Daftar kategori untuk filter
        $categories = Category::orderBy('name')->get();
        
        // Filter berdasarkan kategori jika ada
        $categoryFilter = $request->kategori;
        
        $query = Book::query();
        
        // Filter berdasarkan tipe buku belajar
        $query->where('type', 'belajar');
        
        if ($categoryFilter && $categoryFilter != 'all') {
            // Filter berdasarkan kategori spesifik
            $query->whereHas('category', function($q) use ($categoryFilter) {
                $q->where('slug', $categoryFilter);
            });
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
        
        // Paginate hasil
        $books = $query->paginate(8);
        
        return view('booklist.index', compact('books', 'categories', 'categoryFilter', 'sort'));
    }
} 