<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IssueResource\Pages;
use App\Models\Issue;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class IssueResource extends Resource
{
    protected static ?string $model = Issue::class;

    protected static ?string $modelLabel = 'zgłoszenie';

    protected static ?string $pluralModelLabel = 'zgłoszenia';

    protected static ?string $navigationLabel = 'Twoje zgłoszenia';

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';

    protected static ?string $navigationGroup = 'Zgłoszenia';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('room_id')
                    ->relationship('room', 'name')
                    ->label('sala')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('opis')
                    ->required(),
                Checkbox::make('is_reservation')
                    ->live()
                    ->label('Rezerwacja sali')
                    ->helperText('Zaznacz, jeśli chcesz zarezerwować salę.'),
                Placeholder::make('Informacje')
                    ->content('W opisie możesz podać dodatkowe informacje, co należy przygotować w sali, w jakim celu, ile miejsc, itd.')
                    ->hidden(fn (Get $get) => ! $get('is_reservation')),
                DatePicker::make('reservation_date')
                    ->live()
                    ->label('Data rezerwacji')
                    ->hidden(fn (Get $get) => ! $get('is_reservation')),
                CheckboxList::make('hours')
                    ->label('Godziny lekcyjne')
                    ->options(function (Get $get) {
                        $options = [
                            '1' => '1. 7:10 - 7:55',
                            '2' => '2. 8:00 - 8:45',
                            '3' => '3. 8:50 - 9:35',
                            '4' => '4. 9:40 - 10:25',
                            '5' => '5. 10:45 - 11:30',
                            '6' => '6. 11:35 - 12:20',
                            '7' => '7. 12:25 - 13:10',
                            '8' => '8. 13:15 - 14:00',
                            '9' => '9. 14:05 - 14:50',
                            '10' => '10. 14:55 - 15:40',
                            '11' => '11. 15:45 - 16:30',
                            '12' => '12. 16:40 - 17:25',
                            '13' => '13. 17:30 - 18:15',
                        ];

                        $date = $get('reservation_date');
                        $room = $get('room_id');
                        if (! $date || ! $room) {
                            return [];
                        }

                        $reserved = Issue::query()->whereDate('reservation_date', $date)
                            ->where('room_id', $room)
                            ->pluck('hours')
                            ->flatten()
                            ->unique()
                            ->toArray();

                        return array_diff_key($options, array_flip($reserved));
                    })
                    ->hidden(fn (Get $get) => ! $get('is_reservation')),
            ])
            ->columns(1);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                IconEntry::make('is_approved')
                    ->label('Zatwierdzone')
                    ->boolean(),
                TextEntry::make('room.name')
                    ->label('Sala'),
                TextEntry::make('priority')
                    ->label('Priorytet')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => match ($state) {
                        1 => 'Niski',
                        2 => 'Normalny',
                        3 => 'Wysoki',
                        default => 'Brak',
                    }),
                TextEntry::make('assignedTo.full_name')
                    ->label('Przypisano do'),
                TextEntry::make('description')
                    ->label('Opis')
                    ->columnSpanFull(),
            ])
            ->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('is_approved')
                    ->label('Zatwierdzone')
                    ->boolean(),
                TextColumn::make('room.name')
                    ->label('Sala')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Opis')
                    ->wrap()
                    ->lineClamp(2)
                    ->searchable(),
                TextColumn::make('priority')
                    ->label('Priorytet')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => match ($state) {
                        1 => 'Niski',
                        2 => 'Normalny',
                        3 => 'Wysoki',
                        default => 'Brak',
                    })
                    ->sortable(),
                TextColumn::make('assignedTo.full_name')
                    ->label('Przypisano do')
                    ->searchable(),
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
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
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
            'index' => Pages\ListIssues::route('/'),
            'create' => Pages\CreateIssue::route('/create'),
            'view' => Pages\ViewIssue::route('/{record}'),
            'edit' => Pages\EditIssue::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->where('created_by_id', Auth::id());
    }
}
