<?php

namespace App\Http\Livewire\Entries;

use Filament\Forms;
use App\Models\Entry;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreateEntry extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $customer;
    public $type;

    protected $queryString = ['type'];

    public function mount($customer): void
    {
        $this->customer = $customer;
        $this->form->fill([
            'type' => $this->type,
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
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->columnSpan([
                        'sm' => 2,
                        'xl' => 3,
                        '2xl' => 4,
                    ]),
                Forms\Components\TextInput::make('details')
                    ->required()
                    ->columnSpan([
                        'sm' => 2,
                        'xl' => 3,
                        '2xl' => 4,
                    ]),
                Forms\Components\DatePicker::make('date')
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
        $entry = new Entry($this->form->getState());
        $this->customer->entries()->save($entry);
        $this->customer->save();
    }

    public function render(): View
    {
        return view('entries.create-entry');
    }
}
