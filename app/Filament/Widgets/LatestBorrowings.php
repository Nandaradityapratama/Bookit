<?php

namespace App\Filament\Widgets;

use App\Models\Borrowing;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestBorrowings extends BaseWidget
{
    protected static ?int $sort = 2;
    
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Borrowing::query()
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Peminjam')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('book.title')
                    ->label('Judul Buku')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('borrow_date')
                    ->label('Tanggal Pinjam')
                    ->date(),
                
                Tables\Columns\TextColumn::make('due_date')
                    ->label('Tanggal Kembali')
                    ->date(),
                
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'dipinjam',
                        'success' => 'dikembalikan',
                        'danger' => 'terlambat',
                    ]),
            ])
            ->heading('Peminjaman Terbaru');
    }
} 