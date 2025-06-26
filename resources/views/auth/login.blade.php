@php
use App\Models\Carrera;
$carreras = Carrera::all();
@endphp
<x-authentication-layout>
    <h1 class="text-3xl text-gray-800 dark:text-gray-100 font-bold mb-6">{{ __('Bienvenido Estudiante') }}</h1>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
    <!-- Form -->
    <form method="POST" action="{{ route('verificacion.store') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <x-label for="carrera" value="{{ __('Selecciona tu carrera') }}" />
                <select id="carrera" name="carrera" required
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">-- Selecciona una carrera --</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-label for="registro" value="{{ __('Introduce tu registro universitario') }}" />
                <x-input id="registro" type="number" name="registro" :value="old('registro')" required autofocus />
            </div>
            <div>
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="current-password" />
            </div>
        </div>
        <div class="flex items-center justify-between mt-6">
            <x-button class="ml-3">
                {{ __('Inciar Sesion') }}
            </x-button>
        </div>
    </form>
    <x-validation-errors class="mt-4" />
    <!-- Footer -->
    <!-- Footer -->
    <div class="pt-5 mt-1 border-t border-gray-100 dark:border-gray-700/60">
        <!-- Advertencia -->
        <div class="mt-1">
            <div class="bg-yellow-500/20 text-yellow-700 px-3 py-2 rounded-lg flex items-center">
                <svg class="w-4 h-4 shrink-0 fill-current mr-2" viewBox="0 0 12 12">
                    <path
                        d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                </svg>
                <span class="text-sm">
                    Si es tu primera vez iniciando sesión, elige una contraseña de tu preferencia.
                </span>
            </div>
        </div>
    </div>



</x-authentication-layout>
