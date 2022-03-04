<?php

namespace App\Http\Livewire\Books;

use Filament\Forms;
use App\Models\Book;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class EditBook extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Book $book;

    public $name;

    public function mount($book): void
    {
        $this->book = $book;
        $this->form->fill([
            'name' => $this->book->name,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Grid::make([
                'default' => 1,
                'sm' => 2,
                'md' => 3,
                'lg' => 4,
                'xl' => 6,
                '2xl' => 8,
            ])->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->columnSpan([
                        'sm' => 2,
                        'xl' => 3,
                        '2xl' => 4,
                    ]),
            ]),
        ];
    }

    protected function getFormModel(): Book
    {
        return $this->book;
    }

    public function submit(): void
    {
        $this->book->update($this->form->getState());
    }

    public function render(): View
    {
        return view('books.edit-book');
    }
}
