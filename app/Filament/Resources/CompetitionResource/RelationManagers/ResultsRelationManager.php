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

class ResultsRelationManager extends RelationManager
{
    protected static string $relationship = 'results';

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
                    ->searchable()
                    ->relationship('student', 'full_name'),
                DatePicker::make('date')
                    ->required()
                    ->label('Data osiągnięcia'),
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
                TextColumn::make('student.class_letter')
                    ->label('Klasa'),
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
