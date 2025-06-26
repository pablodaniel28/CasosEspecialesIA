<x-app-layout>
    <div class="p-6 text-sm text-gray-800 dark:text-white">

        <h2 class="text-lg font-semibold mb-4">Estado de mi Solicitud</h2>

        @if ($solicitudes->isEmpty())
            <div class="p-4 bg-yellow-100 text-yellow-800 rounded-md">
                No se ha encontrado ninguna solicitud registrada con tu cuenta.
            </div>
        @else
            <div class="space-y-4">
                @foreach ($solicitudes as $solicitud)
                    <div class="p-4 border rounded-lg shadow-md bg-white dark:bg-gray-800 dark:border-gray-700">
                        <p><strong>Código:</strong> {{ $solicitud->codigo }}</p>
                        <p><strong>Nombre:</strong> {{ $solicitud->user->name}}</p>
                        <p><strong>Carrera:</strong> {{ $solicitud->carrera->nombre }}</p>
                        <p><strong>Estado:</strong>
                            @if ($solicitud->estado === 'Aprobado')
                                <span class="text-green-600 font-bold">✅ Aprobado</span>
                            @elseif ($solicitud->estado === 'Pendiente')
                                <span class="text-yellow-600 font-bold">⏳ Pendiente</span>
                            @elseif ($solicitud->estado === 'Observado')
                                <span class="text-red-600 font-bold">❌ Observado</span>
                            @else
                                <span class="text-gray-600 font-bold">{{ $solicitud->estado }}</span>
                            @endif
                        </p>
                        <p class="text-xs text-gray-500 mt-2">Registrado el {{ $solicitud->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-app-layout>
