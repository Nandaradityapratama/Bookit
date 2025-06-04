@extends('layouts.app')

@section('navigation')
    @include('booklist.navigation')
@endsection

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4 sm:mb-6 text-center">Buku SMA/SMK</h1>
        
        <div class="flex flex-col lg:flex-row gap-4 sm:gap-6">
            <!-- Sidebar Filter -->
            <div class="w-full lg:w-64 flex-shrink-0">
                <!-- Kelas Filter -->
                <div class="bg-white rounded-lg shadow-sm mb-4">
                    <div class="p-4 sm:p-5">
                        <h3 class="font-semibold text-gray-800 mb-3 flex items-center text-sm sm:text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                            Kelas
                        </h3>
                        <div class="relative">
                            <select onchange="window.location.href=this.value" 
                                    class="block w-full bg-white border border-gray-300 hover:border-blue-500 px-3 sm:px-4 py-2 sm:py-3 rounded-lg text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                <option value="{{ route('category.show', ['slug' => 'sma']) }}" {{ !request('grade') ? 'selected' : '' }}>Semua Kelas</option>
                                <option value="{{ route('category.show', ['slug' => 'sma', 'grade' => 10]) }}" {{ request('grade') == 10 ? 'selected' : '' }}>Kelas 10</option>
                                <option value="{{ route('category.show', ['slug' => 'sma', 'grade' => 11]) }}" {{ request('grade') == 11 ? 'selected' : '' }}>Kelas 11</option>
                                <option value="{{ route('category.show', ['slug' => 'sma', 'grade' => 12]) }}" {{ request('grade') == 12 ? 'selected' : '' }}>Kelas 12</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Mata Pelajaran Filter -->
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="p-4 sm:p-5">
                        <h3 class="font-semibold text-gray-800 mb-3 flex items-center text-sm sm:text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Mata Pelajaran
                        </h3>
                        <div class="relative">
                            <select onchange="window.location.href=this.value" 
                                    class="block w-full bg-white border border-gray-300 hover:border-blue-500 px-3 sm:px-4 py-2 sm:py-3 rounded-lg text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                <option value="{{ route('category.show', ['slug' => 'sma']) }}" {{ !request('subject') ? 'selected' : '' }}>Semua Pelajaran</option>
                                @foreach(App\Models\Book::getSubjects() as $value => $label)
                                    <option value="{{ route('category.show', ['slug' => 'sma', 'subject' => $value]) }}" {{ request('subject') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content -->
            <div class="flex-1 bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-4 sm:p-6">
                    @forelse($books as $book)
                    <!-- Book Item -->
                    <div class="bg-blue-50 rounded-lg p-4 sm:p-5 mb-4 sm:mb-6 flex flex-col sm:flex-row gap-4 sm:gap-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="w-full sm:w-36 h-48 sm:h-auto flex-shrink-0">
                            <img src="{{ Storage::url($book->image_path) }}" 
                                alt="{{ $book->title }}" 
                                class="w-full h-full sm:w-36 object-cover rounded-lg shadow-sm">
                        </div>
                        <div class="flex-1">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2">
                                <div>
                                    <div class="text-xs sm:text-sm text-blue-600 mb-1 font-medium">
                                        Kategori / {{ $book->category->name ?? 'Umum' }} 
                                        <span class="ml-2 bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-0.5 rounded">
                                            @if(strpos($book->title, '10') !== false)
                                                Kelas 10
                                            @elseif(strpos($book->title, '11') !== false)
                                                Kelas 11
                                            @elseif(strpos($book->title, '12') !== false)
                                                Kelas 12
                                            @else
                                                SMA
                                            @endif
                                        </span>
                                    </div>
                                    <h3 class="text-lg sm:text-2xl font-bold text-gray-900 mb-2">{{ $book->title }}</h3>
                                </div>
                            </div>
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-1">
                                    <span class="font-medium">Tahun:</span> {{ $book->publication_year ?? '2021' }}
                                </p>
                                <p class="text-sm text-gray-600 mb-3">
                                    <span class="font-medium">Kurikulum:</span> Merdeka
                                </p>
                                <p class="text-sm text-gray-700 mb-4 line-clamp-2 sm:line-clamp-none">
                                    {{ strip_tags($book->description) }}
                                </p>
                            </div>
                            <div class="flex">
                                <a href="{{ route('study.book.detail', $book->id) }}" 
                                   class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-colors">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Buku
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 sm:py-10">
                        <p class="text-gray-500 text-sm sm:text-base">Tidak ada buku SMA yang tersedia saat ini.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 