<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $customer->name }} / {{ __('Entries List') }}
            </h2>
            <div>
                <x-link-button-success href="{{ route('entries.create', $customer->uuid) }}?type=in">
                    {{ __('You Got') }}
                </x-link-button-success>
                <x-link-button-danger href="{{ route('entries.create', $customer->uuid) }}?type=out">
                    {{ __('You Gave') }}
                </x-link-button-danger>
            </div>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('entries.list-entries', [$customer])
        </div>
    </div>
</x-app-layout>
