<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IssueResource\Pages;
use App\Models\Issue;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class IssueResource extends Resource
{
    protected static ?string $model = Issue::class;

    protected static ?string $modelLabel = 'zgłoszenie';

    protected static ?string $pluralModelLabel = 'zgłoszenia';

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';

    protected static ?string $navigationGroup = 'Zgłoszenia';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('room')
                    ->label('sala')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('opis')
                    ->required(),
            ])
            ->columns(1);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                IconEntry::make('assignment.is_approved')
                    ->label('Zatwierdzone')
                    ->boolean(),
                TextEntry::make('room')
                    ->label('Sala'),
                TextEntry::make('assignment.priority')
                    ->label('Priorytet')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => match ($state) {
                        1 => 'Niski',
                        2 => 'Normalny',
                        3 => 'Wysoki',
                        default => 'Brak',
                    }),
                TextEntry::make('assignment.user.name')
                    ->label('Przypisano do'),
                TextEntry::make('description')
                    ->label('Opis')
                    ->columnSpanFull(),
            ])
            ->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('assignment.is_approved')
                    ->label('Zatwierdzone')
                    ->boolean(),
                TextColumn::make('room')
                    ->label('Sala')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Opis')
                    ->wrap()
                    ->lineClamp(2)
                    ->searchable(),
                TextColumn::make('assignment.priority')
                    ->label('Priorytet')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => match ($state) {
                        1 => 'Niski',
                        2 => 'Normalny',
                        3 => 'Wysoki',
                        default => 'Brak',
                    })
                    ->sortable(),
                TextColumn::make('assignment.user.name')
                    ->label('Przypisano do')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => Pages\ListIssues::route('/'),
            'create' => Pages\CreateIssue::route('/create'),
            'view' => Pages\ViewIssue::route('/{record}'),
            'edit' => Pages\EditIssue::route('/{record}/edit'),
        ];
    }
}
