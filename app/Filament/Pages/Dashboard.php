<?php

namespace App\Filament\Pages;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Dashboard Admin';
    
    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected static ?int $navigationSort = -2;
    
    protected ?string $heading = 'Selamat Datang di BookIt Admin';
    
    protected static ?string $navigationLabel = 'Dashboard';

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatsOverview::class,
            \App\Filament\Widgets\LatestBorrowings::class,
            \App\Filament\Widgets\BorrowingChart::class,
        ];
    }
} 