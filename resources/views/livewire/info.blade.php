<div>
    @if ($masivo)
        <form wire:submit='actualizardatosmasivos'>
            <x-dialog-modal maxWidth='2xl' wire:model='opensave'>
                <x-slot name="title">
                    Editar Masivamente
                </x-slot>
                <x-slot name="content">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">

                        <div>
                            <x-label>Actual Motonave</x-label>
                            <x-input wire:model='motonavemas'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>



                        <div>
                            <x-label>Actual eta</x-label>
                            <x-input wire:model='etamas' type='date'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
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
    @elseif ($openpdf)

            <x-dialog-modal maxWidth='2xl' wire:model='openpdf'>
                <x-slot name="title">
                    Carta BL
                </x-slot>
                <x-slot name="content">
                    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4">

                        <div>
                            <x-label>Dirigido</x-label>
                            <x-input  wire:model='dirigido'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                            <div>
                                @error('dirigido') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>


                </x-slot>
                <x-slot name="footer">
                    <button wire:click="generarpdf()"
                        class="mr-5 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2  focus:ring-offset-2 transition ease-in-out duration-150 bg-blue-500 hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-800">generar</button>
                    <x-danger-button class="bg-red-300 mr-5 hover:bg-red-800 focus:bg-red-800 active:bg-red-800"
                        wire:click="$set('openpdf', false)">Cerrar</x-danger-button>
                </x-slot>
            </x-dialog-modal>

    @elseif($nuevocliente)
    <div x-data="validarnuevocliente()">
        <form @submit.prevent="ingresarnuevos">
            <x-dialog-modal maxWidth='2xl' wire:model='opensave'>
                <x-slot name="title">
                    Nuevo cliente
                </x-slot>
                <x-slot name="content">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
                        <div>
                            <x-label>Cliente</x-label>
                            <x-input required wire:model='cliente'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                            @error('cliente')
                                <x-label>{{ $message }}</x-label>
                            @enderror
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
                            @error('bl')
                                <x-label>{{ $message }}</x-label>
                            @enderror
                        </div>
                        <div>
                            <x-label>Consignatario</x-label>
                            <x-input required wire:model='consignatario'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                            @error('consignatario')
                                <x-label>{{ $message }}</x-label>
                            @enderror
                        </div>
                        <div>
                            <x-label>Renuncia</x-label>
                            <x-input  wire:model='renuncia'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>
                        <div>
                            <x-label>Expediente</x-label>
                            <x-input wire:model='expediente'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                            @error('expediente')
                                <x-label>{{ $message }}</x-label>
                            @enderror
                        </div>
                        <div>
                            <x-label>eta</x-label>
                            <x-input wire:model='eta' type='date'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>
                        <div>
                            <x-label>Contenedor</x-label>
                            <x-input wire:model='contenedor'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>
                        <div>
                            <x-label>Tipo</x-label>
                            <x-input wire:model='tipo'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>
                        <div>
                            <x-label>Linea</x-label>
                            <select wire:model='linea'
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="">Seleccione..</option>

                            @if ($naviera)
                                @foreach ($naviera as $naviera)
                                    <option value="{{ $naviera->id }}">{{ $naviera->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        </div>
                        <div>
                            <x-label>Puerto</x-label>
                            <select wire:model='puerto'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="">Seleccione..</option>

                                @if ($qpuertos)
                                    @foreach ($qpuertos as $qpuertos)
                                        <option value="{{ $qpuertos->id }}">{{ $qpuertos->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div>
                            <x-label>Observación</x-label>
                            <x-input wire:model='obs'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>
                        <div>
                            <x-label>Envio</x-label>
                            <select wire:model='enviomodal'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="">Seleccione..</option>

                                @if ($qenvio)
                                    @foreach ($qenvio as $qenvio)
                                        <option value="{{ $qenvio->id }}">{{ $qenvio->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div>
                            <x-label>Estatus</x-label>
                            <select wire:model='estatusmodal'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="">Seleccione..</option>

                                @if ($qestatus)
                                    @foreach ($qestatus as $qestatus)
                                        <option value="{{ $qestatus->id }}">{{ $qestatus->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div>
                            <x-label>liberacion</x-label>
                            <select wire:model='liberacion'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="">Seleccione..</option>
                                <option value="false">No</option>
                                <option value="true">Si</option>
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
    @else
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
                            <x-label>Renuncia</x-label>
                            <x-input  wire:model='renuncia'
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
                            <x-input wire:model='contenedor'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>
                        <div>
                            <x-label>Tipo</x-label>
                            <x-input wire:model='tipo'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>
                        <div>
                            <x-label>Linea</x-label>
                            <select wire:model='linea'
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="">Seleccione..</option>

                            @if ($naviera)
                                @foreach ($naviera as $naviera)
                                    <option value="{{ $naviera->id }}">{{ $naviera->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        </div>
                        <div>
                            <x-label>Puerto</x-label>
                            <select wire:model='puerto'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="">Seleccione..</option>

                                @if ($qpuertos)
                                    @foreach ($qpuertos as $qpuertos)
                                        <option value="{{ $qpuertos->id }}">{{ $qpuertos->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div>
                            <x-label>Observación</x-label>
                            <x-input wire:model='obs'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>
                        <div>
                            <x-label>Envio</x-label>
                            <select wire:model='enviomodal'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">

                                @foreach ($qenvio as $qenvio)
                                    <option value="{{ $qenvio->id }}">{{ $qenvio->nombre }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div>
                            <x-label>Estatus</x-label>
                            <select wire:model='estatusmodal'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">


                                @foreach ($qestatus as $qestatus)
                                    <option value="{{ $qestatus->id }}">{{ $qestatus->nombre }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div>
                            <x-label>liberacion</x-label>
                            <select wire:model='liberacion'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="false">No</option>
                                <option value="true">Si</option>
                            </select>
                        </div>


                    </div>


                </x-slot>
                <x-slot name="footer">
                    <button type="submit"
                        class="mr-5 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2  focus:ring-offset-2 transition ease-in-out duration-150 bg-blue-500 hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-800">Actualizar</button>
                    <x-danger-button class="bg-red-300 mr-5 hover:bg-red-800 focus:bg-red-800 active:bg-red-800"
                        wire:click="$set('opensave', false)">Cerrar</x-danger-button>
                </x-slot>
            </x-dialog-modal>
        </form>
    @endif
</div>
