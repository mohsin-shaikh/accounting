<div>
    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <div class="flex space-x-2 mt-2">
            <x-jet-button>
                {{ __('Create') }}
            </x-jet-button>
            <x-link-as-button.secondary href="{{ route('books.index') }}">
                {{ __('Cancel') }}
            </x-link-as-button.secondary>
        </div>
    </form>
</div>
