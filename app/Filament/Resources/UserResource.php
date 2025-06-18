<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
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
        return $form->schema([
            TextInput::make('first_name')->label('Imię')->required(),
            TextInput::make('last_name')->label('Nazwisko')->required(),
            TextInput::make('name')
                ->label('Nazwa użytkownika')
                ->suffixAction(
                    Action::make('generateName')
                        ->icon('heroicon-o-sparkles')
                        ->action(function (Get $get, Set $set) {
                            $name =
                                Str::take($get('first_name'), 3).
                                Str::take($get('last_name'), 3);
                            $name = Str::ascii($name);
                            $name = strtolower($name);
                            $set('name', $name);
                        })
                )
                ->required(),
            TextInput::make('password')
                ->label('Hasło')
                ->password()
                ->revealable()
                ->hiddenOn('edit')
                ->required(),
            Select::make('job_title')
                ->label('Stanowisko')
                ->options([
                    'Dyrektor' => 'Dyrektor',
                    'Nauczyciel' => 'Nauczyciel',
                    'Konserwator' => 'Konserwator',
                    'Portier' => 'Portier',
                    'Robotnik' => 'Robotnik',
                    'Kucharka' => 'Kucharka',
                    'Pomoc kuchenna' => 'Pomoc kuchenna',
                    'Woźny' => 'Woźny',
                    'Sprzątaczka' => 'Sprzątaczka',
                    'Intendent' => 'Intendent',
                    'Magazynier' => 'Magazynier',
                    'Sekretarka' => 'Sekretarka',
                    'Kadrowa' => 'Kadrowa',
                    'Księgowa' => 'Księgowa',
                    'Specjalista' => 'Specjalista',
                    'Higienistka' => 'Higienistka',
                    'Kierownik' => 'Kierownik',
                    'Inne' => 'Inne',
                ])
                ->required(),
            Toggle::make('is_admin')->label('Admin')->inline(false),
            Toggle::make('is_executor')->label('Wykonawca')->inline(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultGroup('job_title')
            ->groupingSettingsHidden(true)
            ->columns([
                TextColumn::make('first_name')->label('Imię')->searchable(),
                TextColumn::make('last_name')->label('Nazwisko')->searchable(),
                TextColumn::make('name')
                    ->label('Nazwa użytkownika')
                    ->searchable(),
                IconColumn::make('is_admin')->label('Admin')->boolean(),
                IconColumn::make('is_executor')->label('Wykonawca')->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('job_title')
                    ->label('Stanowisko')
                    ->searchable()
                    ->badge()
                    ->color(
                        fn (string $state): string => match ($state) {
                            'Kierownik' => 'primary',
                            'Dyrektor' => 'info',
                            default => 'gray',
                        }
                    ),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->groups([Group::make('job_title')->label('Stanowisko')])
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
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
