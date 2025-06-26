<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-50 px-4">
        <div class="w-full max-w-lg bg-white rounded-lg shadow-lg p-8 text-center">
            <div class="flex flex-col items-center space-y-4">
                <svg class="w-16 h-16 text-yellow-400 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M4.93 19h14.14a2 2 0 001.78-2.9l-7.07-12.25a2 2 0 00-3.56 0L3.15 16.1A2 2 0 004.93 19z" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-800">Formulario no disponible</h2>
                <p class="text-gray-600 text-lg">
                    El periodo para <span class="font-semibold text-blue-600">Solicitudes de Casos Especiales</span> no está activo actualmente.
                </p>
                @isset($evento)
                    <div class="mt-2 text-gray-700 text-base bg-gray-100 rounded-md p-3 w-full">
                        <span class="font-medium text-gray-800">El periodo habilitado era:</span><br>
                        <span class="inline-block mt-1 text-blue-700 font-semibold">
                            {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }}
                        </span>
                        <span class="mx-2 text-gray-500">al</span>
                        <span class="inline-block text-blue-700 font-semibold">
                            {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y') }}
                        </span>
                    </div>
                @endisset
            </div>
        </div>
    </div>
</x-app-layout>
