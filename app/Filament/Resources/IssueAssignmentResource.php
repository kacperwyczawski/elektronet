<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IssueAssignmentResource\Pages;
use App\Models\IssueAssignment;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class IssueAssignmentResource extends Resource
{
    protected static ?string $model = IssueAssignment::class;

    protected static ?string $modelLabel = 'przypisanie';

    protected static ?string $pluralModelLabel = 'przypisania';

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationGroup = 'Zgłoszenia';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ToggleColumn::make('is_approved')
                    ->label('Zatwierdzone')
                    ->afterStateUpdated(function ($record, $state) {
                        // TODO: do not send the notification when toggling from assigned to not assigned
                        Notification::make()
                            ->title('Przypisano nowe zgłoszenie w sali "'.$record->issue->room.'"')
                            ->body($record->issue->description)
                            ->info()
                            ->actions([
                                Action::make('view')
                                    ->label('Zobacz')
                                    ->url(route('filament.admin.resources.issues.view', $record->issue))
                                    ->button(),
                            ])
                            ->sendToDatabase($record->user);
                    }),
                TextColumn::make('issue.room')
                    ->label('Sala')
                    ->searchable(),
                TextColumn::make('issue.description')
                    ->label('Opis')
                    ->wrap()
                    ->lineClamp(2)
                    ->searchable(),
                SelectColumn::make('priority')
                    ->label('Priorytet')
                    ->options([
                        1 => 'Niski',
                        2 => 'Normalny',
                        3 => 'Wysoki',
                    ])
                    ->selectablePlaceholder(false),
                SelectColumn::make('user_id')
                    ->label('Przypisane do')
                    ->options(fn () => User::all()
                        ->pluck('name', 'id')
                        ->toArray()),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
            'index' => Pages\ListIssueAssignments::route('/'),
            'view' => Pages\ViewIssueAssignment::route('/{record}'),
            'edit' => Pages\EditIssueAssignment::route('/{record}/edit'),
        ];
    }
}
