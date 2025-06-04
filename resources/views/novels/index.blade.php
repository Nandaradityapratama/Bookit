@extends('layouts.app')

@section('title', 'BookIt Novel')

@push('styles')
<style>
    body {
        background-color: #ffffff;
    }
</style>
@endpush

@section('content')
<div class="flex flex-col md:flex-row bg-white items-start py-8 sm:py-12 md:py-20">
    <!-- Filter Genre -->
    <div class="w-full md:w-auto px-4 md:pl-10 mb-6 md:mb-0">
        <select id="genre" onchange="changeGenre(this.value)" 
                class="w-full md:w-40 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 appearance-none bg-white bg-no-repeat bg-right pr-8" 
                style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'%23606060\'%3E%3Cpath stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M19 9l-7 7-7-7\'/%3E%3C/svg%3E'); background-size: 16px; background-position: calc(100% - 8px) center;">
            <option value="all" {{ !$categoryFilter ? 'selected' : '' }}>Genre</option>
            @foreach ($categories as $value => $label)
                <option value="{{ $value }}" {{ $categoryFilter == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>
    
    <!-- Main Content -->
    <div class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Sort Section -->
        <div class="mb-8">
            <h2 class="text-base sm:text-lg font-medium text-gray-900 mb-2">Sort By</h2>
            <div class="border-b border-gray-500 mb-4 sm:mb-6"></div>
            
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('novels.index', ['sort' => 'recommended', 'genre' => $categoryFilter]) }}" 
                   class="inline-block px-3 sm:px-4 py-1.5 rounded-full border text-xs sm:text-sm font-medium {{ $sort == 'recommended' ? 'bg-pink-500 text-white border-pink-500' : 'border-gray-500 text-gray-700' }} hover:bg-pink-500 hover:text-white hover:border-pink-500 transition duration-300">
                    Recommended
                </a>
                <a href="{{ route('novels.index', ['sort' => 'newest', 'genre' => $categoryFilter]) }}" 
                   class="inline-block px-3 sm:px-4 py-1.5 rounded-full border text-xs sm:text-sm font-medium {{ $sort == 'newest' ? 'bg-pink-500 text-white border-pink-500' : 'border-gray-500 text-gray-700' }} hover:bg-pink-500 hover:text-white hover:border-pink-500 transition duration-300">
                    Newest
                </a>
                <a href="{{ route('novels.index', ['sort' => 'title_asc', 'genre' => $categoryFilter]) }}" 
                   class="inline-block px-3 sm:px-4 py-1.5 rounded-full border text-xs sm:text-sm font-medium {{ $sort == 'title_asc' ? 'bg-pink-500 text-white border-pink-500' : 'border-gray-500 text-gray-700' }} hover:bg-pink-500 hover:text-white hover:border-pink-500 transition duration-300">
                    A-Z
                </a>
            </div>
        </div>

        <!-- Book List -->
        <div class="space-y-4 sm:space-y-6 md:space-y-8">
            @forelse($books as $book)
                <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 p-4 rounded-lg transition duration-300 bg-white shadow-sm hover:shadow-md">
                    <div class="flex-shrink-0 w-full sm:w-24 h-48 sm:h-36">
                        <img src="{{ Storage::url($book->image_path) }}" 
                             alt="{{ $book->title }}" 
                             class="w-full h-full object-cover rounded-md shadow-md transition duration-300">
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex flex-wrap gap-1 mb-1.5">
                            <span class="text-pink-500 text-xs font-medium"># {{ $categories[$book->fiction_category] }}</span>
                        </div>
                        
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-1">{{ $book->title }}</h3>
                        <p class="text-xs sm:text-sm text-gray-600 mb-2">by {{ $book->author }}</p>
                        
                        <p class="text-xs sm:text-sm text-gray-600 line-clamp-3 sm:line-clamp-none">
                            {!! $book->description !!}
                        </p>
                        
                        <button onclick="window.location.href='{{ route('books.show', $book->id) }}'" 
                                class="mt-3 w-full sm:w-auto bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-md shadow-sm transition duration-300 text-sm">
                            Pinjam
                        </button>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-12 sm:py-16 px-4 bg-pink-50 rounded-lg shadow-sm">
                    <div class="text-center max-w-md">
                        <svg class="mx-auto h-12 sm:h-16 w-12 sm:w-16 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h3 class="mt-4 text-base sm:text-lg font-semibold text-gray-900">Belum Ada Buku</h3>
                        <p class="mt-2 text-sm text-gray-600">
                            @if($categoryFilter && $categoryFilter != 'all')
                                Maaf, belum ada buku tersedia untuk genre {{ $categories[$categoryFilter] ?? $categoryFilter }}.
                                <br>
                                <a href="{{ route('novels.index') }}" class="text-pink-500 hover:text-pink-600 font-medium mt-2 inline-block">
                                    Lihat semua buku
                                </a>
                            @else
                                Maaf, belum ada buku tersedia saat ini.
                            @endif
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($books->hasPages())
        <div class="mt-6 sm:mt-8 md:mt-10 flex justify-center">
            {{ $books->appends(['genre' => $categoryFilter, 'sort' => $sort])->links() }}
        </div>
        @endif
    </div>
</div>

<script>
    function changeGenre(value) {
        window.location.href = "{{ route('novels.index') }}?genre=" + value + "&sort={{ $sort }}";
    }
</script>
@endsection 