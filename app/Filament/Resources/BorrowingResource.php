<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BorrowingResource\Pages;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BorrowingResource extends Resource
{
    protected static ?string $model = Borrowing::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    
    protected static ?string $navigationGroup = 'Manajemen Perpustakaan';
    
    protected static ?string $navigationLabel = 'Peminjaman';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Peminjam')
                    ->options(User::query()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                
                Forms\Components\Select::make('book_id')
                    ->label('Buku')
                    ->options(Book::query()->pluck('title', 'id'))
                    ->searchable()
                    ->required(),
                
                Forms\Components\DatePicker::make('borrow_date')
                    ->label('Tanggal Pinjam')
                    ->required()
                    ->default(now()),
                
                Forms\Components\DatePicker::make('due_date')
                    ->label('Tanggal Kembali')
                    ->required()
                    ->default(now()->addDays(7)),
                
                Forms\Components\DatePicker::make('return_date')
                    ->label('Tanggal Dikembalikan')
                    ->nullable(),
                
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'dipinjam' => 'Dipinjam',
                        'dikembalikan' => 'Dikembalikan',
                        'terlambat' => 'Terlambat'
                    ])
                    ->required()
                    ->default('dipinjam'),
                
                Forms\Components\Textarea::make('notes')
                    ->label('Catatan')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Peminjam')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('book.title')
                    ->label('Judul Buku')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('borrow_date')
                    ->label('Tanggal Pinjam')
                    ->date()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('due_date')
                    ->label('Tanggal Kembali')
                    ->date()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('return_date')
                    ->label('Tanggal Dikembalikan')
                    ->date()
                    ->sortable(),
                
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'dipinjam',
                        'success' => 'dikembalikan',
                        'danger' => 'terlambat',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'dipinjam' => 'Dipinjam',
                        'dikembalikan' => 'Dikembalikan',
                        'terlambat' => 'Terlambat'
                    ]),
                
                Tables\Filters\Filter::make('overdue')
                    ->label('Terlambat')
                    ->query(fn (Builder $query): Builder => $query
                        ->where('due_date', '<', now())
                        ->where('status', 'dipinjam')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('return')
                    ->label('Kembalikan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(function (Borrowing $record): void {
                        $record->update([
                            'status' => 'dikembalikan',
                            'return_date' => now(),
                        ]);
                    })
                    ->visible(fn (Borrowing $record): bool => $record->status === 'dipinjam'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBorrowings::route('/'),
            'create' => Pages\CreateBorrowing::route('/create'),
            'edit' => Pages\EditBorrowing::route('/{record}/edit'),
        ];
    }
} 