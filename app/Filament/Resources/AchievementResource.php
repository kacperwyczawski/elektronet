<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Filament\Resources\AchievementResource\RelationManagers;
use App\Models\Achievement;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nazwa'),
                TextInput::make('result')
                    ->required()
                    ->maxLength(255)
                    ->label('Wynik'),
                DatePicker::make('achieved_at')
                    ->required()
                    ->maxDate(now())
                    ->label('Data osiągnięcia'),
                Select::make('student_id')
                    ->required()
                    ->label('Uczeń')
                    ->relationship('student')
                    ->getOptionLabelFromRecordUsing(fn(Model $record) =>
                        $record->first_name . ' ' .
                        $record->last_name . ' [' .
                        $record->school_id_number . ']')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('first_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('last_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('school_id_number')
                            ->required()
                            ->maxLength(255), // TODO: regex validation
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Nazwa'),
                TextColumn::make('result')
                    ->searchable()
                    ->label('Wynik'),
                TextColumn::make('achieved_at')
                    ->searchable()
                    ->sortable()
                    ->label('Data osiągnięcia'),
                TextColumn::make('student.first_name')
                    ->searchable()
                    ->label('Imię'),
                TextColumn::make('student.last_name')
                    ->searchable()
                    ->label('Nazwisko'),
                TextColumn::make('student.school_id_number')
                    ->label('Numer legitymacji'),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'edit' => Pages\EditAchievement::route('/{record}/edit'),
        ];
    }
}
