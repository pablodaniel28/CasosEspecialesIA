<x-app-layout>
    <div class="p-6">
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
                                        <!-- Botón Editar -->
                                        <a href="{{ route('carrera.edit', $carrera->id) }}"
                                            class="bg-slate-500 text-white px-2 py-1 rounded text-xs hover:bg-slate-600">
                                            Editar
                                         </a>


                                        <!-- Formulario de eliminar -->
                                        <form action="{{ route('carrera.destroy', $carrera->id) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600">
                                                Eliminar
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
    <div id="career-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <form action="{{ route('carrera.store') }}" method="POST"
            class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
            @csrf
            <h2 id="modal-title" class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Añadir Nueva Carrera
            </h2>

            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de la
                carrera:</label>
            <input type="text" name="nombre" id="nombre"
                class="w-full p-2 mt-1 border border-gray-300 dark:border-gray-700 rounded-lg"
                placeholder="Ej: Ing. en Inteligencia Artificial" required>

            <label for="codigo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-3">Código de la
                carrera:</label>
            <input type="text" name="codigo" id="codigo"
                class="w-full p-2 mt-1 border border-gray-300 dark:border-gray-700 rounded-lg" placeholder="Ej: 187-6"
                required>

            <div class="mt-4 flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                    class="bg-slate-400 dark:bg-slate-700 text-white px-3 py-1 text-xs rounded-lg hover:bg-slate-600 dark:hover:bg-slate-900 transition">Cancelar</button>
                <button type="submit"
                    class="bg-slate-500 dark:bg-slate-700 text-white px-3 py-1 text-xs rounded-lg hover:bg-slate-600 dark:hover:bg-slate-900 transition">Guardar</button>
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
