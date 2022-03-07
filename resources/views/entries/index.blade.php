<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Customers') }}
            </h2>
            <x-link-button-primary href="{{ route('customers.create') }}">
                {{ __('Add New Customer') }}
            </x-link-button-primary>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('customers.list-customers')
        </div>
    </div>
</x-app-layout>
