<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\Select;
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
                Select::make('form_teacher_id')
                    ->relationship('formTeacher', 'full_name')
                    ->searchable()
                    ->preload()
                    ->label('Wychowawca')
                    ->required(),
                Select::make('class_letter')
                    ->options([
                        'A' => 'A',
                        'AE' => 'AE',
                        'B' => 'B',
                        'C' => 'C',
                        'D' => 'D',
                        'E' => 'E',
                        'F' => 'F',
                        'G' => 'G',
                        'H' => 'H',
                        'I' => 'I',
                        'J' => 'J',
                        'K' => 'K',
                    ])
                    ->label('Klasa')
                    ->required(),
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
                Tables\Columns\TextColumn::make('formTeacher.full_name')
                    ->searchable()
                    ->label('Wychowawca'),
                Tables\Columns\TextColumn::make('class_letter')
                    ->searchable()
                    ->label('Klasa'),
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
                Infolists\Components\TextEntry::make('formTeacher.full_name')
                    ->label('Wychowawca'),
                Infolists\Components\TextEntry::make('class_letter')
                    ->label('Klasa'),
                Infolists\Components\RepeatableEntry::make('results')
                    ->grid(4)
                    ->columnSpanFull()
                    ->schema([
                        Infolists\Components\TextEntry::make('result')
                            ->label('Wynik'),
                        Infolists\Components\TextEntry::make('competition.name')
                            ->label('Nazwa'),
                        Infolists\Components\TextEntry::make('date')
                            ->label('Data osiągnięcia'),
                    ])
                    ->label('Osiągnięcia'),
            ])
            ->columns(3);
    }
}
