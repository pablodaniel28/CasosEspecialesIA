<x-app-layout>
    <div class="p-6">
        <h2 class="text-md font-semibold mb-4 text-gray-800 dark:text-white text-center">Registrar Solicitud</h2>

        <form action="{{ route('solicitud.store') }}" method="POST" class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-100 dark:border-gray-800 shadow-lg">
            @csrf

            <!-- Director de Carrera y Registro del Estudiante en dos columnas (en pantallas medianas y más grandes) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Director de Carrera -->
                <div>
                    <label for="director" class="block text-xs text-gray-700 dark:text-gray-300">Director de Carrera:</label>
                    <select id="director" name="director"
                        class="w-full p-2 text-xs border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500">
                        <option value="" disabled selected>Seleccione un director</option>
                        <option value="">Ing. Franklin Calderon</option>
                        {{-- @foreach($directores as $director)
                            <option value="{{ $director->id }}">{{ $director->nombre }}</option>
                        @endforeach --}}
                    </select>
                </div>

                <!-- Registro del Estudiante -->
                <div>
                    <label for="registro" class="block text-xs text-gray-700 dark:text-gray-300">Registro del Estudiante:</label>
                    <input type="text" id="registro" name="registro"
                        class="w-full p-2 text-xs border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500" required>
                </div>
            </div>

            <!-- Tabla de Materias -->
            <div>
                <label class="block text-xs text-gray-700 dark:text-gray-300">Materias:</label>
                <table class="w-full text-xs text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700">
                    <thead class="bg-slate-100 dark:bg-gray-700 text-slate-500 dark:text-gray-300">
                        <tr>
                            <th class="p-2">Materia</th>
                            <th class="p-2">Grupo</th>
                            <th class="p-2">Sigla</th>
                            <th class="p-2">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="materiasTable">
                        <tr>
                            <td><input type="text" name="materias[]" class="w-full p-2 text-xs border border-gray-300 dark:border-gray-700 rounded-lg dark:bg-gray-800 dark:text-white" required></td>
                            <td><input type="text" name="grupos[]" class="w-full p-2 text-xs border border-gray-300 dark:border-gray-700 rounded-lg dark:bg-gray-800 dark:text-white" required></td>
                            <td><input type="text" name="siglas[]" class="w-full p-2 text-xs border border-gray-300 dark:border-gray-700 rounded-lg dark:bg-gray-800 dark:text-white" required></td>
                            <td class="text-center">
                                <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700 text-lg">🗑️</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-3 text-left">
                    <button type="button" onclick="addRow()" class="bg-slate-400 dark:bg-slate-700 text-white px-3 py-1 text-xs rounded-lg hover:bg-slate-600 dark:hover:bg-slate-900 transition">+ Añadir Materia</button>
                </div>
            </div>

            <!-- Botón Enviar -->
            <div class="text-center mt-6">
                <button type="submit"
                    class="bg-slate-400 dark:bg-slate-700 text-white px-4 py-2 text-xs rounded-lg hover:bg-slate-600 dark:hover:bg-slate-900 transition duration-300">
                    Enviar Solicitud
                </button>
            </div>
        </form>
    </div>

    <!-- Script para manejar la tabla -->
    <script>
        function addRow() {
            let table = document.getElementById('materiasTable');
            let row = document.createElement('tr');
            row.innerHTML = `
                <td><input type="text" name="materias[]" class="w-full p-2 text-xs border border-gray-300 dark:border-gray-700 rounded-lg dark:bg-gray-800 dark:text-white" required></td>
                <td><input type="text" name="grupos[]" class="w-full p-2 text-xs border border-gray-300 dark:border-gray-700 rounded-lg dark:bg-gray-800 dark:text-white" required></td>
                <td><input type="text" name="siglas[]" class="w-full p-2 text-xs border border-gray-300 dark:border-gray-700 rounded-lg dark:bg-gray-800 dark:text-white" required></td>
                <td class="text-center">
                    <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700 text-lg">🗑️</button>
                </td>
            `;
            table.appendChild(row);
        }

        function removeRow(button) {
            let row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
</x-app-layout>
