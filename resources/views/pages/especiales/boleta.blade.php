<x-app-layout>
    <div class="p-6 text-sm text-gray-800 dark:text-white">
        {{-- Título superior --}}
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <h2 class="text-lg font-bold">Boleta de Inscripción</h2>
            <a href="#" onclick="window.print()"
               class="bg-blue-500 hover:bg-blue-600 text-black dark:text-white px-4 py-1 rounded text-xs">
                🖨️ Imprimir
            </a>
        </div>

        {{-- Encabezado general --}}
        @php
            $first = $data[0];
        @endphp

        <div class="flex justify-between items-start mb-4">
            <div>
                <h1 class="text-2xl font-bold mb-1">PERIODO NORMAL {{ $first['team']['management']['name'] }}</h1>
                <p class="text-lg font-semibold mt-3">
                    {{ $first['team']['career']['cod'] }} {{ strtoupper($first['team']['career']['name']) }}
                </p>
                <p class="uppercase text-xs">Localidad Santa Cruz</p>
            </div>

            <div class="text-right">
                <p class="text-blue-600 text-2xl font-bold">{{ $first['student']['reg'] }}</p>
                <p class="text-sm">{{ strtoupper($first['student']['name']) }}</p>
                <p class="text-xs">{{ $first['student']['ci'] }}-SCZ</p>
            </div>
        </div>

        <div class="text-right mt-4 font-bold text-blue-500 text-lg">
            {{ strtoupper($first['origin'])}}
        </div>
        {{-- Tabla de materias --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-xs border border-gray-300 dark:border-gray-600">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase tracking-wide">
                    <tr>
                        <th class="p-1 border whitespace-nowrap">Sigla</th>
                        <th class="p-1 border whitespace-nowrap">Grupo</th>
                        <th class="p-1 border whitespace-nowrap">Materia</th>
                        <th class="p-1 border whitespace-nowrap">Modalidad</th>
                        <th class="p-1 border whitespace-nowrap">Nivel</th>
                        <th class="p-1 border whitespace-nowrap">Horario</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $inscripcion)
                        <tr class="odd:bg-gray-100 even:bg-white dark:odd:bg-gray-800 dark:even:bg-gray-900">
                            <td class="p-1 border text-center">{{ $inscripcion['team']['subject']['sigla'] }}</td>
                            <td class="p-1 border text-center">{{ $inscripcion['team']['name'] }}</td>
                            <td class="p-1 border text-center">{{ strtoupper($inscripcion['team']['subject']['name']) }}</td>
                            <td class="p-1 border text-center">{{ strtoupper($first['mode'])}}</td>
                            <td class="p-1 border text-center">{{ $inscripcion['team']['subject']['semester'] }}</td>
                            <td class="p-1 border text-xs text-center">
                                @if (!empty($inscripcion['horario']))
                                    <ul class="text-gray-600 dark:text-gray-300 space-y-0.5 leading-tight">
                                        @foreach ($inscripcion['horario'] as $h)
                                            <li>
                                                <span class="font-semibold">{{ $h['day'] }}:</span>
                                                {{ $h['star_time'] }} - {{ $h['end_time'] }} | {{ $h['module'] }} - {{ $h['classroom'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-gray-600 dark:text-gray-300 italic">-- Sin horario --</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
