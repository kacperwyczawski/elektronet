<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IssueAdministrationResource\Pages;
use App\Models\Issue;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\TextColumn;
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
        return Auth::user()->is_admin;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            //
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('room.name')->label('Sala')->searchable(),
                TextColumn::make('description')->label('Opis')->searchable(),
                TextColumn::make('createdBy.full_name')
                    ->label('Zgłoszone przez')
                    ->searchable(),
                ColumnGroup::make('Rezerwacja')->columns([
                    TextColumn::make('reservation_date')
                        ->label('Data rezerwacji')
                        ->sortable(),
                    TextColumn::make('hours')->badge()->label('Godziny'),
                ]),
                Tables\Columns\ToggleColumn::make('is_done')->label(
                    'Zakończone'
                ),
            ])
            ->filters([TrashedFilter::make()])
            ->actions([
                Tables\Actions\Action::make('assign')
                    ->label('Przypisz')
                    ->icon('heroicon-o-user-plus')
                    ->form([
                        Select::make('priority')
                            ->label('Priorytet')
                            ->options([
                                1 => 'Niski',
                                2 => 'Normalny',
                                3 => 'Wysoki',
                            ])
                            ->default(2)
                            ->selectablePlaceholder(false)
                            ->required(),
                        Select::make('assigned_to_id')
                            ->label('Przypisane do')
                            ->options(
                                fn () => User::query()
                                    ->where('is_executor', true)
                                    ->pluck('full_name', 'id')
                                    ->toArray()
                            )
                            ->searchable()
                            ->required(),
                    ])
                    ->action(function (array $data, Issue $record) {
                        $record->priority = $data['priority'];
                        $record->assigned_to_id = $data['assigned_to_id'];
                        $record->save();

                        Notification::make()
                            ->title(
                                'Przypisano nowe zgłoszenie w sali "'.
                                    $record->room->name.
                                    '"'
                            )
                            ->body($record->description)
                            ->info()
                            ->actions([
                                Action::make('view')
                                    ->label('Zobacz')
                                    ->url(
                                        route(
                                            'filament.admin.resources.issues.view',
                                            $record
                                        )
                                    )
                                    ->button(),
                            ])
                            ->sendToDatabase($record->assignedTo);
                        Notification::make()
                            ->title(
                                'Twoje zgłoszenie w sali "'.
                                    $record->room->name.
                                    '" zostało zatwierdzone i przypisane'
                            )
                            ->body($record->description)
                            ->success()
                            ->actions([
                                Action::make('view')
                                    ->label('Zobacz')
                                    ->url(
                                        route(
                                            'filament.admin.resources.issues.view',
                                            $record
                                        )
                                    )
                                    ->button(),
                            ])
                            ->sendToDatabase($record->createdBy);
                    }),
                Tables\Actions\DeleteAction::make()->label('Usuń'),
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
        return parent::getEloquentQuery()->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);
    }
}
