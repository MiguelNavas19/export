<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cerrados') }}
        </h2>
    </x-slot>

    <livewire:info />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-1  gap-6 lg:gap-8 p-6 lg:p-8">
                <livewire:export-table-closed />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
