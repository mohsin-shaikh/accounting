<?php

namespace App\Http\Livewire\Entries;

use Filament\Forms;
use App\Models\Entry;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class EditEntry extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Entry $customer;

    public $name;
    public $mobile;

    public function mount($customer): void
    {
        $this->customer = $customer;
        $this->form->fill([
            'name' => $this->customer->name,
            'mobile' => $this->customer->mobile,
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
                Forms\Components\TextInput::make('mobile')
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
        return $this->customer;
    }

    public function submit(): void
    {
        $this->customer->update($this->form->getState());
    }

    public function render(): View
    {
        return view('entries.edit-entry');
    }
}
