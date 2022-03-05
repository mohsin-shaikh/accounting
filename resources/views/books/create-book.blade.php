<div class="mt-5 md:mt-0 md:col-span-2">
    <form wire:submit.prevent="submit">
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            {{ $this->form }}
        </div>

        <div class="flex items-center justify-start px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
            <div class="flex space-x-2">
                <x-jet-button>
                    {{ __('Create') }}
                </x-jet-button>
                <x-link-button-secondary href="{{ route('books.index') }}">
                    {{ __('Cancel') }}
                </x-link-button-secondary>
            </div>
        </div>
    </form>
</div>
