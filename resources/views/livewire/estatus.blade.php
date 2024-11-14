<div>
    @if ($valor == 'BOTON')
        <div x-data="{ id: '{{ $id }}' }">
            <button @click="editar('{{ $id }}')"
                class="inline-flex items-center px-4 py-2 bg-white dark:bg-white border border-transparent rounded-md font-semibold text-xs text-black dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
                editar
            </button>
        </div>
    @endif


</div>
