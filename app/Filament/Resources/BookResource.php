<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    
    protected static ?string $navigationGroup = 'Manajemen Perpustakaan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $state, Forms\Set $set) => $set('slug', Str::slug($state))),
                
                Forms\Components\TextInput::make('slug')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->maxLength(255)
                    ->unique(Book::class, 'slug', ignoreRecord: true),
                
                Forms\Components\Select::make('type')
                    ->options([
                        'textbook' => 'Buku Pelajaran',
                        'fiction' => 'Buku Non-Fiksi (Novel)',
                    ])
                    ->required()
                    ->live(),

                // Field Khusus Buku Pelajaran
                Forms\Components\Select::make('education_level')
                    ->options([
                        'smp' => 'SMP',
                        'sma' => 'SMA',
                    ])
                    ->required()
                    ->visible(fn (Get $get): bool => $get('type') === 'textbook')
                    ->live(),

                Forms\Components\Select::make('grade')
                    ->options(function (Get $get) {
                        if ($get('education_level') === 'smp') {
                            return [
                                7 => 'Kelas 7',
                                8 => 'Kelas 8',
                                9 => 'Kelas 9',
                            ];
                        }
                        return [
                            10 => 'Kelas 10',
                            11 => 'Kelas 11',
                            12 => 'Kelas 12',
                        ];
                    })
                    ->required()
                    ->visible(fn (Get $get): bool => $get('type') === 'textbook'),

                Forms\Components\Select::make('subject')
                    ->options(fn () => Book::getSubjects())
                    ->required()
                    ->visible(fn (Get $get): bool => $get('type') === 'textbook')
                    ->label('Mata Pelajaran'),

                Forms\Components\TextInput::make('curriculum')
                    ->required()
                    ->maxLength(255)
                    ->visible(fn (Get $get): bool => $get('type') === 'textbook'),

                Forms\Components\FileUpload::make('pdf_path')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('books')
                    ->disk('public')
                    ->required()
                    ->visible(fn (Get $get): bool => $get('type') === 'textbook'),

                // Field Khusus Novel
                Forms\Components\TextInput::make('author')
                    ->required()
                    ->maxLength(255)
                    ->visible(fn (Get $get): bool => $get('type') === 'fiction'),
                
                Forms\Components\Select::make('fiction_category')
                    ->options([
                        'romance' => 'Romance',
                        'drama' => 'Drama',
                        'non-fiction' => 'Non-Fiksi',
                        'fiction' => 'Fiksi',
                        'action' => 'Action',
                        'self-improvement' => 'Self Improvement',
                    ])
                    ->required()
                    ->visible(fn (Get $get): bool => $get('type') === 'fiction'),

                Forms\Components\TextInput::make('pages')
                    ->numeric()
                    ->label('Jumlah Halaman')
                    ->required()
                    ->minValue(1)
                    ->visible(fn (Get $get): bool => $get('type') === 'fiction'),

                Forms\Components\TextInput::make('publication_year')
                    ->numeric()
                    ->label('Tahun Terbit')
                    ->length(4)
                    ->required()
                    ->visible(fn (Get $get): bool => $get('type') === 'fiction'),
                
                Forms\Components\FileUpload::make('image_path')
                    ->image()
                    ->directory('books')
                    ->disk('public')
                    ->required()
                    ->maxSize(2048)
                    ->preserveFilenames()
                    ->downloadable()
                    ->columnSpanFull(),
                
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->disk('public')
                    ->height(80)
                    ->defaultImageUrl(asset('images/placeholder.jpg')),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'textbook' => 'success',
                        'fiction' => 'info',
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('education_level')
                    ->badge()
                    ->visible(fn (Tables\Columns\Column $column): bool => $column->getRecord()?->type === 'textbook'),
                Tables\Columns\TextColumn::make('grade')
                    ->visible(fn (Tables\Columns\Column $column): bool => $column->getRecord()?->type === 'textbook'),
                Tables\Columns\TextColumn::make('subject')
                    ->formatStateUsing(fn (string $state): string => Book::getSubjects()[$state] ?? $state)
                    ->visible(fn (Tables\Columns\Column $column): bool => $column->getRecord()?->type === 'textbook'),
                Tables\Columns\TextColumn::make('curriculum')
                    ->visible(fn (Tables\Columns\Column $column): bool => $column->getRecord()?->type === 'textbook'),
                Tables\Columns\TextColumn::make('author')
                    ->searchable()
                    ->sortable()
                    ->visible(fn (Tables\Columns\Column $column): bool => $column->getRecord()?->type === 'fiction'),
                Tables\Columns\TextColumn::make('fiction_category')
                    ->badge()
                    ->visible(fn (Tables\Columns\Column $column): bool => $column->getRecord()?->type === 'fiction'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'textbook' => 'Buku Pelajaran',
                        'fiction' => 'Buku Non-Fiksi (Novel)',
                    ]),
                Tables\Filters\SelectFilter::make('education_level')
                    ->options([
                        'smp' => 'SMP',
                        'sma' => 'SMA',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['value'], function (Builder $query, string $value): Builder {
                            return $query->where('education_level', $value);
                        });
                    }),
                Tables\Filters\SelectFilter::make('subject')
                    ->options(fn () => Book::getSubjects())
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['value'], function (Builder $query, string $value): Builder {
                            return $query->where('subject', $value);
                        });
                    }),
                Tables\Filters\SelectFilter::make('fiction_category')
                    ->options([
                        'romance' => 'Romance',
                        'drama' => 'Drama',
                        'non-fiction' => 'Non-Fiksi',
                        'fiction' => 'Fiksi',
                        'action' => 'Action',
                        'self-improvement' => 'Self Improvement',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['value'], function (Builder $query, string $value): Builder {
                            return $query->where('fiction_category', $value);
                        });
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
