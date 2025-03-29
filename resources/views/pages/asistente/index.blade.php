<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Asistente Virtual
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 h-[600px] flex flex-col">
                <!-- Área de mensajes -->
                <div id="chat-messages" class="flex-1 overflow-y-auto space-y-4 px-1" style="scroll-behavior: smooth;">
                    <!-- Mensajes -->
                </div>

                <!-- Formulario -->
                <form id="chat-form" class="mt-4 flex gap-2">
                    <input
                        type="text"
                        id="chat-input"
                        name="message"
                        placeholder="Escribí tu pregunta..."
                        autocomplete="off"
                        class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-full text-sm bg-white dark:bg-gray-900 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />
                    <button
                        type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-full text-sm hover:bg-blue-700 transition"
                    >
                        Enviar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const chatForm = document.getElementById('chat-form');
        const chatInput = document.getElementById('chat-input');
        const chatMessages = document.getElementById('chat-messages');

        chatForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const userMessage = chatInput.value.trim();

            if (!userMessage) return;

            // Mostrar mensaje del usuario
            appendMessage('Tú', userMessage);

            chatInput.value = '';

            // Simular respuesta del asistente (puede reemplazarse con fetch a API)
            setTimeout(() => {
                const respuesta = generarRespuesta(userMessage); // Lógica fake
                appendMessage('Asistente', respuesta);
            }, 600);
        });

        function appendMessage(sender, message) {
            const messageElement = document.createElement('div');
            messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
            messageElement.classList.add('p-2', 'rounded', 'bg-gray-100', 'dark:bg-gray-700');
            chatMessages.appendChild(messageElement);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function generarRespuesta(pregunta) {
            // Acá podés reemplazar con lógica real o API
            if (pregunta.toLowerCase().includes('hola')) return '¡Hola! ¿En qué puedo ayudarte?';
            if (pregunta.toLowerCase().includes('carrera')) return 'Podés gestionar carreras desde el menú principal.';
            return 'Lo siento, todavía estoy aprendiendo. 😅';
        }
    </script>
</x-app-layout>
