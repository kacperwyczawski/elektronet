<?php

namespace App\Filament\Pages;

use App\Models\Issue;
use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Resources\Components\Tab;
use Filament\Resources\Concerns\HasTabs;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AllIssues extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use HasTabs; // TODO: instead of tabs, 3 separate tables (in 3 separate livewire components)

    protected static string $view = 'filament.pages.all-issues';

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';

    protected static ?string $navigationGroup = 'Zgłoszenia';

    protected static ?string $title = 'Administracja zgłoszeniami';

    protected static ?string $navigationLabel = 'Administracja';

    public static function canAccess(): bool
    {
        return Auth::user()->role === 'Dyrektor' || Auth::user()->role === 'Kierownik';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->modifyQueryWithActiveTab(Issue::query()))
            ->columns([
                TextColumn::make('room')
                    ->label('Sala')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Opis')
                    ->searchable(),
                TextColumn::make('createdBy.name')
                    ->label('Zgłoszone przez')
                    ->searchable(),
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
                    ->options(fn() => User::where('is_executor', true)
                        ->pluck('name', 'id')
                        ->toArray())
                    ->afterStateUpdated(function ($record) {
                        if (!$record->is_approved || !$record->assignedTo) {
                            return;
                        }
                        Notification::make()
                            ->title('Przypisano nowe zgłoszenie w sali "' . $record->room . '"')
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
                ToggleColumn::make('is_approved')
                    ->label('Zatwierdzone')
                    ->afterStateUpdated(function ($record, $state) {
                        if (! $state) {
                            return;
                        }
                        if ($record->assignedTo) {
                            Notification::make()
                                ->title('Przypisano nowe zgłoszenie w sali "' . $record->room . '"')
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
                            ->title('Twoje zgłoszenie w sali "' . $record->room . '" zostało zatwierdzone')
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
                    ->label('Zakończone')
            ])
            ->filters([
                // ...
            ])
            ->actions([
                DeleteAction::make(),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function getTabs(): array
    {
        return [
            'unapproved' => Tab::make('Niezatwierdzone')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_approved', false)),
            'in_progress' => Tab::make('W trakcie')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_approved', true)->where('is_done', false)->whereNotNull('assigned_to_id')),
            'done' => Tab::make('Zakończone')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_done', true)),
        ];
    }
}
