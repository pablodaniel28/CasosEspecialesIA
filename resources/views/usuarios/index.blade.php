<x-app-layout>
    <div class="container mx-auto p-6">
        @if (session('success'))
            <div class="bg-green-500 text-white text-sm font-semibold p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="bg-red-500 text-white text-sm font-semibold p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Lista de Usuarios</h2>


        <header class="px-5 py-4 border-b border-blue-50 dark:border-slate-900 flex flex-col sm:flex-row items-center">
            <div class="flex flex-col sm:flex-row items-center">
                <!-- Grupo 1: Añadir, input de búsqueda y botón de búsqueda -->
                <div class="flex flex-1 items-center mb-2 sm:mb-0">

                    <a id="modal-toggle-button"
                        class="flex-shrink-0 bg-red-500 hover:bg-red-900 dark:bg-slate-700 dark:hover:bg-slate-600 text-white dark:text-gray-200 font-semibold px-1.5 py-1 rounded-md text-xs sm:text-xs ml-1 mr-1">
                        <i class="fas fa-plus mr-1"></i> Añadir
                    </a>

                    <input id="searchInput" type="text"
                        class="px-3 py-1 border rounded-md w-full sm:w-auto dark:bg-gray-800 dark:text-white text-xs font-medium mr-2"
                        style="font-size: 12px;" placeholder="Buscar..." onkeyup="searchTable()">

                </div>

            </div>


            <!-- Main modal -->
            <div id="crud-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-lg max-h-full" style="left: 50%; transform: translateX(-50%);">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">

                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Registrar
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                id="modal-close-button">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="p-4 md:p-5">
                                <div class="mb-4">
                                    <label for="nombre"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                                    <input type="text" name="nombre" id="nombre"
                                        class="p-2 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="precio"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio</label>
                                        <input type="number" name="precio" id="precio" step="0.01"
                                            class="p-2 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md"
                                            placeholder="Introduzca el precio">

                                    </div>
                                    <div>
                                        <label for="cantidad"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cantidad</label>
                                        <input type="number" name="cantidad" id="cantidad"
                                            class="p-2 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md">
                                    </div>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <button type="submit"
                                        class="text-white inline-flex items-center bg-cyan-600 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-xs px-4 py-1.5 text-center dark:bg-slate-600 dark:hover:bg-slate-500 dark:focus:ring-cyan-800">
                                        Añadir
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>



        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                <thead class="bg-gray-100 dark:bg-gray-700 text-xs">
                    <tr>
                        <th
                            class="px-6 py-3 text-left font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            ID</th>
                        <th
                            class="px-6 py-3 text-left font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Nombre</th>
                        <th
                            class="px-6 py-3 text-left font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Email</th>
                        <th
                            class="px-6 py-3 text-left font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Rol</th>
                        <th
                            class="px-6 py-3 text-center font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody id="searchTableBody" class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                            <td class="px-6 py-3 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                {{ $user->id }}</td>
                            <td class="px-6 py-3 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                {{ $user->name }}</td>
                            <td class="px-6 py-3 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                {{ $user->email }}</td>
                            <td class="px-6 py-3 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                {{ implode(', ', $user->getRoleNames()->toArray()) }}
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-center space-x-2">
                                <a href="{{ route('usuarios.edit', $user->id) }}"
                                    class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium px-3 py-1 rounded shadow">
                                    ✏️ Editar
                                </a>

                                <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')"
                                        class="bg-red-500 hover:bg-red-600 text-white text-xs font-medium px-3 py-1 rounded shadow">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script>
        function searchTable() {
            var input, filter, table, tbody, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tbody = document.getElementById("searchTableBody");
            tr = tbody.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");

                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }
    </script>

      <script>
            // JavaScript para abrir y cerrar el primer modal
            const modalToggleButton = document.getElementById('modal-toggle-button');
            const modalCloseButton = document.getElementById('modal-close-button');
            const crudModal = document.getElementById('crud-modal');

            modalToggleButton.addEventListener('click', function() {
                crudModal.classList.toggle('hidden');
            });

            modalCloseButton.addEventListener('click', function() {
                crudModal.classList.add('hidden');
            });
        </script>
</x-app-layout>
