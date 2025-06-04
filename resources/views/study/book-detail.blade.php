@extends('layouts.app')

@section('title', 'Detail Buku - BookIt')
@section('navigation')
    @include('booklist.navigation')
@endsection


@push('styles')
<style>
    .book-cover {
        width: 100%;
        max-width: 300px;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .book-info {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .related-book-card {
        transition: transform 0.2s;
    }
    
    .related-book-card:hover {
        transform: translateY(-4px);
    }
    
    .related-book-cover {
        width: 100%;
        aspect-ratio: 2/3;
        object-fit: cover;
        border-radius: 8px;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#37709F] transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('category.show', ['slug' => $book->education_level]) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#37709F] md:ml-2 transition-colors duration-200">
                            {{ strtoupper($book->education_level) }}
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $book->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Book Detail Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Book Cover -->
                    <div class="md:col-span-1">
                        <div class="relative group">
                            <img src="{{ Storage::url($book->image_path) }}" alt="{{ $book->title }}" 
                                class="w-full rounded-xl shadow-md transform transition duration-300 group-hover:scale-105 group-hover:shadow-xl" 
                                style="aspect-ratio: 2/3; object-fit: cover;">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300 rounded-xl"></div>
                        </div>
                    </div>

                    <!-- Book Information -->
                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $book->title }}</h1>
                            <div class="flex flex-wrap gap-4 mt-4">
                                <div class="flex items-center bg-blue-50 px-3 py-1.5 rounded-lg">
                                    <svg class="w-5 h-5 text-[#37709F] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700">Kelas {{ $book->grade }}</span>
                                </div>
                                <div class="flex items-center bg-blue-50 px-3 py-1.5 rounded-lg">
                                    <svg class="w-5 h-5 text-[#37709F] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700">{{ $book->curriculum }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="prose max-w-none">
                            <h2 class="text-xl font-semibold text-gray-900 mb-3">Deskripsi</h2>
                            <p class="text-gray-600 leading-relaxed">{{ strip_tags($book->description) }}</p>
                        </div>

                        <div class="pt-6">
                            <a href="{{ route('study.book.pdf', $book->id) }}" 
                               class="inline-flex items-center px-6 py-3 bg-[#37709F] text-white rounded-xl hover:bg-[#2c5a8f] transition-colors duration-200 shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                Baca Buku
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Books -->
        @if($relatedBooks->isNotEmpty())
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Buku Terkait</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach($relatedBooks as $relatedBook)
                <a href="{{ route('study.book.detail', $relatedBook->id) }}" 
                   class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="relative aspect-[2/3]">
                        <img src="{{ Storage::url($relatedBook->image_path) }}" 
                             alt="{{ $relatedBook->title }}" 
                             class="w-full h-full object-cover transform transition duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-sm text-gray-900 line-clamp-2 mb-1 group-hover:text-[#37709F] transition-colors duration-200">
                            {{ $relatedBook->title }}
                        </h3>
                        <p class="text-sm text-gray-600">Kelas {{ $relatedBook->grade }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection 