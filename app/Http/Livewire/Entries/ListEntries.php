<?php

namespace App\Http\Livewire\Entries;

use Closure;
use App\Models\Entry;
use Filament\Tables;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\LinkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListEntries extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public $customer;

    public function mount($customer)
    {
        $this->customer = $customer;
    }

    protected $queryString = [
        'tableFilters',
        'tableSortColumn',
        'tableSortDirection',
        'tableSearchQuery' => ['except' => ''],
    ];

    protected function getTableQuery(): Builder
    {
        return Entry::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('amount_in')
                ->label('You Got')
                ->getStateUsing(fn ($record) => $record->type == 'in' ? $record->amount:null),
            Tables\Columns\TextColumn::make('amount_out')
                ->label('You Gave')
                ->getStateUsing(fn ($record) => $record->type == 'out' ? $record->amount:null),
            Tables\Columns\TextColumn::make('details'),
            // Tables\Columns\TextColumn::make('type'),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->label('Last Updated'),
        ];
    }

    // Clickable Table Row
    protected function getTableRecordUrlUsing(): Closure
    {
        return fn (Model $record): string => route('entries.edit', [
            $record->customer->uuid,
            $record->uuid
        ]);
    }

    protected function getTableActions(): array
    {
        return [
            LinkAction::make('edit')
                ->label('Edit Entry')
                ->url(fn (Entry $record): string => route('entries.edit', [
                    $record->customer->uuid,
                    $record->uuid
                ])),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            BulkAction::make('delete')
                ->action(fn (Collection $records) => $records->each->delete())
                ->deselectRecordsAfterCompletion()
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation(),
        ];
    }

    public function isTableSearchable(): bool
    {
        return true;
    }

    protected function applySearchToTableQuery(Builder $query): Builder
    {
        if (filled($searchQuery = $this->getTableSearchQuery())) {
            $query->whereIn('id', Entry::search($searchQuery)->keys());
        }

        return $query;
    }

    public function render(): View
    {
        return view('entries.list-entries');
    }
}
