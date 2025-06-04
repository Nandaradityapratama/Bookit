@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-cover bg-center h-96" style="background-image: url('/images/banner home (1) 2.jpg');">
    <div class="flex flex-col items-center justify-center h-96 bg-black bg-opacity-50 text-white text-center">
        <h1 class="text-5xl font-bold mb-4">Providing entertainment</h1>
        <h1 class="text-5xl font-bold mb-4">in the form of writing</h1>
    </div>
</section>

<!-- Welcome Section -->
<section class="py-16 bg-purple-900 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-xl text-justify">
            Selamat datang di Bookit, destinasi yang bisa anda kunjungi untuk menenemukan dan menikmati buku-buku yang bisa anda baca secara online. Kami menyediakan buku novel dengan berbagai genre yang dapat anda pilih sesuai dengan genre favorit anda, serta buku pelajaran yang kami sediakan.
        </p>
    </div>
</section>

<!-- Glimpse Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12">A glimps of us</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <img src="/images/about/dokumentasi about us.jpg" alt="Students reading" class="w-full h-64 object-cover rounded-lg shadow-md">
            <img src="/images/about/dokumentasi about us1.jpg" alt="Library environment" class="w-full h-64 object-cover rounded-lg shadow-md">
            <img src="/images/about/dokumentasi about us2.jpg" alt="School activities" class="w-full h-64 object-cover rounded-lg shadow-md">
        </div>
    </div>
</section>

<!-- Our Team Section -->
<section class="py-16 bg-purple-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center text-white mb-12">Our Team</h2>
        
        <!-- Top Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <div class="bg-white rounded-lg p-6 flex flex-col items-center">
                <img src="/images/team/fadillah.jpg" alt="Fadillah Ayu Rustirana" class="rounded-full w-32 h-32 object-cover mb-4">
                <h3 class="font-semibold">Fadillah Ayu Rustirana</h3>
                <button class="mt-2 px-4 py-1 bg-white text-gray-700 border border-gray-300 rounded-full text-sm">Read More</button>
            </div>
            
            <div class="bg-white rounded-lg p-6 flex flex-col items-center">
                <img src="/images/team/fifi.jpg" alt="Laila Husna Nafisatu .A" class="rounded-full w-32 h-32 object-cover mb-4">
                <h3 class="font-semibold">Laila Husna Nafisatu .A</h3>
                <button class="mt-2 px-4 py-1 bg-white text-gray-700 border border-gray-300 rounded-full text-sm">Read More</button>
            </div>
            
            <div class="bg-white rounded-lg p-6 flex flex-col items-center">
                <img src="/images/team/malka.jpg" alt="Malka Orvala" class="rounded-full w-32 h-32 object-cover mb-4">
                <h3 class="font-semibold">Malka Orvala</h3>
                <button class="mt-2 px-4 py-1 bg-white text-gray-700 border border-gray-300 rounded-full text-sm">Read More</button>
            </div>
        </div>
        
        <!-- Bottom Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg p-6 flex flex-col items-center">
                <img src="/images/team/nanda.jpg" alt="Nanda Praditya Pratama" class="rounded-full w-32 h-32 object-cover mb-4">
                <h3 class="font-semibold">Nanda Praditya Pratama</h3>
                <button class="mt-2 px-4 py-1 bg-white text-gray-700 border border-gray-300 rounded-full text-sm">Read More</button>
            </div>
            
            <div class="bg-white rounded-lg p-6 flex flex-col items-center">
                <img src="/images/team/rafif.jpg" alt="Rafif Firza Puta" class="rounded-full w-32 h-32 object-cover mb-4">
                <h3 class="font-semibold">Rafif Firza Puta</h3>
                <button class="mt-2 px-4 py-1 bg-white text-gray-700 border border-gray-300 rounded-full text-sm">Read More</button>
            </div>
            
            <div class="bg-white rounded-lg p-6 flex flex-col items-center">
                <img src="/images/team/wahyu.jpg" alt="Wahyu Adi Nugraha" class="rounded-full w-32 h-32 object-cover mb-4">
                <h3 class="font-semibold">Wahyu Adi Nugraha</h3>
                <button class="mt-2 px-4 py-1 bg-white text-gray-700 border border-gray-300 rounded-full text-sm">Read More</button>
            </div>
        </div>
    </div>
</section>

@endsection 