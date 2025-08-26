<livewire:info />
@if (in_array(Auth::user()->id, [1, 2, 3, 4, 7, 6]))
    <livewire:cierre />
@endif


@if (!in_array(Auth::user()->id, [7]))
    <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1  gap-6 lg:gap-8 p-6 lg:p-8">
        <div x-data="{
            open: false,
            loading: false,
            processing: false,
            results: [],
            summary: {},
            file: null,
            error: null,
            success: null,
            importDone: false,
        
            async uploadFile() {
                if (!this.file) {
                    this.error = 'Seleccione un archivo';
                    return;
                }
        
                this.loading = true;
                this.error = null;
                this.success = null;
                this.importDone = false;
        
                const formData = new FormData();
                formData.append('file', this.file);
                formData.append('_token', '{{ csrf_token() }}');
        
                try {
                    const response = await fetch('{{ route('import.preview') }}', {
                        method: 'POST',
                        body: formData
                    });
        
                    const data = await response.json();
                    this.results = data.results;
                    this.summary = data.summary;
                    this.open = true;
                } catch (e) {
                    this.error = 'Error al procesar archivo';
                } finally {
                    this.loading = false;
                }
            },
        
            async confirmImport() {
                if (!this.file) {
                    this.error = 'No hay archivo para importar';
                    return;
                }
        
                this.processing = true;
                this.error = null;
        
                const formData = new FormData();
                formData.append('file', this.file);
                formData.append('_token', '{{ csrf_token() }}');
        
                try {
                    const response = await fetch('{{ route('import.process') }}', {
                        method: 'POST',
                        body: formData
                    });
        
                    const data = await response.json();
        
                    if (data.success) {
                        window.alertanew(data.message);
                        this.resetForm();
                    } else {
                        window.alertanew(data.message);
                    }
        
                } catch (e) {
                    this.error = 'Error de conexión';
                } finally {
                    this.processing = false;
                }
            },
        
            getRowStatus(result) {
                if (result.error) {
                    return result.exists ? 'bg-yellow-100' : 'bg-red-100';
                }
                return 'bg-green-50';
            },
        
            resetForm() {
                this.open = false;
                this.file = null;
                this.$refs.fileInput.value = '';
                this.importDone = false;
                this.success = null;
            }
        }">
            <!-- Formulario de carga -->
            <div class="flex items-center">
                <input type="file" x-ref="fileInput" accept=".xls,.xlsx"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    @change="file = $event.target.files[0]; success = null; error = null;" :disabled="processing">
                <button @click="uploadFile" :disabled="loading || processing"
                    class="ml-2 items-center px-4 py-2 bg-gray-500 dark:bg-white border border-transparent rounded-md font-semibold text-xs text-white dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">

                    <span x-show="!loading">Previsualizar Importación</span>
                    <span x-show="loading">Procesando...</span>
                </button>

            </div>
            <div>
                <p x-show="error" x-text="error" class="text-red-500 mt-2"></p>
                <p x-show="success" x-text="success" class="text-green-500 mt-2"></p>
            </div>

            <!-- Modal de previsualización -->
            <div x-show="open" x-cloak
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 jetstream-modal overflow-y-auto px-4 py-6 sm:px-0 z-50">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[80vh] overflow-hidden">
                    <div class="border-b p-4 flex justify-between items-center">
                        <h3 class="text-lg font-bold">
                            <span x-show="!importDone">Previsualización de Importación</span>
                            <span x-show="importDone">Resultado de Importación</span>
                        </h3>
                        <button @click="open = false" class="text-gray-500 hover:text-gray-700">
                            ✕
                        </button>
                    </div>

                    <!-- Resumen -->
                    <div class="p-4 bg-gray-50 border-b">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="bg-white p-3 rounded shadow text-center">
                                <p class="text-2xl font-bold" x-text="summary.total"></p>
                                <p>Filas totales</p>
                            </div>
                            <div class="bg-white p-3 rounded shadow text-center">
                                <p class="text-2xl font-bold text-green-600" x-text="summary.valid"></p>
                                <p>Válidas</p>
                            </div>
                            <div class="bg-white p-3 rounded shadow text-center">
                                <p class="text-2xl font-bold text-red-600" x-text="summary.errors"></p>
                                <p>Con errores</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de resultados -->
                    <div class="overflow-auto max-h-[50vh]">
                        <table class="min-w-full">
                            <thead class="bg-gray-100 sticky top-0">
                                <tr>
                                    <th class="py-2 px-4 text-left">Fila</th>
                                    <th class="py-2 px-4 text-left">Estado</th>
                                    <th class="py-2 px-4 text-left">Detalles</th>
                                    <th class="py-2 px-4 text-left">Cliente</th>
                                    <th class="py-2 px-4 text-left">Expediente</th>
                                    <th class="py-2 px-4 text-left">Consignatario</th>
                                    <th class="py-2 px-4 text-left">Contenedor</th>
                                    <th class="py-2 px-4 text-left">BL</th>


                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="result in results">
                                    <tr :class="getRowStatus(result)" class="border-b hover:bg-gray-50">
                                        <td class="py-2 px-4" x-text="result.row"></td>
                                        <td class="py-2 px-4">
                                            <template x-if="result.error">
                                                <span class="font-medium">
                                                    <span x-show="result.exists" class="text-yellow-600">⚠️
                                                        Duplicado</span>
                                                    <span x-show="!result.exists" class="text-red-600">❌
                                                        Error</span>
                                                </span>
                                            </template>
                                            <template x-if="!result.error">
                                                <span class="text-green-600 font-medium">✓ Válido</span>
                                            </template>
                                        </td>
                                        <td class="py-2 px-4" x-text="result.message"></td>
                                        <td class="py-2 px-4" x-text="result.data?.cliente || '-'"></td>
                                        <td class="py-2 px-4" x-text="result.data?.expediente || '-'"></td>
                                        <td class="py-2 px-4" x-text="result.data?.consignatario || '-'"></td>
                                        <td class="py-2 px-4" x-text="result.data?.contenedor || '-'"></td>
                                        <td class="py-2 px-4" x-text="result.data?.bl || '-'"></td>

                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pie del modal -->
                    <div class="p-4 bg-gray-50 border-t flex justify-end space-x-3">

                        <button @click="open = false" class="px-4 py-2 border rounded bg-red-400"
                            :disabled="processing">
                            Cancelar
                        </button>



                        <button x-show="!importDone && summary.valid > 0"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700" @click="confirmImport"
                            :disabled="processing">


                            <span x-show="!processing">Confirmar Importación</span>
                            <span x-show="processing">Procesando...</span>

                        </button>


                        <div x-show="importDone && summary.errors > 0"
                            class="bg-yellow-100 text-yellow-800 p-3 rounded">
                            Corrija los errores antes de importar
                        </div>

                        <template x-if="importDone">
                            <button @click="resetForm" class="px-4 py-2 bg-blue-500 text-white rounded">
                                Cerrar y subir nuevo archivo
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4" x-data>

    @if (!in_array(Auth::user()->id, [7]))
        <button @click="nuevocliente()"
            class="mx-2 items-center px-4 py-2 dark:bg-green-400 bg-black border border-transparent rounded-md font-semibold text-xs text-white dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
            Nuevo Cliente
        </button>
    @endif
    @if (in_array(Auth::user()->id, [1, 2, 3, 4, 6]))
        <button @click="infocerrado()"
            class="mx-2 items-center px-4 py-2 bg-red-400 dark:bg-red-400 border border-transparent rounded-md font-semibold text-xs text-white dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
            Exportar Información (Cerrados)
        </button>

        <button @click="reconocimiento()"
            class="mx-2 items-center px-4 py-2 bg-green-400 dark:bg-green-400 border border-transparent rounded-md font-semibold text-xs text-white dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
            Reporte Reconocimiento
        </button>
    @endif
</div>


<div class="grid grid-cols-1  gap-6 lg:gap-8 p-6 lg:p-8">
    <livewire:export-table />
</div>
