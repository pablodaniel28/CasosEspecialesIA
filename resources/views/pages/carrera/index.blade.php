<x-app-layout>
    <div class="p-6">
        <h2 class="text-md font-semibold mb-4 text-gray-800 dark:text-white text-center">Lista de Carreras</h2>

        <div class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-100 dark:border-gray-800 shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-xs text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700">
                    <thead class="bg-slate-100 dark:bg-gray-700 text-slate-500 dark:text-gray-300">
                        <tr>
                            <th class="p-2">ID</th>
                            <th class="p-2">Nombre</th>
                            <th class="p-2">Código</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($carreras as $carrera) --}}
                            <tr class="hover:bg-gray-200 dark:hover:bg-gray-700">
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">1</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">Ing. en Sistemas</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">187-4</td>
                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
