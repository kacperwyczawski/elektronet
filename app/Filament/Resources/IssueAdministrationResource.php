<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IssueAdministrationResource\Pages;
use App\Models\Issue;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class IssueAdministrationResource extends Resource
{
    protected static ?string $model = Issue::class;

    protected static ?string $modelLabel = 'zgłoszenie';

    protected static ?string $pluralModelLabel = 'zgłoszenia';

    protected static ?string $navigationLabel = 'Administracja';

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';

    protected static ?string $navigationGroup = 'Zgłoszenia';

    public static function canAccess(): bool
    {
        return Auth::user()->role === 'Dyrektor' || Auth::user()->role === 'Kierownik';
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
                TextColumn::make('room')
                    ->label('Sala')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Opis')
                    ->searchable(),
                TextColumn::make('createdBy.full_name')
                    ->label('Zgłoszone przez')
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
                SelectColumn::make('priority')
                    ->label('Priorytet')
                    ->options([
                        1 => 'Niski',
                        2 => 'Normalny',
                        3 => 'Wysoki',
                    ])
                    ->selectablePlaceholder(false),
                SelectColumn::make('assigned_to_id')
                    ->label('Przypisane do')
                    ->options(fn () => User::where('is_executor', true)
                        ->pluck('full_name', 'id')
                        ->toArray())
                    ->afterStateUpdated(function ($record) {
                        if (! $record->is_approved || ! $record->assignedTo) {
                            return;
                        }
                        Notification::make()
                            ->title('Przypisano nowe zgłoszenie w sali "'.$record->room.'"')
                            ->body($record->description)
                            ->info()
                            ->actions([
                                Action::make('view')
                                    ->label('Zobacz')
                                    ->url(route('filament.admin.resources.issues.view', $record))
                                    ->button(),
                            ])
                            ->sendToDatabase($record->assignedTo);
                    }),
                ColumnGroup::make('Status')
                    ->columns([
                        ToggleColumn::make('is_approved')
                            ->label('Zatwierdzone')
                            ->afterStateUpdated(function ($record, $state) {
                                if (! $state) {
                                    return;
                                }
                                if ($record->assignedTo) {
                                    Notification::make()
                                        ->title('Przypisano nowe zgłoszenie w sali "'.$record->room.'"')
                                        ->body($record->description)
                                        ->info()
                                        ->actions([
                                            Action::make('view')
                                                ->label('Zobacz')
                                                ->url(route('filament.admin.resources.issues.view', $record))
                                                ->button(),
                                        ])
                                        ->sendToDatabase($record->assignedTo);
                                }
                                Notification::make()
                                    ->title('Twoje zgłoszenie w sali "'.$record->room.'" zostało zatwierdzone')
                                    ->body($record->description)
                                    ->success()
                                    ->actions([
                                        Action::make('view')
                                            ->label('Zobacz')
                                            ->url(route('filament.admin.resources.issues.view', $record))
                                            ->button(),
                                    ])
                                    ->sendToDatabase($record->createdBy);
                            }),
                        ToggleColumn::make('is_done')
                            ->label('Zakończone'),
                    ]),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->label('Wykonane'),
                Tables\Actions\RestoreAction::make(),
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
            'index' => Pages\ListIssueAdministrations::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
