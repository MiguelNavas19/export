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
                {{ $titulo }}
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4">
                    @if ($apendi)
                        <div>
                            <x-label>Dirección</x-label>
                            <x-input wire:model='direccion'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>

                            <x-label>Rif</x-label>
                            <x-input wire:model='rif'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                            <div>
                                @error('direccion')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @else
                        <div>
                            <x-label>Dirigido</x-label>
                            <x-input wire:model='dirigido'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>

                            <x-label>Rif</x-label>
                            <x-input wire:model='rif'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                            <div>
                                @error('dirigido')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

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
                <x-dialog-modal maxWidth='5xl' wire:model='opensave'>
                    <x-slot name="title">
                        Nuevo cliente
                    </x-slot>
                    <x-slot name="content">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
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
                                <x-input wire:model='renuncia'
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
                                <select wire:model='tipo'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="">Seleccione..</option>

                                    @if ($medidas)
                                        @foreach ($medidas as $medida)
                                            <option value="{{ $medida->id }}">{{ $medida->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
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


                            <div>
                                <x-label>Fecha de pago</x-label>
                                <x-input wire:model='fechapago' type='date'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Fecha de entrega</x-label>
                                <x-input wire:model='fechaentrega' type='date'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Fecha veconinter</x-label>
                                <x-input wire:model='fechaveconinter' type='date'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Fecha Despacho</x-label>
                                <x-input wire:model='fechadespacho' type='date'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Fecha Devolucion</x-label>
                                <x-input wire:model='fechadevolucion' type='date'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>


                            <div>
                                <x-label>Fecha Arribo</x-label>
                                <x-input wire:model='fechaarribo' type='date'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Fecha Registro</x-label>
                                <x-input wire:model='fecharegistro' type='date'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Fecha Impuesto</x-label>
                                <x-input wire:model='fechaimpuesto' type='date'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>


                            </div>


                            <div>
                                <x-label>Base</x-label>
                                <x-input wire:model='base' type='number'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Fecha Validacion</x-label>
                                <x-input wire:model='fechavalidacion' type='date'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Color</x-label>
                                <select wire:model='color'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="0">Seleccione..</option>
                                    @if ($colors)
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div>
                                <x-label>Funcionario</x-label>
                                <x-input wire:model='funcionario'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Almacen</x-label>
                                <x-input wire:model='almacen'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Fecha Presentacion</x-label>
                                <x-input wire:model='fechapresentacion' type='date'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Fecha Reconocimiento</x-label>
                                <x-input wire:model='fechareconocimiento' type='date'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>



                            <div>
                                <x-label>Dias Libres</x-label>
                                <x-input wire:model='diaslibres' type='text'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Factura</x-label>
                                <x-input wire:model='factura'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Fecha Factura</x-label>
                                <x-input wire:model='fechafactura' type='date'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Cliente tiene poder</x-label>
                                <select wire:model='poder'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="1">No</option>
                                    <option value="2">Si</option>
                                </select>
                            </div>


                            <div>
                                <x-label>Cantidad de equipos</x-label>
                                <x-input wire:model='cantidadequipos'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>


                            <div>
                                <x-label>Descripcion</x-label>
                                <x-input wire:model='descripcion'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Peso</x-label>
                                <x-input wire:model='peso'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Dua</x-label>
                                <x-input wire:model='dua'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                </x-input>
                            </div>

                            <div>
                                <x-label>Autorizado para imprimir BL</x-label>
                                <select wire:model='autorizado'
                                    class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="1">No</option>
                                    <option value="2">Si</option>
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
            <x-dialog-modal maxWidth='5xl' wire:model='opensave'>
                <x-slot name="title">
                    Editar
                </x-slot>
                <x-slot name="content">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
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
                            <x-input wire:model='renuncia'
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
                            <select wire:model='tipo'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="">Seleccione..</option>

                                @if ($medidas)
                                    @foreach ($medidas as $medida)
                                        <option value="{{ $medida->id }}">{{ $medida->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
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

                        <div>
                            <x-label>Fecha de pago</x-label>
                            <x-input wire:model='fechapago' type='date'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Fecha de entrega</x-label>
                            <x-input wire:model='fechaentrega' type='date'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Fecha veconinter</x-label>
                            <x-input wire:model='fechaveconinter' type='date'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Fecha Despacho</x-label>
                            <x-input wire:model='fechadespacho' type='date'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Fecha Devolucion</x-label>
                            <x-input wire:model='fechadevolucion' type='date'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>


                        <div>
                            <x-label>Fecha Arribo</x-label>
                            <x-input wire:model='fechaarribo' type='date'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Fecha Registro</x-label>
                            <x-input wire:model='fecharegistro' type='date'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Fecha Impuesto</x-label>
                            <x-input wire:model='fechaimpuesto' type='date'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Base</x-label>
                            <x-input wire:model='base' type='number'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Fecha Validacion</x-label>
                            <x-input wire:model='fechavalidacion' type='date'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Color</x-label>
                            <select wire:model='color'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="">Seleccione..</option>
                                @if ($colors)
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div>
                            <x-label>Funcionario</x-label>
                            <x-input wire:model='funcionario'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Almacen</x-label>
                            <x-input wire:model='almacen'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Fecha Presentacion</x-label>
                            <x-input wire:model='fechapresentacion' type='date'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Fecha Reconocimiento</x-label>
                            <x-input wire:model='fechareconocimiento' type='date'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>



                        <div>
                            <x-label>Dias Libres</x-label>
                            <x-input wire:model='diaslibres' type='text'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Factura</x-label>
                            <x-input wire:model='factura'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Fecha Factura</x-label>
                            <x-input wire:model='fechafactura' type='date'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Cliente tiene poder</x-label>
                            <select wire:model='poder'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="1">No</option>
                                <option value="2">Si</option>
                            </select>
                        </div>


                        <div>
                            <x-label>Cantidad de equipos</x-label>
                            <x-input wire:model='cantidadequipos'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>



                        <div>
                            <x-label>Descripcion</x-label>
                            <x-input wire:model='descripcion'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Peso</x-label>
                            <x-input wire:model='peso'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Dua</x-label>
                            <x-input wire:model='dua'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            </x-input>
                        </div>

                        <div>
                            <x-label>Autorizado para imprimir BL</x-label>
                            <select wire:model='autorizado'
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="1">No</option>
                                <option value="2">Si</option>
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
