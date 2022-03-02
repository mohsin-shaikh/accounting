<?php

namespace App\Http\Livewire\Books;

use App\Models\Book;
use Filament\Tables;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListBooks extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Book::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name'),
            Tables\Columns\TextColumn::make('user.name'),
        ];
    }

    public function render(): View
    {
        return view('books.list-books');
    }
}
