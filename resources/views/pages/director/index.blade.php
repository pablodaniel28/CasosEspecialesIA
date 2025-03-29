<x-app-layout>
    <div class="p-6">
        <h2 class="text-md font-semibold mb-4 text-gray-800 dark:text-white text-center">Lista de Directores</h2>

        <div class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-100 dark:border-gray-800 shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-xs text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700">
                    <thead class="bg-slate-100 dark:bg-gray-700 text-slate-500 dark:text-gray-300">
                        <tr>
                            <th class="p-3">ID</th>
                            <th class="p-3">Nombre</th>
                            <th class="p-3">Código</th>
                            <th class="p-3">Celular</th>
                            <th class="p-3">Carrera</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($directors as $director) --}}
                            <tr class="odd:bg-gray-100 even:bg-white dark:odd:bg-gray-800 dark:even:bg-gray-900 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3 text-center">1</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3">Ing. Franklin Calderon</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3 text-center">12345</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3 text-center">78945612</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3">Ing. en Sistemas</td>
                            </tr>
                            <tr class="odd:bg-gray-100 even:bg-white dark:odd:bg-gray-800 dark:even:bg-gray-900 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3 text-center">2</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3">Ing. Shirley Perez</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3 text-center">67890</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3 text-center">74589632</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3">Ing. Informática</td>
                            </tr>
                            <tr class="odd:bg-gray-100 even:bg-white dark:odd:bg-gray-800 dark:even:bg-gray-900 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3 text-center">2</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3">Ing. Mauricio Caballero</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3 text-center">22536</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3 text-center">67724516</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3">Ing. en Redes y Telecomunicaciones</td>
                            </tr>
                            <tr class="odd:bg-gray-100 even:bg-white dark:odd:bg-gray-800 dark:even:bg-gray-900 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3 text-center">2</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3">Ing. Rolando Martinez</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3 text-center">59663</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3 text-center">77362563</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-3">Ing. en Robotica</td>
                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
