@extends('layouts.main')

@section('content')

<!-- Hero Section -->
<section class="bg-cover bg-center h-64 sm:h-96" style="background-image: url('/images/banner home (1) 2.jpg');">
    <div class="flex flex-col items-center justify-center h-full bg-black bg-opacity-50 text-white text-center px-4">
        <h1 class="text-2xl sm:text-4xl font-bold mb-2">Bookit Web</h1>
        <p class="text-sm sm:text-lg px-4">Aplikasi BookIt Perpustakaan online untuk membantu Anda dengan program</p>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-[#7FC6DE] py-6 sm:py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
            <div class="bg-[#7FC6DE] p-4 sm:p-6">
                <h2 class="text-2xl sm:text-4xl font-bold text-white">{{ $totalBorrowCount }}</h2>
                <p class="text-white text-sm sm:text-base">Kali Buku Di Baca</p>
            </div>
            <div class="bg-[#7FC6DE] p-4 sm:p-6">
                <h2 class="text-2xl sm:text-4xl font-bold text-white">{{ $totalBooks }}</h2>
                <p class="text-white text-sm sm:text-base">Buku Tersedia</p>
            </div>
            <div class="bg-[#7FC6DE] p-4 sm:p-6">
                <h2 class="text-2xl sm:text-4xl font-bold text-white">{{ $totalVisits }}</h2>
                <p class="text-white text-sm sm:text-base">total kunjungannya</p>
            </div>
        </div>
    </div>
</section>

<!-- Book Categories Section -->
<section class="py-8 sm:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 sm:gap-8">
            <div class="flex flex-col items-center text-center">
                <a href="{{ route('booklist.index') }}" class="block w-full">
                    <div class="bg-[#7FC6DE] p-6 sm:p-8 rounded-lg mb-4 hover:shadow-lg transition-shadow duration-300 w-full sm:w-64 mx-auto">
                        <img src="/images/buku.png" alt="Buku Pelajaran" class="h-24 sm:h-36 mx-auto">
                        <h3 class="text-uppercase text-white font-bold text-sm sm:text-base mt-2">BUKU PELAJARAN</h3>
                    </div>
                </a>
            </div>
            <div class="flex flex-col items-center text-center">
                <a href="{{ route('novels.index') }}" class="block w-full">
                    <div class="bg-[#FE4066] p-6 sm:p-8 rounded-lg mb-4 hover:shadow-lg transition-shadow duration-300 w-full sm:w-64 mx-auto">
                        <img src="/images/buku-lusuh.png" alt="Buku Non-Fiksi" class="h-24 sm:h-36 mx-auto">
                        <h3 class="text-uppercase text-white font-bold text-sm sm:text-base mt-2">BUKU NON-FIKSI</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Buku Pelajaran Section -->
<section class="py-6 sm:py-8 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-xl sm:text-2xl font-bold mb-4">Buku Pelajaran</h2>
        <hr class="mb-6 sm:mb-8">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-4">
            @forelse($educationalBooks as $book)
            <div class="flex flex-col items-center">
                <a href="{{ route('study.book.detail', $book->id) }}" class="w-full">
                    <div class="aspect-[3/4] w-full mb-2">
                        <img src="{{ $book->image_path ? Storage::url($book->image_path) : asset('images/placeholder.jpg') }}" 
                             alt="{{ $book->title }}" 
                             class="w-full h-full object-cover rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    </div>
                    <h4 class="font-semibold text-xs sm:text-sm text-center line-clamp-2">{{ $book->title }}</h4>
                    <p class="text-xs text-gray-500 text-center mt-1">
                        Kelas {{ $book->grade }} {{ strtoupper($book->education_level) }}
                    </p>
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500">Belum ada buku pelajaran yang tersedia.</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-6 sm:mt-8">
            <a href="{{ route('category.show', 'smp') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm sm:text-base rounded-md hover:bg-blue-700 transition-colors">
                Lihat Semua Buku Pelajaran
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Featured Book Section -->
<section class="py-6 sm:py-8 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 items-center">
            <div class="order-2 md:order-1">
                <h2 class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4">Dilan 1990</h2>
                <p class="text-sm sm:text-base mb-3 sm:mb-4">Novel "Dilan 1990" karya Pidi Baiq bercerita tentang kisah cinta dua remaja Bandung pada tahun 1990. Kisahnya yang menarik dibuat berdasarkan kenangan Milea. Dilan masuk kehidupan Milea di sekolah dengan cara tidak biasa. Dilan memanggil tukang ramal jalanan untuk menerangkan bahwa ia akan bertemu dengan Milea di kantin sekolah. Dilan memiliki karakter unik yang berbeda dari cowok-cowok lain yang pernah ditemui Milea.</p>
                <p class="text-sm sm:text-base mb-4 sm:mb-6">Dilan dan Milea menjalin kisah hidup berbunga-bunga sekaligus serius. Berikut Dilan berulang kali mengatakan Milea di rumahnya pada kalimat termanis: "Jangan rindu, berat. Kau tak akan kuat. Biar aku saja." Begitulah kisah keduanya!</p>
                @php
                    $dilanBook = App\Models\Book::where('title', 'like', '%Dilan%')->first();
                    $bookId = $dilanBook ? $dilanBook->id : null;
                @endphp
                @if($bookId)
                    <a href="{{ route('books.show', $bookId) }}" class="px-4 sm:px-6 py-2 bg-rose-500 text-white text-sm sm:text-base font-medium rounded-md inline-block hover:bg-rose-600 transition-colors">LIHAT</a>
                @else
                    <span class="px-4 sm:px-6 py-2 bg-gray-400 text-white text-sm sm:text-base font-medium rounded-md inline-block cursor-not-allowed">BUKU TIDAK TERSEDIA</span>
                @endif
            </div>
            <div class="order-1 md:order-2">
                <img src="/images/books/Dilan 1990 (2).jpg" alt="Dilan 1990" class="w-full max-w-sm mx-auto rounded-lg shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- Buku Non-Fiksi Section -->
<section class="py-6 sm:py-8 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-xl sm:text-2xl font-bold mb-4">Buku Non-Fiksi</h2>
        <hr class="mb-6 sm:mb-8">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-4">
            @forelse($fictionBooks as $book)
            <div class="flex flex-col items-center">
                <a href="{{ route('books.show', $book->id) }}" class="w-full">
                    <div class="aspect-[3/4] w-full mb-2">
                        <img src="{{ $book->image_path ? Storage::url($book->image_path) : asset('images/placeholder.jpg') }}" 
                             alt="{{ $book->title }}" 
                             class="w-full h-full object-cover rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    </div>
                    <h4 class="font-semibold text-xs sm:text-sm text-center line-clamp-2">{{ $book->title }}</h4>
                    <p class="text-xs text-gray-500 text-center mt-1">
                        {{ ucfirst($book->fiction_category) }}
                    </p>
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500">Belum ada buku non-fiksi yang tersedia.</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-6 sm:mt-8">
            <a href="{{ route('novels.index') }}" class="inline-flex items-center px-4 py-2 bg-rose-500 text-white text-sm sm:text-base rounded-md hover:bg-rose-600 transition-colors">
                Lihat Semua Buku Non-Fiksi
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-[#012E58] text-white py-6 sm:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <div>
                <h4 class="font-semibold text-lg mb-3 sm:mb-4">Follow Us :</h4>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-gray-300 transition-colors">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-white hover:text-gray-300 transition-colors">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-white hover:text-gray-300 transition-colors">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
                <p class="mt-3 sm:mt-4 text-sm sm:text-base">Copyright © 2023 BookIt</p>
            </div>
            <div>
                <h4 class="font-semibold text-lg mb-3 sm:mb-4">Teams</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-sm sm:text-base hover:text-gray-300 transition-colors">About Us</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-lg mb-3 sm:mb-4">CONTACTS</h4>
                <p class="text-sm sm:text-base mb-2">perpusbookit@gmail.com</p>
                <p class="text-sm sm:text-base">0822-2093-7789</p>
            </div>
        </div>
    </div>
</footer>
@endsection
