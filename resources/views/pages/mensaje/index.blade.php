<x-app-layout>
    <div class="p-6">
        <h2 class="text-md font-semibold mb-4 text-gray-800 dark:text-white text-center">Mensajes</h2>

        <form action="{{ route('mensaje.store') }}" method="POST" class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-100 dark:border-gray-800 shadow-lg">
            @csrf

            <!-- Mensaje para mostrar al usuario -->
            <div class="text-center p-4 bg-green-500 text-white rounded-lg shadow-md">
                <p class="text-lg font-semibold">SU CASO ESPECIAL FUE ACEPTADO</p>
            </div>

            <!-- Botón Aceptar -->
            <div class="text-center mt-6">
                <button type="submit"
                    class="bg-slate-400 dark:bg-slate-700 text-white px-4 py-2 text-xs rounded-lg hover:bg-slate-600 dark:hover:bg-slate-900 transition duration-300">
                    Aceptar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

