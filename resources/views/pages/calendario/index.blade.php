<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Calendario Académicos</h1>

        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white">
                    <tr>
                        <th class="px-4 py-3">Evento</th>
                        <th class="px-4 py-3">Fecha Inicio</th>
                        <th class="px-4 py-3">Fecha Fin</th>
                        <th class="px-4 py-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($calendarios as $c)
                        <tr class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3">{{ $c->evento }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($c->fecha_inicio)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($c->fecha_fin)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('calendario.edit', $c->id) }}"
                                   class="inline-block px-3 py-1 text-sm font-medium text-blue-600 hover:underline">
                                    ✏️ Editar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                No hay eventos registrados aún.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
