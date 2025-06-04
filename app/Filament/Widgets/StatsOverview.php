<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Buku', Book::count())
                ->description('Jumlah semua buku')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('success'),
            
            Stat::make('Buku Dipinjam', Borrowing::where('status', 'dipinjam')->count())
                ->description('Buku yang sedang dipinjam')
                ->descriptionIcon('heroicon-m-arrow-up-right')
                ->color('warning'),
            
            Stat::make('Buku Terlambat', Borrowing::where('status', 'terlambat')->count())
                ->description('Buku yang terlambat dikembalikan')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger'),
            
            Stat::make('Total Pengguna', User::count())
                ->description('Jumlah semua pengguna')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
        ];
    }
} 