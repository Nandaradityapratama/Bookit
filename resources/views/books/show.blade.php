@extends('layouts.app')

@push('styles')
<style>
    .bg-light-pink {
        background-color: #FDF2F4;
    }
    .book-info-tag {
        @apply inline-flex items-center gap-2 text-gray-700;
    }
    .book-meta {
        @apply flex items-center gap-6 mt-4;
    }
</style>
@endpush

@section('content')
<main class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Book Details -->
    <div class="flex flex-col md:flex-row gap-8 mb-12">
        <!-- Book Image -->
        <div class="md:w-1/4">
            <img src="{{ Storage::url($book->image_path) }}" alt="{{ $book->title }}" class="w-full rounded-lg shadow-md">
        </div>
        
        <!-- Book Info -->
        <div class="md:w-3/4">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">{{ $book->title }}</h1>
            
            <p class="text-lg mb-2">Penulis: {{ $book->author }}</p>
            
            <!-- Book Meta -->
            <div class="flex gap-4">
                @if($book->type == 'fiction')
                <div class="book-info-tag flex items-center gap-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    {{ $categories[$book->fiction_category] ?? 'Uncategorized' }}
                </div>
                @endif

                @if($book->pages)
                <div class="book-info-tag flex items-center gap-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    {{ $book->pages }} Hal
                </div>
                @endif

                @if($book->publication_year)
                <div class="book-info-tag flex items-center gap-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ $book->publication_year }}
                </div>
                @endif
            </div>
            
            <div class="mt-6">
                <button onclick="window.location.href='{{ route('borrowings.create', ['book_id' => $book->id]) }}'" 
                        class="px-10 py-3 bg-rose-500 text-white font-bold uppercase rounded-md hover:bg-rose-600 transition inline-block">
                    PINJAM
                </button>
            </div>
        </div>
    </div>
    
    <!-- Sinopsis -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-4">Sinopsis</h2>
        <div class="text-gray-700 leading-relaxed text-justify">
            {{ strip_tags($book->description) }}
        </div>
    </div>
    
    <!-- Recommended Books -->
    @if(isset($relatedBooks) && count($relatedBooks) > 0)
    <div>
        <h2 class="text-2xl font-bold mb-6">Kamu Mungkin Juga Suka</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($relatedBooks as $relatedBook)
            <a href="{{ route('books.show', $relatedBook->id) }}" class="flex flex-col">
                <img src="{{ Storage::url($relatedBook->image_path) }}" 
                     alt="{{ $relatedBook->title }}" 
                     class="w-full aspect-[2/3] object-cover rounded-lg mb-3">
                <h3 class="font-bold text-gray-900">{{ $relatedBook->title }}</h3>
                <p class="text-sm text-gray-600">oleh {{ $relatedBook->author }}</p>
                <p class="text-sm text-gray-600">
                    @if($relatedBook->type == 'fiction')
                        {{ $categories[$relatedBook->fiction_category] ?? 'Uncategorized' }}
                    @else
                        {{ $relatedBook->education_level == 'smp' ? 'SMP' : 'SMA' }} - Kelas {{ $relatedBook->grade }}
                    @endif
                </p>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</main>
@endsection 