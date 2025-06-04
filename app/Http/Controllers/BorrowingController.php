<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    /**
     * Menampilkan form peminjaman buku
     */
    public function create(Request $request)
    {
        $books = Book::orderBy('title')->get();
        $selectedBook = null;
        $book_title = '';
        
        // Cek apakah ada parameter book_id dari halaman detail buku
        if ($request->has('book_id')) {
            $selectedBook = Book::find($request->book_id);
            if ($selectedBook) {
                $book_title = $selectedBook->title;
            } elseif ($request->has('book_title')) {
                $book_title = $request->book_title;
            }
        } elseif ($request->has('book_title')) {
            $book_title = $request->book_title;
        }
        
        return view('borrowings.create', compact('books', 'selectedBook', 'book_title'));
    }

    /**
     * Menyimpan data peminjaman buku baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'borrower_name' => 'required|string|max:255',
            'nisn' => 'required|string|max:20',
            'phone_number' => 'required|string|max:15',
            'book_title' => 'required|string|max:255',
            'book_number' => 'nullable|string|max:50',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrow_date',
            'book_id' => 'nullable|exists:books,id',
        ]);

        // Cari buku berdasarkan book_id jika tersedia, atau berdasarkan judul
        $book = null;
        if (!empty($validated['book_id'])) {
            $book = Book::find($validated['book_id']);
        }
        
        // Jika buku tidak ditemukan berdasarkan ID, coba cari berdasarkan judul
        if (!$book) {
            $book = Book::where('title', $validated['book_title'])->first();
        }
        
        $borrowing = new Borrowing();
        $borrowing->borrower_name = $validated['borrower_name'];
        $borrowing->nisn = $validated['nisn'];
        $borrowing->phone_number = $validated['phone_number'];
        $borrowing->book_title = $validated['book_title'];
        $borrowing->book_number = $validated['book_number'];
        $borrowing->borrow_date = $validated['borrow_date'];
        $borrowing->due_date = $validated['return_date'];
        $borrowing->return_date = null;
        
        if ($book) {
            $borrowing->book_id = $book->id;
            // Tambah jumlah peminjaman buku
            $book->borrow_count += 1;
            $book->save();
        }
        
        if (Auth::check()) {
            $borrowing->user_id = Auth::id();
        }
        
        $borrowing->save();

        return redirect()->route('borrowings.success');
    }

    /**
     * Menampilkan halaman sukses peminjaman
     */
    public function success()
    {
        return view('borrowings.success');
    }

    /**
     * Menampilkan daftar peminjaman untuk admin
     */
    public function index()
    {
        $borrowings = Borrowing::with(['book', 'user'])->orderBy('created_at', 'desc')->get();
        return view('admin.borrowings.index', compact('borrowings'));
    }
}
