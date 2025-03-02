<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $modelLabel = 'uczeń';

    protected static ?string $pluralModelLabel = 'uczniowie';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Uczniowie';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->label('Imię'),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->label('Nazwisko'),
                Forms\Components\TextInput::make('school_id_number')
                    ->required()
                    ->label('Numer legitymacji'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->label('Imię'),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()
                    ->label('Nazwisko'),
                Tables\Columns\TextColumn::make('school_id_number')
                    ->searchable()
                    ->label('Numer legitymacji'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Utworzono')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Zaktualizowano')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'view' => Pages\ViewStudent::route('/{record}'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('first_name')
                    ->label('Imię'),
                Infolists\Components\TextEntry::make('last_name')
                    ->label('Nazwisko'),
                Infolists\Components\TextEntry::make('school_id_number')
                    ->label('Numer legitymacji'),
                Infolists\Components\RepeatableEntry::make('achievements')
                    ->grid(4)
                    ->columnSpanFull()
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label('Nazwa'),
                        Infolists\Components\TextEntry::make('result')
                            ->label('Wynik'),
                        Infolists\Components\TextEntry::make('achieved_at')
                            ->label('Data osiągnięcia'),
                    ])
                    ->label('Osiągnięcia'),
            ])
            ->columns(3);
    }
}
