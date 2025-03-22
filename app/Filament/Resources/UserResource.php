<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Pracownik';

    protected static ?string $pluralModelLabel = 'Pracownicy';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Administracja';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->label('Imię')
                    ->required(),
                Forms\Components\TextInput::make('last_name')
                    ->label('Nazwisko')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Nazwa użytkownika')
                    ->suffixAction(
                        Action::make('generateName')
                            ->icon('heroicon-o-sparkles')
                            ->action(function (Get $get, Set $set) {
                                $name = Str::take($get('first_name'), 3).Str::take($get('last_name'), 3);
                                $name = Str::ascii($name);
                                $name = strtolower($name);
                                $set('name', $name);
                            })
                    )
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->label('Hasło')
                    ->password()
                    ->revealable()
                    ->hiddenOn('edit')
                    ->required(),
                Forms\Components\Select::make('role')
                    ->options([
                        'Pracownik' => 'Pracownik',
                        'Kierownik' => 'Kierownik',
                        'Dyrektor' => 'Dyrektor',
                    ])
                    ->default('Pracownik')
                    ->selectablePlaceholder(false)
                    ->label('Rola')
                    ->required(),
                Forms\Components\TextInput::make('room')
                    ->label('Sala')
                    ->prefix('Opiekun sali:'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                Tables\Grouping\Group::make('role')
                    ->label('Rola'),
            ])
            ->defaultGroup('role')
            ->groupingSettingsHidden(true)
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Imię')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Nazwisko')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nazwa użytkownika')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Rola')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Dyrektor' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('room')
                    ->label('Sala')
                    ->searchable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
