@extends('layouts.app')

@section('navigation')
    @include('booklist.navigation')
@endsection

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row">
            <!-- Sidebar Filter -->
            <div class="w-full md:w-64 flex-shrink-0 mb-6 md:mb-0 md:mr-6">
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 mb-2">Jurusan</h3>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option>Semua Jurusan</option>
                                <option>Teknik Komputer dan Jaringan</option>
                                <option>Rekayasa Perangkat Lunak</option>
                                <option>Multimedia</option>
                                <option>Akuntansi</option>
                                <option>Administrasi Perkantoran</option>
                                <option>Teknik Mesin</option>
                                <option>Teknik Elektro</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    {{-- <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path> --}}
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow">
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 mb-2">Bidang Keahlian</h3>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option>Semua Bidang</option>
                                <option>Teknologi Informasi</option>
                                <option>Bisnis dan Manajemen</option>
                                <option>Pariwisata</option>
                                <option>Teknik Mesin dan Otomotif</option>
                                <option>Teknik Elektro</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    {{-- <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path> --}}
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content -->
            <div class="flex-1 bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <div class="text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Konten Segera Hadir</h3>
                        <p class="text-gray-500 max-w-md mx-auto">
                            Materi untuk kejuruan sedang dalam proses pengembangan. Silahkan kunjungi kembali halaman ini dalam waktu dekat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 