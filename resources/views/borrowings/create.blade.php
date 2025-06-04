@extends('layouts.app')

@section('title', 'Pinjam Buku')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center mb-4">Forum Peminjaman Buku</h1>
        <hr class="mb-8">
        
        <div class="bg-gray-200 p-8 rounded-lg max-w-4xl mx-auto">
            <form method="POST" action="{{ route('borrowings.store') }}" class="space-y-6">
                @csrf
                
                <input type="hidden" name="book_id" value="{{ $selectedBook ? $selectedBook->id : request('book_id') }}">
                
                <div class="space-y-2">
                    <label for="borrower_name" class="block font-semibold">1. NAMA PEMINJAM</label>
                    <input type="text" name="borrower_name" id="borrower_name" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Nama" required value="{{ Auth::check() ? Auth::user()->name : '' }}">
                </div>
                
                <div class="space-y-2">
                    <label for="nisn" class="block font-semibold">2. NIS</label>
                    <input type="text" name="nisn" id="nisn" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="NIS" required value="{{ Auth::check() && Auth::user()->nisn ? Auth::user()->nisn : '' }}">
                </div>
                
                <div class="space-y-2">
                    <label for="phone_number" class="block font-semibold">3. NO. HANDPHONE</label>
                    <input type="text" name="phone_number" id="phone_number" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="No HP" required>
                </div>
                
                <div class="space-y-2">
                    <label for="book_title" class="block font-semibold">4. JUDUL BUKU</label>
                    <input type="text" name="book_title" id="book_title" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Judul" value="{{ $book_title }}" required>
                </div>
                
                <div class="space-y-2">
                    <label for="book_number" class="block font-semibold">5. NOMOR BUKU</label>
                    <input type="text" name="book_number" id="book_number" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Nmr Buku">
                </div>
                
                <div class="space-y-2">
                    <label for="borrow_date" class="block font-semibold">6. TANGGAL PINJAM</label>
                    <input type="date" name="borrow_date" id="borrow_date" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Tgl. Pjm" value="{{ date('Y-m-d') }}" required>
                </div>
                
                <div class="space-y-2">
                    <label for="return_date" class="block font-semibold">7. TANGGAL KEMBALI</label>
                    <input type="date" name="return_date" id="return_date" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Tgl. Kbl" value="{{ date('Y-m-d', strtotime('+7 days')) }}" required>
                    <p class="text-sm text-gray-500">*Batas waktu peminjaman 7 hari</p>
                </div>
                
                <div class="mt-8">
                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        PINJAM BUKU
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 