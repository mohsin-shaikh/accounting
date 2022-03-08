<?php

namespace App\Http\Livewire\Customers;

use Closure;
use Filament\Tables;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\LinkAction;
use Filament\Tables\Actions\ButtonAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListCustomers extends Component implements Tables\Contracts\HasTable
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
        return Customer::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name'),
            TextColumn::make('mobile'),
            TextColumn::make('total')
                ->label('You Gave / You Got')
                ->getStateUsing(fn ($record) => $record->type == 'in' ? $record->amount:null),
            TextColumn::make('updated_at')
                ->label('Last Updated')
                ->dateTime(),
        ];
    }

    // Clickable Table Row
    protected function getTableRecordUrlUsing(): Closure
    {
        return fn (Model $record): string => route('customers.show', $record->uuid);
    }

    protected function getTableActions(): array
    {
        return [
            ButtonAction::make('you_gave')
                ->label('You Gave')
                ->color('danger')
                ->url(fn (Customer $record): string => route('entries.create', $record->uuid)."?type=out"),
            ButtonAction::make('you_got')
                ->label('You Got')
                ->color('success')
                ->url(fn (Customer $record): string => route('entries.create', $record->uuid)."?type=in"),
            LinkAction::make('view')
                ->label('View Customer')
                ->url(fn (Customer $record): string => route('customers.show', $record->uuid)),
            LinkAction::make('edit')
                ->label('Edit Customer')
                ->url(fn (Customer $record): string => route('customers.edit', $record->uuid)),
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
            $query->whereIn('id', Customer::search($searchQuery)->keys());
        }

        return $query;
    }

    public function render(): View
    {
        return view('customers.list-customers');
    }
}
