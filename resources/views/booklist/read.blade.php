@extends('layouts.app')

@section('title', 'Baca Buku - BookIt')

@push('styles')
<style>
    body {
        background-color: #f9f9f9;
    }
    .reader-container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        max-width: 900px;
        margin: 0 auto;
    }
    .page-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }
    .book-navigation {
        position: sticky;
        bottom: 20px;
        background-color: white;
        border-radius: 50px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        z-index: 10;
    }
    .progress-bar {
        height: 4px;
        background-color: #eaeaea;
        border-radius: 2px;
        overflow: hidden;
    }
    .progress-bar-fill {
        height: 100%;
        background-color: #002358;
        border-radius: 2px;
    }
    .chapter-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: #002358;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eaeaea;
    }
</style>
@endpush

@section('content')
<div class="py-8">
    <!-- Book Info Bar -->
    <div class="bg-[#002358] text-white py-4 mb-6">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('category.show', $book->category_slug ?? 'smp') }}" class="flex items-center text-white hover:text-blue-200 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Kembali
                </a>
            </div>
            <div>
                <span class="text-sm font-medium">{{ $book->title ?? 'Judul Buku' }}</span>
            </div>
            <div>
                <span class="text-sm">Bab {{ $currentChapter ?? '1' }} dari {{ $totalChapters ?? '10' }}</span>
            </div>
        </div>
    </div>

    <!-- Reader Container -->
    <div class="reader-container p-8 mb-24">
        <h1 class="chapter-title">{{ $chapterTitle ?? 'Bab 1: Pengenalan' }}</h1>

        <div class="page-content">
            @if(isset($content))
                {!! $content !!}
            @else
                <p>Di dalam matematika, bilangan prima adalah bilangan asli yang lebih besar dari 1 dan hanya bisa dibagi oleh 1 dan dirinya sendiri. Contoh bilangan prima adalah 2, 3, 5, 7, 11, dan seterusnya.</p>
                
                <p>Bilangan prima memiliki beberapa sifat unik:</p>
                
                <ol class="list-decimal pl-6 my-4">
                    <li>Bilangan prima terkecil adalah 2, dan merupakan satu-satunya bilangan prima yang genap.</li>
                    <li>Setiap bilangan asli yang lebih besar dari 1 bisa difaktorkan menjadi hasil kali dari bilangan-bilangan prima.</li>
                    <li>Jumlah bilangan prima adalah tak terhingga, seperti yang dibuktikan oleh Euclid.</li>
                </ol>
                
                <p>Untuk menentukan apakah suatu bilangan adalah prima, kita bisa menggunakan berbagai metode, salah satunya adalah dengan mencoba membagi bilangan tersebut dengan semua bilangan dari 2 hingga akar dari bilangan tersebut. Jika tidak ada bilangan yang membagi habis, maka bilangan tersebut adalah prima.</p>
                
                <h3 class="text-xl font-semibold mt-6 mb-3">Penggunaan Bilangan Prima</h3>
                
                <p>Bilangan prima memiliki banyak aplikasi dalam kehidupan sehari-hari, terutama dalam bidang kriptografi untuk menjaga keamanan data digital. Misalnya, sistem RSA menggunakan dua bilangan prima yang sangat besar untuk menciptakan kunci publik yang sulit untuk dipecahkan.</p>
                
                <div class="bg-blue-50 p-4 rounded-lg my-6">
                    <h4 class="font-semibold text-blue-800 mb-2">Contoh Soal:</h4>
                    <p>Tentukan semua bilangan prima antara 20 dan 40.</p>
                    <p class="mt-4 font-medium">Jawaban:</p>
                    <p>Bilangan prima antara 20 dan 40 adalah: 23, 29, 31, 37.</p>
                </div>
                
                <p>Pada bab berikutnya, kita akan mempelajari lebih lanjut tentang teorema bilangan prima dan aplikasinya dalam pemecahan masalah matematika tingkat lanjut.</p>
            @endif
        </div>
    </div>

    <!-- Navigation Bar -->
    <div class="book-navigation max-w-lg mx-auto px-6 py-3 flex justify-between items-center">
        <button class="p-2 text-gray-600 hover:text-blue-800 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        
        <div class="flex-1 mx-4">
            <div class="text-xs text-gray-500 text-center mb-1">Halaman {{ $currentPage ?? '1' }} dari {{ $totalPages ?? '20' }}</div>
            <div class="progress-bar">
                <div class="progress-bar-fill" style="width: {{ ($currentPage / $totalPages) * 100 ?? 5 }}%"></div>
            </div>
        </div>
        
        <button class="p-2 text-gray-600 hover:text-blue-800 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const prevButton = document.querySelector('.book-navigation button:first-child');
        const nextButton = document.querySelector('.book-navigation button:last-child');
        
        prevButton.addEventListener('click', function() {
            // Logic untuk halaman sebelumnya
            const currentPage = {{ $currentPage ?? 1 }};
            if (currentPage > 1) {
                window.location.href = `{{ url()->current() }}?page=${currentPage - 1}`;
            }
        });
        
        nextButton.addEventListener('click', function() {
            // Logic untuk halaman selanjutnya
            const currentPage = {{ $currentPage ?? 1 }};
            const totalPages = {{ $totalPages ?? 20 }};
            if (currentPage < totalPages) {
                window.location.href = `{{ url()->current() }}?page=${currentPage + 1}`;
            }
        });
    });
</script>
@endpush 