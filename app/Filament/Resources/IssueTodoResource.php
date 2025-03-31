<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IssueTodoResource\Pages;
use App\Models\Issue;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class IssueTodoResource extends Resource
{
    protected static ?string $model = Issue::class;

    protected static ?string $modelLabel = 'zgłoszenie';

    protected static ?string $pluralModelLabel = 'zgłoszenia';

    protected static ?string $navigationLabel = 'Do wykonania';

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';

    protected static ?string $navigationGroup = 'Zgłoszenia';

    public static function canAccess(): bool
    {
        return Auth::user()->is_executor;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('room.name')
                    ->label('Sala')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Opis')
                    ->wrap()
                    ->lineClamp(2)
                    ->searchable(),
                ColumnGroup::make('Rezerwacja')
                    ->columns([
                        TextColumn::make('reservation_date')
                            ->label('Data rezerwacji')
                            ->sortable(),
                        TextColumn::make('hours')
                            ->badge()
                            ->label('Godziny'),
                    ]),
                TextColumn::make('priority')
                    ->label('Priorytet')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => match ($state) {
                        1 => 'Niski',
                        2 => 'Normalny',
                        3 => 'Wysoki',
                        default => 'Brak',
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ToggleColumn::make('is_done')
                    ->label('Zakończone'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('assigned_to_id', Auth::id())
            ->where('is_approved', true);
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
            'index' => Pages\ListIssueTodos::route('/'),
        ];
    }
}
