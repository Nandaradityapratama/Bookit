@extends('layouts.main')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h2 class="text-lg font-medium text-gray-900">
                    Informasi Profil
                </h2>

                <div class="mt-6 space-y-6">
                    <div>
                        <p class="text-gray-600">Nama:</p>
                        <p class="text-gray-900 font-semibold">{{ $user->name }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600">Email:</p>
                        <p class="text-gray-900 font-semibold">{{ $user->email }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600">NISN:</p>
                        <p class="text-gray-900 font-semibold">{{ $user->nisn }}</p>
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('profile.edit') }}" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md">
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-full">
                <h2 class="text-lg font-medium text-gray-900 mb-6">
                    Riwayat Peminjaman Buku
                </h2>

                @if($borrowings->isEmpty())
                    <p class="text-gray-500 italic">Belum ada buku yang dipinjam.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Buku</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($borrowings as $borrowing)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $borrowing->book_title }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $today = \Carbon\Carbon::now();
                                                $returnDate = \Carbon\Carbon::parse($borrowing->return_date);
                                            @endphp
                                            
                                            @if($today > $returnDate)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Terlambat
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Aktif
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 