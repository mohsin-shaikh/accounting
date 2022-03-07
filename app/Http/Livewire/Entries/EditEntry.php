<?php

namespace App\Http\Livewire\Entries;

use Filament\Forms;
use App\Models\Entry;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Contracts\View\View;

class EditEntry extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Entry $entry;
    public Customer $customer;

    public function mount($customer, $entry): void
    {
        $this->customer = $customer;
        $this->entry    = $entry;
        $this->form->fill([
            'amount'    => $this->entry->amount,
            'details'   => $this->entry->details,
            'type'      => $this->entry->type,
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
            ]),
        ];
    }

    protected function getFormModel(): Entry
    {
        return $this->entry;
    }

    public function submit(): void
    {
        $this->entry->update($this->form->getState());
    }

    public function render(): View
    {
        return view('entries.edit-entry');
    }
}
