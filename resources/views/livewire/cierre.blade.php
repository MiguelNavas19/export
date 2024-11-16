<div>
    <form wire:submit='exportarcierre'>
        <x-dialog-modal maxWidth='2xl' wire:model='modal'>
            <x-slot name="title">
              Exportar
            </x-slot>
            <x-slot name="content">
                <div x-data="dateRange()" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
                    <div>
                        <x-label>Desde</x-label>
                        <x-input type="date" required wire:model='desde' x-model="desde" @change="updateHasta"
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        </x-input>
                    </div>
                    <div>
                        <x-label>Hasta</x-label>
                        <x-input type="date" wire:model='hasta' x-model="hasta" ::min="minHasta" ::disabled="!desde"
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        </x-input>
                    </div>
                </div>



            </x-slot>
            <x-slot name="footer">
                <button type="submit"
                    class="mr-5 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2  focus:ring-offset-2 transition ease-in-out duration-150 bg-blue-500 hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-800">Descargar</button>
                <x-danger-button class="bg-red-300 mr-5 hover:bg-red-800 focus:bg-red-800 active:bg-red-800"
                    wire:click="$set('modal', false)">Cerrar</x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </form>

</div>
