<div>
    @if ($valor == 'BOTON')
        <div x-data="{ id: '{{ $id }}' }">
            @if (!in_array(Auth::user()->id, [7]))
            <button @click="editar('{{ $id }}')"
                class="inline-flex items-center px-4 py-2 bg-white dark:bg-white border border-transparent rounded-md font-semibold text-xs text-black dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
                editar
            </button>
            @endif
             @if (in_array(Auth::user()->id, [1, 2, 3, 4]))
                <button  @click.prevent="eliminar('{{ $id }}')"
                class="inline-flex items-center px-4 py-2 bg-white dark:bg-white border border-transparent rounded-md font-semibold text-xs text-black dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
                Eliminar
            </button>
             @endif

            
             <button @click="pdfbl('{{ $id }}',1)"
             class="inline-flex items-center px-4 py-2 bg-green-500 dark:bg-green-500 border border-transparent rounded-md font-semibold text-xs text-black dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
             Carta BL
             </button>
            
 @if($liberar)
             <button @click="pdfbl('{{ $id }}',2)"
             class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-red-500 border border-transparent rounded-md font-semibold text-xs text-black dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
             Retiro BL
             </button>
              @endif

             @if($liberar AND $lineas == 1)
             <button @click="apendi('{{ $id }}')"
             class="inline-flex items-center px-4 py-2 bg-blue-500 dark:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-black dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
             APENDI
             </button>
             @endif
            
           
            <button @click="pdfbl('{{ $id }}',3)"
             class="inline-flex items-center px-4 py-2 bg-blue-400 dark:bg-blue-300 border border-transparent rounded-md font-semibold text-xs text-black dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
             Renuncia
             </button>
           
            @if($lineas > 0 AND !in_array(Auth::user()->id, [7]))
            <button @click="enviarmail('{{ $id }}')"
            class="inline-flex items-center px-4 py-2 bg-green-500 dark:bg-green-500 border border-transparent rounded-md font-semibold text-xs text-black dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
            Enviar Correo
            </button>
            @endif
        </div>
    @endif

</div>
