<?php

namespace App\Filament\Resources\CompetitionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AchievementsRelationManager extends RelationManager
{
    protected static string $relationship = 'achievements';

    protected static ?string $title = 'Wyniki';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('result')
                    ->required()
                    ->helperText('Na przykład: laureat, finalista, 1. miejsce')
                    ->label('Wynik'),
                Select::make('student_id')
                    ->label('Uczeń')
                    ->required()
                    ->relationship('student', 'name_with_id'),
                DatePicker::make('date')
                    ->required()
                    ->label('Data osiągnięcia')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('result')
                    ->label('Wynik'),
                TextColumn::make('student.first_name')
                    ->label('Imię'),
                TextColumn::make('student.last_name')
                    ->label('Nazwisko'),
                TextColumn::make('date')
                    ->label('Data')
                    ->date(),
                TextColumn::make('student.school_id_number')
                    ->label('Numer legitymacji'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
