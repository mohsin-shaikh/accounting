<?php

namespace App\Http\Livewire\Books;

use App\Models\Book;
use App\Models\User;
use Filament\Forms;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class CreateBook extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $name;

    public function mount(): void
    {
        $this->form->fill();
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
            ])
                ->schema([
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

    public function submit(): void
    {
        $book = new Book($this->form->getState());
        User::find(Auth::id())->books()->save($book);
        // Book::create($this->form->getState());
    }

    public function render(): View
    {
        return view('books.create-book');
    }
}
