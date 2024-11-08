<div>
    <form wire:submit='actualizardatos'>
        <x-dialog-modal maxWidth='2xl' wire:model='opensave'>
            <x-slot name="title">
                Editar
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
                    <div>
                        <x-label>Cliente</x-label>
                        <x-input required wire:model='cliente'
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        </x-input>
                    </div>

                    <div>
                        <x-label>Motonave</x-label>
                        <x-input wire:model='motonave'
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        </x-input>
                    </div>
                    <div>
                        <x-label>BL</x-label>
                        <x-input required wire:model='bl'
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        </x-input>
                    </div>
                    <div>
                        <x-label>Consignatario</x-label>
                        <x-input required wire:model='consignatario'
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        </x-input>
                    </div>
                    <div>
                        <x-label>Expediente</x-label>
                        <x-input wire:model='expediente'
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        </x-input>
                    </div>
                    <div>
                        <x-label>eta</x-label>
                        <x-input wire:model='eta' type='date'
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        </x-input>
                    </div>
                    <div>
                        <x-label>Contenedor</x-label>
                        <x-input  wire:model='contenedor'
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        </x-input>
                    </div>
                    <div>
                        <x-label>Tipo</x-label>
                        <x-input  wire:model='tipo'
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        </x-input>
                    </div>
                    <div>
                        <x-label>Linea</x-label>
                        <x-input  wire:model='linea'
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        </x-input>
                    </div>
                    <div>
                        <x-label>Observación</x-label>
                        <x-input  wire:model='obs'
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        </x-input>
                    </div>
                    <div>
                        <x-label>Envio</x-label>
                        <select  wire:model='envio'
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            @if ($envio == 0)
                                <option value="0">Seleccione..</option>
                            @endif

                            @if($qenvio)
                            @foreach ($qenvio as $qenvio)
                                <option value="{{ $qenvio->id }}">{{ $qenvio->nombre }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div>
                        <x-label>Estatus</x-label>
                        <select  wire:model='estatus'
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            @if ($estatus == 0)
                            <option value="0">Seleccione..</option>
                        @endif
                        @if($qestatus)
                        @foreach ($qestatus as $qestatus)
                            <option value="{{ $qestatus->id }}">{{ $qestatus->nombre }}</option>
                        @endforeach
                        @endif
                        </select>
                    </div>



                </div>


            </x-slot>
            <x-slot name="footer">
                <button type="submit"
                    class="mr-5 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2  focus:ring-offset-2 transition ease-in-out duration-150 bg-blue-500 hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-800">Crear</button>
                <x-danger-button class="bg-red-300 mr-5 hover:bg-red-800 focus:bg-red-800 active:bg-red-800"
                    wire:click="$set('opensave', false)">Cerrar</x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </form>
</div>
