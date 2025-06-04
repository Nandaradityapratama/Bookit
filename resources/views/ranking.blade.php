@extends('layouts.app')

@section('content')
<main class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900">Book Ranking</h1>
            <p class="text-lg text-gray-700">Buku Terpopuler Berdasarkan Jumlah Peminjaman</p>
        </div>

        @if(count($books) > 0)
        <!-- Top 3 Books - Cards in Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- Book 1 -->
            <div class="flex flex-col items-center">
                <div class="relative">
                    <div class="absolute -left-4 -top-4 flex items-center justify-center w-16 h-16 bg-rose-400 rounded-lg text-white font-bold text-2xl">
                        1
                    </div>
                    <img src="{{ Storage::url($books[0]->image_path) ?? '/images/books/placeholder.jpg' }}" alt="{{ $books[0]->title ?? 'Book Cover' }}" class="w-full h-64 object-cover rounded-lg">
                </div>
                <h3 class="mt-4 font-bold text-gray-900">{{ $books[0]->title ?? 'Judul Buku' }}</h3>
                <p class="text-sm text-gray-600 mt-1">{{ $books[0]->type == 'novel' ? 'Novel' : 'Buku Pelajaran' }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $books[0]->total_borrows ?? '0' }} kali dipinjam</p>
                <a href="{{ $books[0]->type == 'novel' ? route('books.show', $books[0]->id) : route('books.show', $books[0]->id) }}" class="mt-2 px-6 py-1 bg-rose-400 text-white font-medium rounded-full inline-block text-center">
                    LIHAT
                </a>
            </div>
            
            @if(count($books) > 1)
            <!-- Book 2 -->
            <div class="flex flex-col items-center">
                <div class="relative">
                    <div class="absolute -left-4 -top-4 flex items-center justify-center w-16 h-16 bg-rose-400 rounded-lg text-white font-bold text-2xl">
                        2
                    </div>
                    <img src="{{ Storage::url($books[1]->image_path) ?? '/images/books/placeholder.jpg' }}" alt="{{ $books[1]->title ?? 'Book Cover' }}" class="w-full h-64 object-cover rounded-lg">
                </div>
                <h3 class="mt-4 font-bold text-gray-900">{{ $books[1]->title ?? 'Judul Buku' }}</h3>
                <p class="text-sm text-gray-600 mt-1">{{ $books[1]->type == 'novel' ? 'Novel' : 'Buku Pelajaran' }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $books[1]->total_borrows ?? '0' }} kali dipinjam</p>
                <a href="{{ $books[1]->type == 'novel' ? route('books.show', $books[1]->id) : route('books.show', $books[1]->id) }}" class="mt-2 px-6 py-1 bg-rose-400 text-white font-medium rounded-full inline-block text-center">
                    LIHAT
                </a>
            </div>
            @endif
            
            @if(count($books) > 2)
            <!-- Book 3 -->
            <div class="flex flex-col items-center">
                <div class="relative">
                    <div class="absolute -left-4 -top-4 flex items-center justify-center w-16 h-16 bg-rose-400 rounded-lg text-white font-bold text-2xl">
                        3
                    </div>
                    <img src="{{ Storage::url($books[2]->image_path) ?? '/images/books/placeholder.jpg' }}" alt="{{ $books[2]->title ?? 'Book Cover' }}" class="w-full h-64 object-cover rounded-lg">
                </div>
                <h3 class="mt-4 font-bold text-gray-900">{{ $books[2]->title ?? 'Judul Buku' }}</h3>
                <p class="text-sm text-gray-600 mt-1">{{ $books[2]->type == 'novel' ? 'Novel' : 'Buku Pelajaran' }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $books[2]->total_borrows ?? '0' }} kali dipinjam</p>
                <a href="{{ $books[2]->type == 'novel' ? route('books.show', $books[2]->id) : route('books.show', $books[2]->id) }}" class="mt-2 px-6 py-1 bg-rose-400 text-white font-medium rounded-full inline-block text-center">
                    LIHAT
                </a>
            </div>
            @endif
        </div>

        @if(count($books) > 3)
            @for($i = 3; $i < count($books); $i++)
            <!-- Book {{ $i + 1 }} - Horizontal Card -->
            <div class="flex flex-col md:flex-row bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 mb-8 overflow-hidden border border-gray-100">
                <div class="flex">
                    <div class="flex items-center justify-center w-20 bg-rose-200 text-gray-800 font-bold text-4xl p-4">
                        {{ $i + 1 }}
                    </div>
                    <div class="relative w-40 h-full">
                        <img src="{{ Storage::url($books[$i]->image_path) ?? '/images/books/placeholder.jpg' }}" alt="{{ $books[$i]->title ?? 'Book Cover' }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105 absolute inset-0">
                    </div>
                </div>
                <div class="p-6 flex flex-col justify-between flex-grow">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $books[$i]->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $books[$i]->type == 'novel' ? 'Novel' : 'Buku Pelajaran' }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $books[$i]->total_borrows ?? '0' }} kali dipinjam</p>
                        <div class="mt-3 bg-white bg-opacity-70 p-3 rounded-lg">
                            <p class="text-sm text-gray-700 line-clamp-3">
                                {{ $books[$i]->description }}
                            </p>
                        </div>
                    </div>
                    <div class="text-right mt-4">
                        <a href="{{ $books[$i]->type == 'novel' ? route('books.show', $books[$i]->id) : route('books.show', $books[$i]->id) }}" class="px-6 py-2 bg-rose-400 hover:bg-rose-500 transition-all duration-300 text-white font-medium rounded-full inline-block shadow-sm hover:shadow">
                            LIHAT
                        </a>
                    </div>
                </div>
            </div>
            @endfor
        @endif
        @else
        <div class="text-center py-12">
            <p class="text-gray-500">Belum ada buku yang dipinjam</p>
        </div>
        @endif
    </div>
</main>
@endsection 