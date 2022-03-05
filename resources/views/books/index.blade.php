<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Books') }}
            </h2>
            <x-link-button-primary href="{{ route('books.create') }}">
                {{ __('Create Book') }}
            </x-link-button-primary>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('books.list-books')
        </div>
    </div>
</x-app-layout>
