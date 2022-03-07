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
            Tables\Columns\TextColumn::make('name'),
            Tables\Columns\TextColumn::make('mobile'),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
            Tables\Columns\TextColumn::make('updated_at')->dateTime(),
        ];
    }

    // Clickable Table Row
    protected function getTableRecordUrlUsing(): Closure
    {
        return fn (Model $record): string => route('customers.show', ['customer' => $record]);
    }

    protected function getTableActions(): array
    {
        return [
            LinkAction::make('view')
                ->url(fn (Entry $record): string => route('customers.show', $record)),
            LinkAction::make('edit')
                ->url(fn (Entry $record): string => route('customers.edit', $record)),
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
