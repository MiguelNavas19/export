<div>

@if ($valor == 'envio')

<div x-data="{ selectedValue: '', id: '{{ $id }}', tipo: 'envio' }">
    <select  x-model="selectedValue"
                x-on:change="cambioestatus(selectedValue, id, tipo)"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-24 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @if($actual == 0)
            <option value="0">Seleccione..</option>
            @endif
            @foreach ($options as $value => $label)
                <option value="{{ $label->id }}">{{ $label->nombre }}</option>
            @endforeach
        </select>
    </div>

@endif


    @if ($valor == 'estatus')
    <div x-data="{ selectedValue: '', id: '{{ $id }}', tipo: 'estatus' }">
    <select  x-model="selectedValue"
                x-on:change="cambioestatus(selectedValue, id, tipo)"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-24 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if($actual == 0)
                <option value="0">Seleccione..</option>
                @endif
                @foreach ($options as $value => $label)
                <option value="{{ $label->id }}">{{ $label->nombre }}</option>
            @endforeach
        </select>
    </div>
    @endif


</div>
