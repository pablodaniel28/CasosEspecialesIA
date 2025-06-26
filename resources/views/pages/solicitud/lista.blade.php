<x-app-layout>
    <div class="p-6">
        <h2 class="text-md font-semibold mb-4 text-gray-800 dark:text-white text-center">Lista de Solicitudes Caso
            Especial</h2>
        <div
            class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-100 dark:border-gray-800 shadow-lg">
            <div class="overflow-x-auto">
                <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    {{-- Buscador por texto --}}
                    <div class="relative w-full md:w-1/2 text-gray-700 dark:text-gray-300">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z">
                                </path>
                            </svg>
                        </span>
                        <input type="text" id="searchInput" placeholder="Buscar en la tabla..."
                            class="w-full pl-10 pr-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>

                    {{-- Filtro por estado --}}
                    <div class="w-full md:w-1/2 flex items-center gap-2">
                        <label for="estadoFilter"
                            class="text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">Filtrar por
                            estado:</label>
                        <select id="estadoFilter"
                            class="w-full p-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-800 dark:text-white">
                            <option value="">Todos</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Aprobado">Aprobado</option>
                            <option value="Observado">Observado</option>
                        </select>
                    </div>
                </div>


                <table
                    class="w-full text-xs text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700"
                    id="career-table">
                    <thead class="bg-slate-100 dark:bg-gray-700 text-slate-500 dark:text-gray-300">
                        <tr>
                            <th class="p-2">ID</th>
                            <th class="p-2">Código</th>
                            <th class="p-2">Materias</th>
                            <th class="p-2">Estudiante</th>
                            <th class="p-2">Carrera</th>
                            <th class="p-2">Documentacion</th>
                            <th class="p-2">Fecha</th>
                            <th class="p-2">Estado</th>
                            <th class="p-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($solicitudes as $d)
                            <tr class="border-t border-gray-300 dark:border-gray-700">
                                <td class="p-2 text-center">{{ $d->id }}</td>
                                <td class="p-2 text-center">{{ $d->codigo }}</td>
                                <td class="p-2 text-center">
                                    @foreach ($d->materias as $materia)
                                        <div>{{ $materia->nombre }}</div>
                                    @endforeach
                                </td>
                                <td class="p-2 text-center">{{ $d->user->registro }}</td>
                                <td class="p-2 text-center">{{ $d->carrera->nombre }}</td>
                                <td class="p-2 text-right">
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <!-- PDF: Boleta de Inscripción -->
                                        <a title="Boleta de Inscripción"
                                            href="{{ route('especial.boleta', ['registro' => $d->user->registro]) }}"
                                            class="rounded-lg p-2 hover:scale-125 transition-transform delay-75">
                                            📄
                                        </a>

                                        {{-- <!-- PDF: Carta de Solicitud -->
                                        <a title="Carta de Solicitud" href="" target="_blank"
                                            class="rounded-lg p-2 hover:scale-125 transition-transform delay-75">
                                            📨
                                        </a> --}}

                                        <!-- PDF: Avance -->
                                        <a title="Avance Académico"
                                            href="{{ route('especial.avance', ['registro' => $d->user->registro]) }}"
                                            target="_blank"
                                            class="rounded-lg p-2 hover:scale-125 transition-transform delay-75">
                                            📚
                                        </a>
                                    </div>
                                </td>

                                <td class="p-2 text-center">{{ $d->created_at }}</td>
                                <td class="p-2 text-center">{{ $d->estado }}</td>
                                <td class="p-2 text-right">
                                    <div class="flex flex-wrap justify-end gap-2">


                                        <!-- Acción: Aprobar -->
                                        <form action="{{ route('solicitud.aprobar', $d->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" title="Aprobar"
                                                class="p-2 rounded-lg hover:scale-125 transition-transform delay-75">
                                                ✅
                                            </button>
                                        </form>

                                        <!-- Acción: Pendiente -->
                                        <form action="{{ route('solicitud.pendiente', $d->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="estado" value="Pendiente">
                                            <button type="submit" title="Marcar como Pendiente"
                                                class="p-2 rounded-lg hover:scale-125 transition-transform delay-75">
                                                ⏳
                                            </button>
                                        </form>

                                        <!-- Acción: Observar -->
                                        <form action="{{ route('solicitud.observar', $d->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" title="Observar"
                                                class="p-2 rounded-lg hover:scale-125 transition-transform delay-75">
                                                ❌
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

    <div id="career-modal" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-40">

        <form action="{{ route('director.store') }}" method="POST"
            class="relative bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
            @csrf

            <!-- Botón de cerrar (X) -->
            <button type="button" onclick="closeModal()"
                class="absolute top-4 right-6 text-gray-500 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white text-xl font-bold focus:outline-none">
                &times;
            </button>

            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Añadir Nuevo Director</h2>

            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre
                completo:</label>
            <input type="text" name="nombre" id="nombre"
                class="w-full p-2 mt-1 border border-gray-300 dark:border-gray-700 rounded-lg
                   bg-white dark:bg-gray-900 text-gray-800 dark:text-white"
                placeholder="Ej: Juan Pérez" required>

            <label for="codigo"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-3">Código:</label>
            <input type="number" name="codigo" id="codigo"
                class="w-full p-2 mt-1 border border-gray-300 dark:border-gray-700 rounded-lg
                   bg-white dark:bg-gray-900 text-gray-800 dark:text-white"
                placeholder="Ej: 12345" required>

            <label for="celular"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-3">Celular:</label>
            <input type="number" name="celular" id="celular"
                class="w-full p-2 mt-1 border border-gray-300 dark:border-gray-700 rounded-lg
                   bg-white dark:bg-gray-900 text-gray-800 dark:text-white"
                placeholder="Ej: 78965412" required>

            <label for="carrera_id"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-3">Carrera:</label>
            <select name="carrera_id" id="carrera_id"
                class="w-full p-2 mt-1 border border-gray-300 dark:border-gray-700 rounded-lg
                   bg-white dark:bg-gray-900 text-gray-800 dark:text-white"
                required>
                <option value="" disabled selected>Seleccione una carrera</option>
                @foreach ($carreras as $carrera)
                    <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                @endforeach
            </select>

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
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#career-table tbody tr');

            rows.forEach(row => {
                let match = false;

                row.querySelectorAll('td').forEach(cell => {
                    const text = cell.textContent.toLowerCase();
                    if (text.includes(filter)) {
                        match = true;
                    }
                });

                row.style.display = match ? '' : 'none';
            });
        });
    </script>
    <script>
        document.getElementById('estadoFilter').addEventListener('change', function() {
            const selected = this.value.toLowerCase();
            const rows = document.querySelectorAll('#table-body tr');

            rows.forEach(row => {
                const estadoCell = row.querySelector(
                    'td:nth-child(8)'); // Ajusta si la columna estado cambia
                const estado = estadoCell?.textContent.trim().toLowerCase();

                if (!selected || estado === selected) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>


    <script>
        function openModal() {
            document.getElementById("career-modal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("career-modal").classList.add("hidden");
        }
    </script>

</x-app-layout>
