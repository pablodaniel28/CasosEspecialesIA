<x-app-layout>
    <div class="px-2 sm:px-6 lg:px-8 py-4 w-full max-w-5xl mx-auto dark:bg-slate-800">
        <div class="col-span-full xl:col-span-6 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-100 dark:border-slate-700
            transition-colors duration-300
            @if (request()->cookie('theme') === 'dark' || request()->has('dark') || (auth()->check() && auth()->user()->theme === 'dark')) dark @endif">
            <form action="{{ route('calendario.update', $calendario->id) }}" method="POST" class="p-4 md:p-5 dark:bg-slate-800">
                @csrf
                @method('PUT')
                <div class="mb-2 flex items-center justify-between dark:bg-slate-800">
                    <a href="{{ route('calendario.index') }}"
                       class="inline-flex items-center bg-red-500 text-white hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs px-2 py-1 text-center dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-700">
                        <svg class="h-5 w-5 text-white mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"/>
                            <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
                        </svg>
                        Volver
                    </a>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Editar Evento de Calendario
                    </h3>
                </div>

                <div class="mb-4">
                    <label for="evento" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre del Evento</label>
                    <input type="text" name="evento" id="evento"
                        value="{{ old('evento', $calendario->evento) }}"
                        class="p-2 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md">
                    @error('evento')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio"
                            value="{{ old('fecha_inicio', \Carbon\Carbon::parse($calendario->fecha_inicio)->format('Y-m-d')) }}"
                            class="p-2 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md">
                        @error('fecha_inicio')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="fecha_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" id="fecha_fin"
                            value="{{ old('fecha_fin', \Carbon\Carbon::parse($calendario->fecha_fin)->format('Y-m-d')) }}"
                            class="p-2 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md">
                        @error('fecha_fin')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 mt-4">
                    <label for="carrera_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Carrera</label>
                    <input type="text" id="carrera_id"
                        class="p-2 block w-full shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md"
                        value="{{ $calendario->carrera->nombre ?? $calendario->carrera_id }}" disabled>
                    <input type="hidden" name="carrera_id" value="{{ $calendario->carrera_id }}">
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit"
                        class="text-white inline-flex items-center bg-red-600 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-xs px-4 py-1.5 text-center dark:bg-slate-600 dark:hover:bg-slate-500 dark:focus:ring-cyan-800">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
