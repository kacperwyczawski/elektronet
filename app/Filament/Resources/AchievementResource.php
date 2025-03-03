<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Filament\Widgets\AchievementsChart;
use App\Models\Achievement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;

    protected static ?string $modelLabel = 'Osiągnięcie';

    protected static ?string $pluralModelLabel = 'Osiągnięcia';

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationGroup = 'Uczniowie';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nazwa'),
                Forms\Components\TextInput::make('result')
                    ->required()
                    ->label('Wynik'),
                Forms\Components\DatePicker::make('achieved_at')
                    ->required()
                    ->maxDate(now())
                    ->label('Data osiągnięcia'),
                Forms\Components\Select::make('student_id')
                    ->required()
                    ->label('Uczeń')
                    ->relationship('student')
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => $record->first_name.' '.
                        $record->last_name.' ['.
                        $record->school_id_number.']')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->label('Imię'),
                        Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->label('Nazwisko'),
                        Forms\Components\TextInput::make('school_id_number')
                            ->required()
                            ->label('Numer legitymacji'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nazwa'),
                Tables\Columns\TextColumn::make('result')
                    ->searchable()
                    ->label('Wynik'),
                Tables\Columns\TextColumn::make('achieved_at')
                    ->searchable()
                    ->label('Data osiągnięcia'),
                Tables\Columns\TextColumn::make('student.first_name')
                    ->searchable()
                    ->label('Imię'),
                Tables\Columns\TextColumn::make('student.last_name')
                    ->searchable()
                    ->label('Nazwisko'),
                Tables\Columns\TextColumn::make('student.school_id_number')
                    ->label('Numer legitymacji'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

    public static function getWidgets(): array
    {
        return [
            AchievementsChart::class,
        ];
    }
}
