<div>

    @if ($valor == 'tenvio')

        <div x-data="{ selectedValue: '', id: '{{ $id }}', tipo: 'envio' }">
            <select x-model="selectedValue" x-on:change="cambioestatus(selectedValue, id, tipo)"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-24 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if ($actual == 0)
                    <option value="0">Seleccione..</option>
                @endif
                @foreach ($options as $value)
                <option value="{{ $value->id }}" {{ $actual == $value->id ? 'selected' : '' }}>{{ $value->nombre }}</option>
                @endforeach
            </select>
        </div>

    @endif


    @if ($valor == 'tliberacion')
        <div x-data="{ selectedva: '', id: '{{ $id }}', tipo: 'liberacion' }">
            <select x-model="selectedva" x-on:change="cambioestatus(selectedva, id, tipo)"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-24 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if ($actual == 0)
                    <option value="0">No</option>
                    <option value="1">Si</option>
                @elseif ($actual == 1)
                <option value="1">Si</option>
                <option value="0">No</option>

                @endif

            </select>
        </div>
    @endif




    @if ($valor == 'testatus')
        <div x-data="{ selectedva: '', id: '{{ $id }}', tipo: 'estatus' }">
            <select x-model="selectedva" x-on:change="cambioestatus(selectedva, id, tipo)"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-24 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if ($actual == 0)
                    <option value="0">Seleccione..</option>
                @endif
                @foreach ($options as $value)
                <option value="{{ $value->id }}" {{ $actual == $value->id ? 'selected' : '' }}>{{ $value->nombre }}</option>
                @endforeach
            </select>
        </div>
    @endif



    @if ($valor == 'BOTON')
        <div x-data="{ id: '{{ $id }}' }">
            <button @click="editar('{{ $id }}')"
                class="inline-flex items-center px-4 py-2 bg-white dark:bg-white border border-transparent rounded-md font-semibold text-xs text-black dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
                editar
            </button>
        </div>
    @endif


</div>
