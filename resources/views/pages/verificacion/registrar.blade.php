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
                <x-label for="registro" value="{{ __('registro') }}" />
                <x-input id="registro" type="number" name="registro" :value="old('registro')" required autofocus />
            </div>
            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="current-password" />
            </div>
        </div>
        <div class="flex items-center justify-between mt-6">
            <x-button class="ml-3">
                {{ __('Siguiente') }}
            </x-button>
        </div>
    </form>
    <x-validation-errors class="mt-4" />
    <!-- Footer -->

</x-authentication-layout>
