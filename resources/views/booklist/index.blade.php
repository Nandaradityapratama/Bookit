@extends('layouts.app')

@section('title', 'BookIt - Belajar')

@push('styles')
<style>
    /* Menghapus style yang tidak perlu karena akan diganti dengan Tailwind */
</style>
@endpush

@section('navigation')
    @include('booklist.navigation')
@endsection

@section('content')
<div class="min-h-screen flex flex-col">
    <!-- Hero Section -->
    <div class="relative">
        <!-- Background Image -->
        <section class="bg-cover bg-center h-48 sm:h-64 md:h-96" 
                 style="background-image: url('/images/Homepage 2 .jpg');">
        </section>
        
        <!-- Hero Content -->
        <div class="bg-[#012E58] text-white text-center py-8 sm:py-10 md:py-12 px-4">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-3xl sm:text-5xl md:text-6xl lg:text-8xl font-bold mb-4 sm:mb-6">
                    Belajar bersama BookIt !
                </h1>
                <p class="text-base sm:text-lg md:text-xl max-w-3xl mx-auto px-4 leading-relaxed">
                    Web yang bisa kamu gunakan untuk belajar dengan mudah.
                    Web ini menyediakan layanan buku pembelajaran tingkat
                    SMP, SMA, dan SMK.
                </p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="flex-grow bg-[#7FC6DE] py-8 sm:py-10 md:py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold mb-6 sm:mb-8 md:mb-10 text-center text-white">
                Pilih tingkatan Sekolahmu !
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 md:gap-8 max-w-5xl mx-auto">
                <!-- SMP Card -->
                <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 flex flex-col justify-between border-2 border-gray-200 hover:border-gray-300 transition-all duration-300 h-auto sm:h-80 md:h-96">
                    <div class="space-y-3">
                        <img src="{{ asset('images/sk/smp.png') }}" 
                             onerror="this.src='https://placehold.co/80x80?text=SMP'" 
                             alt="Logo SMP" 
                             class="w-16 sm:w-20">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900">SMP</h3>
                    </div>
                    <div class="mt-4 sm:mt-6">
                        <a href="{{ route('category.show', 'smp') }}" class="block">
                            <button class="w-full bg-[#002358] text-white py-2.5 sm:py-3 px-4 rounded-md hover:bg-blue-800 transition-colors duration-300 text-sm sm:text-base font-medium">
                                Mulai
                            </button>
                        </a>
                    </div>
                </div>
                
                <!-- SMA/SMK Card -->
                <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 flex flex-col justify-between border-2 border-gray-200 hover:border-gray-300 transition-all duration-300 h-auto sm:h-80 md:h-96">
                    <div class="space-y-3">
                        <img src="{{ asset('images/sk/sma.png') }}" 
                             onerror="this.src='https://placehold.co/80x80?text=SMA'" 
                             alt="Logo SMA/SMK" 
                             class="w-16 sm:w-20">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900">SMA/SMK</h3>
                    </div>
                    <div class="mt-4 sm:mt-6">
                        <a href="{{ route('category.show', 'sma') }}" class="block">
                            <button class="w-full bg-[#002358] text-white py-2.5 sm:py-3 px-4 rounded-md hover:bg-blue-800 transition-colors duration-300 text-sm sm:text-base font-medium">
                                Mulai
                            </button>
                        </a>
                    </div>
                </div>
                
                <!-- Kejurusan Card -->
                <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 flex flex-col justify-between border-2 border-gray-200 hover:border-gray-300 transition-all duration-300 h-auto sm:h-80 md:h-96">
                    <div class="space-y-3">
                        <img src="{{ asset('images/sk/sma.png') }}" 
                             onerror="this.src='https://placehold.co/80x80?text=Kejuruan'" 
                             alt="Logo Kejurusan" 
                             class="w-16 sm:w-20">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900">Kejurusan</h3>
                        <p class="text-gray-500 text-xs sm:text-sm">(akan segera tersedia)</p>
                    </div>
                    <div class="mt-4 sm:mt-6">
                        <a href="{{ route('category.show', 'kejuruan') }}" class="block">
                            <button class="w-full bg-[#002358] text-white py-2.5 sm:py-3 px-4 rounded-md hover:bg-blue-800 transition-colors duration-300 text-sm sm:text-base font-medium">
                                Mulai
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 