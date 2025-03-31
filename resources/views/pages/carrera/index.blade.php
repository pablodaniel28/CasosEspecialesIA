<x-app-layout>
    <div class="p-6">

         {{-- Mensaje de éxito --}}
         @if (session('success'))
         <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded-lg text-sm shadow-md border border-green-300">
             {{ session('success') }}
         </div>
     @endif
        <h2 class="text-md font-semibold mb-4 text-gray-800 dark:text-white text-center">Lista de Carreras</h2>

        <div
            class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-100 dark:border-gray-800 shadow-lg">
            <div class="overflow-x-auto">
                <div class="mt-3 mb-3 text-left">
                    <button type="button" onclick="openModal()"
                        class="bg-slate-400 dark:bg-slate-700 text-white px-3 py-1 text-xs rounded-lg hover:bg-slate-600 dark:hover:bg-slate-900 transition">+
                        Añadir Carrera</button>
                </div>
                <table
                    class="w-full text-xs text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700"
                    id="career-table">
                    <thead class="bg-slate-100 dark:bg-gray-700 text-slate-500 dark:text-gray-300">
                        <tr>
                            <th class="p-2">ID</th>
                            <th class="p-2">Código</th>
                            <th class="p-2">Nombre</th>
                            <th class="p-2 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($carreras as $carrera)
                            <tr class="border-t border-gray-300 dark:border-gray-700">
                                <td class="p-2 text-center">{{ $carrera->id }}</td>
                                <td class="p-2 text-center">{{ $carrera->codigo }}</td>
                                <td class="p-2 text-center">{{ $carrera->nombre }}</td>
                                <td class="p-2 text-right">
                                    <div class="flex justify-end gap-2">
                                        <!-- Botón de editar -->
                                        <a title="EDITAR" href="{{ route('carrera.edit', $carrera->id) }}"
                                            class="rounded-lg p-2 text-white hover:scale-125 transition-transform delay-75">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                class="w-5 h-5 text-cyan-800">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>

                                        <!-- Botón de eliminar -->
                                        <form action="{{ route('carrera.destroy', $carrera->id) }}" method="POST" onsubmit="return confirm('¿Desea eliminar esta carrera?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" title="ELIMINAR"
                                                class="p-2 rounded-lg text-white hover:scale-125 transition-transform delay-75">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    class="w-5 h-5 text-red-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Modal para agregar/editar carrera -->

    <!-- Modal de Añadir Nueva Carrera -->
    <div id="career-modal"
    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-40">
        <form action="{{ route('carrera.store') }}" method="POST"
            class="relative bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
            @csrf

            <!-- Botón de cerrar (X) -->
            <button type="button" onclick="closeModal()"
                class="absolute top-4 right-6 text-gray-500 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white text-xl font-bold focus:outline-none">
                &times;
            </button>

            <h2 id="modal-title" class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Añadir Nueva Carrera</h2>

            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de la carrera:</label>
            <input type="text" name="nombre" id="nombre"
               class="w-full p-2 mt-1 border border-gray-300 dark:border-gray-700 rounded-lg
                   bg-white dark:bg-gray-900 text-gray-800 dark:text-white"
                placeholder="Ej: Ing. en Inteligencia Artificial" required>

            <label for="codigo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-3">Código de la carrera:</label>
            <input type="text" name="codigo" id="codigo"
                class="w-full p-2 mt-1 border border-gray-300 dark:border-gray-700 rounded-lg
                   bg-white dark:bg-gray-900 text-gray-800 dark:text-white"
                placeholder="Ej: 187-6" required>

            <div class="mt-4 flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                    class="bg-slate-400 dark:bg-slate-700 text-white px-3 py-1 text-xs rounded-lg hover:bg-slate-600 dark:hover:bg-slate-900 transition">
                    Cancelar
                </button>
                <button type="submit"
                    class="bg-slate-500 dark:bg-slate-700 text-white px-3 py-1 text-xs rounded-lg hover:bg-slate-600 dark:hover:bg-slate-900 transition">
                    Guardar
                </button>
            </div>
        </form>
    </div>



    <script>
        function openModal(editIndex = null) {
            editingIndex = editIndex;
            document.getElementById("modal-title").textContent = editIndex === null ? "Añadir Nueva Carrera" :
                "Editar Carrera";
            document.getElementById("career-modal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("career-modal").classList.add("hidden");
            editingIndex = null;
        }
    </script>
</x-app-layout>
