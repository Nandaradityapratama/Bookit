@extends('layouts.app')

@section('title', $book->title . ' - BookIt')

@push('styles')
<style>
    .book-cover {
        height: 400px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }
    .book-cover:hover {
        transform: scale(1.02);
    }
    .book-info {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    }
    .book-tag {
        background-color: #e9f5fe;
        color: #0073e6;
        font-size: 0.8rem;
        border-radius: 50px;
        padding: 0.25rem 0.75rem;
        transition: all 0.2s;
    }
    .book-tag:hover {
        background-color: #0073e6;
        color: white;
    }
    .read-button {
        background-color: #002358;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        padding: 0.75rem 2rem;
        transition: all 0.3s;
    }
    .read-button:hover {
        background-color: #003380;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 35, 88, 0.3);
    }
    .breadcrumb-item {
        transition: color 0.2s;
    }
    .breadcrumb-item:hover {
        color: #0073e6;
    }
    .chapter-item {
        padding: 0.75rem;
        border-radius: 8px;
        transition: background-color 0.2s;
    }
    .chapter-item:hover {
        background-color: #f3f8ff;
    }
</style>
@endpush

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <div class="mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2 md:space-x-4">
                    <li class="inline-flex items-center">
                        <a href="{{ route('booklist.index') }}" class="breadcrumb-item text-gray-700 hover:text-blue-600 text-sm md:text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a href="{{ route('category.show', $book->category ? $book->category->slug : 'smp') }}" class="breadcrumb-item text-gray-700 hover:text-blue-600 ml-1 md:ml-2 text-sm md:text-base">
                                {{ $book->category ? $book->category->name : 'Kategori' }}
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="text-blue-600 ml-1 md:ml-2 text-sm md:text-base font-medium">{{ $book->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Book Cover Image -->
            <div class="md:col-span-1">
                <img src="{{ $book->image_path ?? asset('images/books/matematika.jpg') }}" alt="{{ $book->title }}" class="book-cover w-full">
                
                <div class="mt-6 bg-white p-4 rounded-lg shadow">
                    <h3 class="font-semibold text-gray-800 mb-2">Informasi Buku</h3>
                    <ul class="space-y-2">
                        <li class="flex justify-between text-sm">
                            <span class="text-gray-600">Penerbit:</span>
                            <span class="font-medium">{{ $book->publisher ?? 'Kemendikbud' }}</span>
                        </li>
                        <li class="flex justify-between text-sm">
                            <span class="text-gray-600">Tahun Terbit:</span>
                            <span class="font-medium">{{ $book->publication_year ?? '2022' }}</span>
                        </li>
                        <li class="flex justify-between text-sm">
                            <span class="text-gray-600">Kurikulum:</span>
                            <span class="font-medium">{{ $book->curriculum ?? 'Merdeka' }}</span>
                        </li>
                        <li class="flex justify-between text-sm">
                            <span class="text-gray-600">Jumlah Halaman:</span>
                            <span class="font-medium">{{ $book->page_count ?? '240' }}</span>
                        </li>
                        <li class="flex justify-between text-sm">
                            <span class="text-gray-600">Status:</span>
                            <span class="font-medium text-green-600">Tersedia</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Book Info -->
            <div class="md:col-span-2 book-info p-8">
                <div class="flex flex-wrap gap-2 mb-4">
                    @if($book->category)
                        <span class="book-tag">{{ $book->category->name }}</span>
                    @endif
                    @if($book->type == 'belajar')
                        <span class="book-tag">Buku Pelajaran</span>
                    @else
                        <span class="book-tag">Novel</span>
                    @endif
                    @if($book->publication_year)
                        <span class="book-tag">{{ $book->publication_year }}</span>
                    @endif
                </div>
                
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $book->title }}</h1>
                <p class="text-gray-600 mb-6 border-b border-gray-200 pb-6">
                    <span class="font-medium">Penulis:</span> {{ $book->author }}
                </p>
                
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Deskripsi
                    </h2>
                    <p class="text-gray-700 leading-relaxed text-justify">
                        {{ strip_tags($book->description) }}
                    </p>
                </div>
                
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Daftar Isi
                    </h2>
                    <ul class="space-y-2 text-gray-700 rounded-lg border border-gray-200 p-4 bg-gray-50">
                        @if(isset($chapters) && count($chapters) > 0)
                            @foreach($chapters as $chapter)
                                <li class="flex justify-between chapter-item">
                                    <span>{{ $chapter->title }}</span>
                                    <span class="text-gray-500">{{ $chapter->page_count }} hal</span>
                                </li>
                            @endforeach
                        @else
                            <li class="flex justify-between chapter-item">
                                <span>Bab 1: Pendahuluan</span>
                                <span class="text-gray-500">{{ mt_rand(15, 30) }} hal</span>
                            </li>
                            <li class="flex justify-between chapter-item">
                                <span>Bab 2: Materi Utama</span>
                                <span class="text-gray-500">{{ mt_rand(25, 40) }} hal</span>
                            </li>
                            <li class="flex justify-between chapter-item">
                                <span>Bab 3: Pembahasan Lanjutan</span>
                                <span class="text-gray-500">{{ mt_rand(20, 35) }} hal</span>
                            </li>
                            <li class="flex justify-between chapter-item">
                                <span>Bab 4: Kesimpulan</span>
                                <span class="text-gray-500">{{ mt_rand(10, 25) }} hal</span>
                            </li>
                        @endif
                    </ul>
                </div>
                
                <div class="flex justify-center">
                    <a href="{{ route('borrowings.create', ['book_id' => $book->id, 'book_title' => $book->title]) }}" class="read-button inline-block hover:shadow-lg">
                        Pinjam Buku
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Related Books -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-8 text-center">Buku Terkait</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @if(isset($relatedBooks) && count($relatedBooks) > 0)
                    @foreach($relatedBooks as $relatedBook)
                        <a href="{{ route('category.book', $relatedBook->id) }}" class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition transform hover:-translate-y-1">
                            <img src="{{ $relatedBook->image_path ?? asset('images/books/placeholder.jpg') }}" alt="{{ $relatedBook->title }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900 mb-1">{{ $relatedBook->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $relatedBook->category ? $relatedBook->category->name : 'Uncategorized' }}</p>
                            </div>
                        </a>
                    @endforeach
                @else
                    @for($i = 1; $i <= 5; $i++)
                        <a href="#" class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition transform hover:-translate-y-1">
                            <img src="{{ asset('images/books/placeholder.jpg') }}" alt="Buku Terkait" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900 mb-1">Buku Terkait {{ $i }}</h3>
                                <p class="text-sm text-gray-600">Kategori</p>
                            </div>
                        </a>
                    @endfor
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 