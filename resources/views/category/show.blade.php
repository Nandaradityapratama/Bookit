@extends('layouts.app')

@section('title', 'Detail Buku - BookIt')

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
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Buku {{ ucfirst($category) }}</h1>

    <!-- Filter Section -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-xl font-semibold mb-4">Filter</h2>
        <form action="{{ route('category.show', $category) }}" method="GET" class="space-y-4">
            <!-- Kelas Filter -->
            <div>
                <label for="grade" class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                <select name="grade" id="grade" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Kelas</option>
                    @for ($i = 7; $i <= 9; $i++)
                        <option value="{{ $i }}" {{ request('grade') == $i ? 'selected' : '' }}>
                            Kelas {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            <!-- Mata Pelajaran Filter -->
            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran</label>
                <select name="subject" id="subject" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Mata Pelajaran</option>
                    @foreach(App\Models\Book::getSubjects() as $value => $label)
                        <option value="{{ $value }}" {{ request('subject') == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Books Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @forelse($books as $book)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <a href="{{ route('study.book.detail', $book->id) }}" class="block">
                <div class="aspect-w-3 aspect-h-4">
                    <img src="{{ $book->image_path ? Storage::url($book->image_path) : asset('images/placeholder.jpg') }}" 
                         alt="{{ $book->title }}" 
                         class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2 line-clamp-2">{{ $book->title }}</h3>
                    <p class="text-gray-600 text-sm mb-2">
                        Kelas {{ $book->grade }} {{ strtoupper($book->education_level) }}
                    </p>
                    @if($book->subject)
                        <p class="text-gray-500 text-sm">{{ App\Models\Book::getSubjects()[$book->subject] ?? $book->subject }}</p>
                    @endif
                </div>
            </a>
        </div>
        @empty
        <div class="col-span-full text-center py-8">
            <p class="text-gray-500">Tidak ada buku yang tersedia.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $books->links() }}
    </div>
</div>
@endsection 