<x-app-layout>
    <div class="p-6 text-sm text-gray-800 dark:text-white">
        {{-- Título superior --}}
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <h2 class="text-lg font-bold">Avance Académico</h2>
            <a href="#" onclick="window.print()"
               class="bg-blue-500 hover:bg-blue-600 text-black dark:text-white px-4 py-1 rounded text-xs">
                🖨️ Imprimir
            </a>
        </div>

        @php
            $first = $data[0];
        @endphp

        {{-- Encabezado --}}
        <div class="flex justify-between items-start mb-4">
            <div>
                <h1 class="text-2xl font-bold mb-1">P.P.A.C. {{ $ppac ?? 'N/A' }}</h1>
                <p class="text-lg font-semibold mt-3">
                    {{ $first['team']['career']['cod'] }} {{ strtoupper($first['team']['career']['name']) }}
                </p>
                <p class="uppercase text-xs">Localidad {{ $first['team']['career']['locality'] }}</p>
            </div>

            <div class="text-right">
                <p class="text-blue-600 text-2xl font-bold">{{ $first['student']['reg'] }}</p>
                <p class="text-sm">{{ strtoupper($first['student']['name']) }}</p>
                <p class="text-xs">{{ $first['student']['ci'] }}-SCZ</p>
            </div>
        </div>

        {{-- Tabla de materias aprobadas --}}
        <div class="overflow-x-auto mt-6">
            <table class="min-w-full text-xs border border-gray-300 dark:border-gray-600">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase tracking-wide">
                    <tr>
                        <th class="p-2 border">Nivel</th>
                        <th class="p-2 border">Sigla</th>
                        <th class="p-2 border">Materia</th>
                        <th class="p-2 border">Periodo</th>
                        <th class="p-2 border">Nota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr class="odd:bg-gray-100 even:bg-white dark:odd:bg-gray-800 dark:even:bg-gray-900">
                            <td class="p-2 border text-center">{{ $item['team']['subject']['semester'] }}</td>
                            <td class="p-2 border text-center">{{ $item['team']['subject']['sigla'] }}</td>
                            <td class="p-2 border text-left">{{ strtoupper($item['team']['subject']['name']) }}</td>
                            <td class="p-2 border text-center">{{ $item['team']['management']['name'] }}</td>
                            <td class="p-2 border text-center font-bold text-blue-600">{{ $item['note'] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
