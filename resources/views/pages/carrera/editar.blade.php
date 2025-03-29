<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Editar Carrera
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Mensaje de validación -->
                @if ($errors->any())
                    <div class="mb-4 text-red-500 text-sm">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulario -->
                <form action="{{ route('carrera.update', $carrera->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de la carrera</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $carrera->nombre) }}" required
                               class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200">
                    </div>

                    <div class="mb-4">
                        <label for="codigo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Código de la carrera</label>
                        <input type="text" name="codigo" id="codigo" value="{{ old('codigo', $carrera->codigo) }}" required
                               class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200">
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('carrera.index') }}" class="px-4 py-2 text-sm bg-gray-400 dark:bg-gray-600 text-white rounded hover:bg-gray-500 dark:hover:bg-gray-700">Cancelar</a>
                        <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
